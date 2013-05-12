<?php
include_once("adodb/adodb_dbObject.php");
/**
* Creates a table object in ADOdb's datadict format
*
* This class stores information about a database table. As charactaristics
* of the table are loaded from the external source, methods and properties
* of this class are used to build up the table description in ADOdb's
* datadict format.
*
* @package axmls
* @access private
*/
class dbTable extends dbObject {
	
	/**
	* @var string Table name
	*/
	var $name;
	
	/**
	* @var array Field specifier: Meta-information about each field
	*/
	var $fields = array();
	
	/**
	* @var array List of table indexes.
	*/
	var $indexes = array();
	
	/**
	* @var array Table options: Table-level options
	*/
	var $opts = array();
	
	/**
	* @var string Field index: Keeps track of which field is currently being processed
	*/
	var $current_field;
	
	/**
	* @var boolean Mark table for destruction
	* @access private
	*/
	var $drop_table;
	
	/**
	* @var boolean Mark field for destruction (not yet implemented)
	* @access private
	*/
	var $drop_field = array();
	var $alter; // GS Fix for constraint impl
	
	/**
	* Iniitializes a new table object.
	*
	* @param string $prefix DB Object prefix
	* @param array $attributes Array of table attributes.
	*/
	function dbTable( &$parent, $attributes = NULL ) {
		$this->parent =& $parent;
		$this->name = $this->prefix($attributes['NAME']);
		// GS Fix for constraint impl
		if(isset($attributes['ALTER']))
		{
			$this->alter = $attributes['ALTER'];
		}
	}
	
	/**
	* XML Callback to process start elements. Elements currently 
	* processed are: INDEX, DROP, FIELD, KEY, NOTNULL, AUTOINCREMENT & DEFAULT. 
	*
	* @access private
	*/
	function _tag_open( &$parser, $tag, $attributes ) {
		$this->currentElement = strtoupper( $tag );
		
		switch( $this->currentElement ) {
			case 'INDEX':
				if( !isset( $attributes['PLATFORM'] ) OR $this->supportedPlatform( $attributes['PLATFORM'] ) ) {
					xml_set_object( $parser, $this->addIndex( $attributes ) );
				}
				break;
			case 'DATA':
				if( !isset( $attributes['PLATFORM'] ) OR $this->supportedPlatform( $attributes['PLATFORM'] ) ) {
					xml_set_object( $parser, $this->addData( $attributes ) );
				}
				break;
			case 'DROP':
				$this->drop();
				break;
			case 'FIELD':
				// Add a field
				$fieldName = $attributes['NAME'];
				$fieldType = $attributes['TYPE'];
				$fieldSize = isset( $attributes['SIZE'] ) ? $attributes['SIZE'] : NULL;
				$fieldOpts = isset( $attributes['OPTS'] ) ? $attributes['OPTS'] : NULL;
				
				$this->addField( $fieldName, $fieldType, $fieldSize, $fieldOpts );
				break;
			case 'KEY':
			case 'NOTNULL':
			case 'AUTOINCREMENT':
				// Add a field option
				$this->addFieldOpt( $this->current_field, $this->currentElement );
				break;
			case 'DEFAULT':
				// Add a field option to the table object
				
				// Work around ADOdb datadict issue that misinterprets empty strings.
				if( $attributes['VALUE'] == '' ) {
					$attributes['VALUE'] = " '' ";
				}
				
				$this->addFieldOpt( $this->current_field, $this->currentElement, $attributes['VALUE'] );
				break;
			case 'DEFDATE':
			case 'DEFTIMESTAMP':
				// Add a field option to the table object
				$this->addFieldOpt( $this->current_field, $this->currentElement );
				break;
			default:
				// print_r( array( $tag, $attributes ) );
		}
	}
	
	/**
	* XML Callback to process CDATA elements
	*
	* @access private
	*/
	function _tag_cdata( &$parser, $cdata ) {
		switch( $this->currentElement ) {
			// Table constraint
			case 'CONSTRAINT':
				if( isset( $this->current_field ) ) {
					$this->addFieldOpt( $this->current_field, $this->currentElement, $cdata );
				} else {
					$this->addTableOpt('CONSTRAINTS', $cdata ); // GS Fix for constraint impl
				}
				break;
			// Table option
			case 'OPT':
				$this->addTableOpt('mysql', $cdata ); // GS Fix for constraint impl
				break;
			default:
				
		}
	}
	
