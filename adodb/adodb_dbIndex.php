<?php
include_once("adodb/adodb_dbObject.php");
/**
* Creates an index object in ADOdb's datadict format
*
* This class stores information about a database index. As charactaristics
* of the index are loaded from the external source, methods and properties
* of this class are used to build up the index description in ADOdb's
* datadict format.
*
* @package axmls
* @access private
*/
class dbIndex extends dbObject {
	
	/**
	* @var string	Index name
	*/
	var $name;
	
	/**
	* @var array	Index options: Index-level options
	*/
	var $opts = array();
	
	/**
	* @var array	Indexed fields: Table columns included in this index
	*/
	var $columns = array();
	
	/**
	* @var boolean Mark index for destruction
	* @access private
	*/
	var $drop = FALSE;
	
	/**
	* Initializes the new dbIndex object.
	*
	* @param object $parent Parent object
	* @param array $attributes Attributes
	*
	* @internal
	*/
	function dbIndex( &$parent, $attributes = NULL ) {
		$this->parent =& $parent;
		
		$this->name = $this->prefix ($attributes['NAME']);
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
			case 'DROP':
				$this->drop();
				break;
			case 'CLUSTERED':
			case 'BITMAP':
			case 'UNIQUE':
			case 'FULLTEXT':
			case 'HASH':
				// Add index Option
				$this->addIndexOpt( $this->currentElement );
				break;
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
			case 'COL':
				$this->addField( $cdata );
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
			case 'INDEX':
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
	function addField( $name ) {
		$this->columns[$this->FieldID( $name )] = $name;
		
		// Return the field list
		return $this->columns;
	}
	
	/**
	* Adds options to the index
	*
	* @param string $opt Comma-separated list of index options.
	* @return string Option list
	*/
	function addIndexOpt( $opt ) {
		$this->opts[] = $opt;
		
		// Return the options list
		return $this->opts;
	}
	
	/**
	* Generates the SQL that will create the index in the database
	*
	* @param object $xmls adoSchema object
	* @return array Array containing index creation SQL
	*/
	function create( &$xmls ) {
		if( $this->drop ) {
			return NULL;
		}
		
		// eliminate any columns that aren't in the table
		foreach( $this->columns as $id => $col ) {
			if( !isset( $this->parent->fields[$id] ) ) {
				unset( $this->columns[$id] );
			}
		}
		
		return $xmls->dict->CreateIndexSQL( $this->name, $this->parent->name, $this->columns, $this->opts );
	}
	
	/**
	* Marks an index for destruction
	*/
	function drop() {
		$this->drop = TRUE;
	}
}
?>