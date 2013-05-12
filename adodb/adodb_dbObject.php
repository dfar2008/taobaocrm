<?php
/**
* Abstract DB Object. This class provides basic methods for database objects, such
* as tables and indexes.
*
* @package axmls
* @access private
*/
class dbObject {
	
	/**
	* var object Parent
	*/
	var $parent;
	
	/**
	* var string current element
	*/
	var $currentElement;
	
	/**
	* NOP
	*/
	function dbObject( &$parent, $attributes = NULL ) {
		$this->parent =& $parent;
	}
	
	/**
	* XML Callback to process start elements
	*
	* @access private
	*/
	function _tag_open( &$parser, $tag, $attributes ) {
		
	}
	
	/**
	* XML Callback to process CDATA elements
	*
	* @access private
	*/
	function _tag_cdata( &$parser, $cdata ) {
		
	}
	
	/**
	* XML Callback to process end elements
	*
	* @access private
	*/
	function _tag_close( &$parser, $tag ) {
		
	}
	
	function create() {
		return array();
	}
	
	/**
	* Destroys the object
	*/
	function destroy() {
		unset( $this );
	}
	
	/**
	* Checks whether the specified RDBMS is supported by the current
	* database object or its ranking ancestor.
	*
	* @param string $platform RDBMS platform name (from ADODB platform list).
	* @return boolean TRUE if RDBMS is supported; otherwise returns FALSE.
	*/
	function supportedPlatform( $platform = NULL ) {
		return is_object( $this->parent ) ? $this->parent->supportedPlatform( $platform ) : TRUE;
	}
	
	/**
	* Returns the prefix set by the ranking ancestor of the database object.
	*
	* @param string $name Prefix string.
	* @return string Prefix.
	*/
	function prefix( $name = '' ) {
		return is_object( $this->parent ) ? $this->parent->prefix( $name ) : $name;
	}
	
	/**
	* Extracts a field ID from the specified field.
	*
	* @param string $field Field.
	* @return string Field ID.
	*/
	function FieldID( $field ) {
		return strtoupper( preg_replace( '/^`(.+)`$/', '$1', $field ) );
	}
}
?>