	/**
	* XML Callback to process end elements
	*
	* @access private
	*/
	function _tag_close( &$parser, $tag ) {
		$this->currentElement = '';
		
		switch( strtoupper( $tag ) ) {
			case 'TABLE':
				$this->parent->addSQL( $this->create( $this->parent ) );
				xml_set_object( $parser, $this->parent );
				$this->destroy();
				break;
			case 'FIELD':
				unset($this->current_field);
				break;

		}
	}
	
	/**
	* Adds an index to a table object
	*
	* @param array $attributes Index attributes
	* @return object dbIndex object
	*/
	function &addIndex( $attributes ) {
		$name = strtoupper( $attributes['NAME'] );
		$this->indexes[$name] =& new dbIndex( $this, $attributes );
		return $this->indexes[$name];
	}
	
	/**
	* Adds data to a table object
	*
	* @param array $attributes Data attributes
	* @return object dbData object
	*/
	function &addData( $attributes ) {
		if( !isset( $this->data ) ) {
			$this->data =& new dbData( $this, $attributes );
		}
		return $this->data;
	}
	
	/**
	* Adds a field to a table object
	*
	* $name is the name of the table to which the field should be added. 
	* $type is an ADODB datadict field type. The following field types
	* are supported as of ADODB 3.40:
	* 	- C:  varchar
	*	- X:  CLOB (character large object) or largest varchar size
	*	   if CLOB is not supported
	*	- C2: Multibyte varchar
	*	- X2: Multibyte CLOB
	*	- B:  BLOB (binary large object)
	*	- D:  Date (some databases do not support this, and we return a datetime type)
	*	- T:  Datetime or Timestamp
	*	- L:  Integer field suitable for storing booleans (0 or 1)
	*	- I:  Integer (mapped to I4)
	*	- I1: 1-byte integer
	*	- I2: 2-byte integer
	*	- I4: 4-byte integer
	*	- I8: 8-byte integer
	*	- F:  Floating point number
	*	- N:  Numeric or decimal number
	*
	* @param string $name Name of the table to which the field will be added.
	* @param string $type	ADODB datadict field type.
	* @param string $size	Field size
	* @param array $opts	Field options array
	* @return array Field specifier array
	*/
	function addField( $name, $type, $size = NULL, $opts = NULL ) {
		$field_id = $this->FieldID( $name );
		
		// Set the field index so we know where we are
		$this->current_field = $field_id;
		
		// Set the field name (required)
		$this->fields[$field_id]['NAME'] = $name;
		
		// Set the field type (required)
		$this->fields[$field_id]['TYPE'] = $type;
		
		// Set the field size (optional)
		if( isset( $size ) ) {
			$this->fields[$field_id]['SIZE'] = $size;
		}
		
		// Set the field options
		if( isset( $opts ) ) {
			$this->fields[$field_id]['OPTS'][] = $opts;
		}
	}
	
	/**
	* Adds a field option to the current field specifier
	*
	* This method adds a field option allowed by the ADOdb datadict 
	* and appends it to the given field.
	*
	* @param string $field	Field name
	* @param string $opt ADOdb field option
	* @param mixed $value Field option value
	* @return array Field specifier array
	*/
	function addFieldOpt( $field, $opt, $value = NULL ) {
		if( !isset( $value ) ) {
			$this->fields[$this->FieldID( $field )]['OPTS'][] = $opt;
		// Add the option and value
		} else {
			$this->fields[$this->FieldID( $field )]['OPTS'][] = array( $opt => $value );
		}
	}
	
	/**
	* Adds an option to the table
	*
	* This method takes a comma-separated list of table-level options
	* and appends them to the table object.
	*
	* @param string $opt Table option
	* @return array Options
	*/
	function addTableOpt($key, $opt ) { // GS Fix for constraint impl
		//$this->opts[] = $opt;
		$this->opts[$key] = $opt;
		
		return $this->opts;
	}
	
