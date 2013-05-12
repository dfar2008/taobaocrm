<?php
include_once("adodb/adodb_dbObject.php");
/**
* Creates a data object in ADOdb's datadict format
*
* This class stores information about table data.
*
* @package axmls
* @access private
*/
class dbData extends dbObject {
	
	var $data = array();
	
	var $row;
	
	/**
	* Initializes the new dbIndex object.
	*
	* @param object $parent Parent object
	* @param array $attributes Attributes
	*
	* @internal
	*/
	function dbData( &$parent, $attributes = NULL ) {
		$this->parent =& $parent;
	}
	
	/**
	* XML Callback to process start elements
	*
	* Processes XML opening tags. 
	* Elements currently processed are: DROP, CLUSTERED, BITMAP, UNIQUE, FULLTEXT & HASH. 
	*
	* @access private
	*/
	function _tag_open( &$parser, $tag, $attributes ) {
		$this->currentElement = strtoupper( $tag );
		
		switch( $this->currentElement ) {
			case 'ROW':
				$this->row = count( $this->data );
				$this->data[$this->row] = array();
				break;
			case 'F':
				$this->addField($attributes);
			default:
				// print_r( array( $tag, $attributes ) );
		}
	}
	
	/**
	* XML Callback to process CDATA elements
	*
	* Processes XML cdata.
	*
	* @access private
	*/
	function _tag_cdata( &$parser, $cdata ) {
		switch( $this->currentElement ) {
			// Index field name
			case 'F':
				$this->addData( $cdata );
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
			case 'DATA':
				xml_set_object( $parser, $this->parent );
				break;
		}
	}
	
	/**
	* Adds a field to the index
	*
	* @param string $name Field name
	* @return string Field list
	*/
	function addField( $attributes ) {
		if( isset( $attributes['NAME'] ) ) {
			$name = $attributes['NAME'];
		} else {
			$name = count($this->data[$this->row]);
		}
		
		// Set the field index so we know where we are
		$this->current_field = $this->FieldID( $name );
	}
	
	/**
	* Adds options to the index
	*
	* @param string $opt Comma-separated list of index options.
	* @return string Option list
	*/
	function addData( $cdata ) {
		if( !isset( $this->data[$this->row] ) ) {
			$this->data[$this->row] = array();
		}
		
		if( !isset( $this->data[$this->row][$this->current_field] ) ) {
			$this->data[$this->row][$this->current_field] = '';
		}
		
		$this->data[$this->row][$this->current_field] .= $cdata;
	}
	
	/**
	* Generates the SQL that will create the index in the database
	*
	* @param object $xmls adoSchema object
	* @return array Array containing index creation SQL
	*/
	function create( &$xmls ) {
		$table = $xmls->dict->TableName($this->parent->name);
		$table_field_count = count($this->parent->fields);
		$sql = array();
		
		// eliminate any columns that aren't in the table
		foreach( $this->data as $row ) {
			$table_fields = $this->parent->fields;
			$fields = array();
			
			foreach( $row as $field_id => $field_data ) {
				if( !array_key_exists( $field_id, $table_fields ) ) {
					if( is_numeric( $field_id ) ) {
						$field_id = reset( array_keys( $table_fields ) );
					} else {
						continue;
					}
				}
				
				$name = $table_fields[$field_id]['NAME'];
				
				switch( $table_fields[$field_id]['TYPE'] ) {
					case 'C':
					case 'C2':
					case 'X':
					case 'X2':
						$fields[$name] = $xmls->db->qstr( $field_data );
						break;
					case 'I':
					case 'I1':
					case 'I2':
					case 'I4':
					case 'I8':
						$fields[$name] = intval($field_data);
						break;
					default:
						$fields[$name] = $field_data;
				}
				
				unset($table_fields[$field_id]);
			}
			
			// check that at least 1 column is specified
			if( empty( $fields ) ) {
				continue;
			}
			
			// check that no required columns are missing
			if( count( $fields ) < $table_field_count ) {
				foreach( $table_fields as $field ) {
					if (isset( $field['OPTS'] ))
						if( ( in_array( 'NOTNULL', $field['OPTS'] ) || in_array( 'KEY', $field['OPTS'] ) ) && !in_array( 'AUTOINCREMENT', $field['OPTS'] ) ) {
							continue(2);
						}
				}
			}
			
			$sql[] = 'INSERT INTO '. $table .' ('. implode( ',', array_keys( $fields ) ) .') VALUES ('. implode( ',', $fields ) .')';
		}
		
		return $sql;
	}
}
?>