	/**
	* Generates the SQL that will create the table in the database
	*
	* @param object $xmls adoSchema object
	* @return array Array containing table creation SQL
	*/
	function create( &$xmls ) {
		$sql = array();
		
		// drop any existing indexes
		if( is_array( $legacy_indexes = $xmls->dict->MetaIndexes( $this->name ) ) ) {
			foreach( $legacy_indexes as $index => $index_details ) {
				$sql[] = $xmls->dict->DropIndexSQL( $index, $this->name );
			}
		}
		
		// remove fields to be dropped from table object
		foreach( $this->drop_field as $field ) {
			unset( $this->fields[$field] );
		}
		
		// if table exists
		if( is_array( $legacy_fields = $xmls->dict->MetaColumns( $this->name ) ) ) {
			// drop table
			if( $this->drop_table ) {
				$sql[] = $xmls->dict->DropTableSQL( $this->name );
				
				return $sql;
			}
			
			// drop any existing fields not in schema
			foreach( $legacy_fields as $field_id => $field ) {
				if( !isset( $this->fields[$field_id] ) ) {
					$sql[] = $xmls->dict->DropColumnSQL( $this->name, '`'.$field->name.'`' );
				}
			}
		// if table doesn't exist
		} else {
			if( $this->drop_table ) {
				return $sql;
			}
			
			$legacy_fields = array();
		}
		
		// Loop through the field specifier array, building the associative array for the field options
		$fldarray = array();
		
		foreach( $this->fields as $field_id => $finfo ) {
			// Set an empty size if it isn't supplied
			if( !isset( $finfo['SIZE'] ) ) {
				$finfo['SIZE'] = '';
			}
			
			// Initialize the field array with the type and size
			$fldarray[$field_id] = array(
				'NAME' => $finfo['NAME'],
				'TYPE' => $finfo['TYPE'],
				'SIZE' => $finfo['SIZE']
			);
			
			// Loop through the options array and add the field options. 
			if( isset( $finfo['OPTS'] ) ) {
				foreach( $finfo['OPTS'] as $opt ) {
					// Option has an argument.
					if( is_array( $opt ) ) {
						$key = key( $opt );
						$value = $opt[key( $opt )];
						@$fldarray[$field_id][$key] .= $value;
					// Option doesn't have arguments
					} else {
						$fldarray[$field_id][$opt] = $opt;
					}
				}
			}
		}		
		if( empty( $legacy_fields ) && !isset($this->alter)) { // GS Fix for constraint impl
			// Create the new table
			$sql[] = $xmls->dict->CreateTableSQL( $this->name, $fldarray, $this->opts );
			logMsg( end( $sql ), 'Generated CreateTableSQL' );
		} else {
			// Upgrade an existing table
			logMsg( "Upgrading {$this->name} using '{$xmls->upgrade}'" );
			switch( $xmls->upgrade ) {
				// Use ChangeTableSQL
				case 'ALTER':
					logMsg( 'Generated ChangeTableSQL (ALTERing table)' );
					$sql[] = $xmls->dict->ChangeTableSQL( $this->name, $fldarray, $this->opts, $this->alter ); // GS Fix for constraint impl
					break;
				case 'REPLACE':
					logMsg( 'Doing upgrade REPLACE (testing)' );
					$sql[] = $xmls->dict->DropTableSQL( $this->name );
					$sql[] = $xmls->dict->CreateTableSQL( $this->name, $fldarray, $this->opts );
					break;
				// ignore table
				default:
					return array();
			}
		}
		
		foreach( $this->indexes as $index ) {
			$sql[] = $index->create( $xmls );
		}
		
		if( isset( $this->data ) ) {
			$sql[] = $this->data->create( $xmls );
		}
		
		return $sql;
	}
	
	/**
	* Marks a field or table for destruction
	*/
	function drop() {
		if( isset( $this->current_field ) ) {
			// Drop the current field
			logMsg( "Dropping field '{$this->current_field}' from table '{$this->name}'" );
			// $this->drop_field[$this->current_field] = $xmls->dict->DropColumnSQL( $this->name, $this->current_field );
			$this->drop_field[$this->current_field] = $this->current_field;
		} else {
			// Drop the current table
			logMsg( "Dropping table '{$this->name}'" );
			// $this->drop_table = $xmls->dict->DropTableSQL( $this->name );
			$this->drop_table = TRUE;
		}
	}
}
?>