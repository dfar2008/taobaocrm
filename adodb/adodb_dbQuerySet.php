<?php
include_once("adodb/adodb_dbObject.php");
/**
* Creates the SQL to execute a list of provided SQL queries
*
* @package axmls
* @access private
*/
class dbQuerySet extends dbObject {
	
	/**
	* @var array	List of SQL queries
	*/
	var $queries = array();
	
	/**
	* @var string	String used to build of a query line by line
	*/
	var $query;
	
	/**
	* @var string	Query prefix key
	*/
	var $prefixKey = '';
	
	/**
	* @var boolean	Auto prefix enable (TRUE)
	*/
	var $prefixMethod = 'AUTO';
	
	/**
	* Initializes the query set.
	*
	* @param object $parent Parent object
	* @param array $attributes Attributes
	*/
	function dbQuerySet( &$parent, $attributes = NULL ) {
		$this->parent =& $parent;
			
		// Overrides the manual prefix key
		if( isset( $attributes['KEY'] ) ) {
			$this->prefixKey = $attributes['KEY'];
		}
		
		$prefixMethod = isset( $attributes['PREFIXMETHOD'] ) ? strtoupper( trim( $attributes['PREFIXMETHOD'] ) ) : '';
		
		// Enables or disables automatic prefix prepending
		switch( $prefixMethod ) {
			case 'AUTO':
				$this->prefixMethod = 'AUTO';
				break;
			case 'MANUAL':
				$this->prefixMethod = 'MANUAL';
				break;
			case 'NONE':
				$this->prefixMethod = 'NONE';
				break;
		}
	}
	
	/**
	* XML Callback to process start elements. Elements currently 
	* processed are: QUERY. 
	*
	* @access private
	*/
	function _tag_open( &$parser, $tag, $attributes ) {
		$this->currentElement = strtoupper( $tag );
		
		switch( $this->currentElement ) {
			case 'QUERY':
				// Create a new query in a SQL queryset.
				// Ignore this query set if a platform is specified and it's different than the 
				// current connection platform.
				if( !isset( $attributes['PLATFORM'] ) OR $this->supportedPlatform( $attributes['PLATFORM'] ) ) {
					$this->newQuery();
				} else {
					$this->discardQuery();
				}
				break;
			default:
				// print_r( array( $tag, $attributes ) );
		}
	}
	
	/**
	* XML Callback to process CDATA elements
	*/
	function _tag_cdata( &$parser, $cdata ) {
		switch( $this->currentElement ) {
			// Line of queryset SQL data
			case 'QUERY':
				$this->buildQuery( $cdata );
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
			case 'QUERY':
				// Add the finished query to the open query set.
				$this->addQuery();
				break;
			case 'SQL':
				$this->parent->addSQL( $this->create( $this->parent ) );
				xml_set_object( $parser, $this->parent );
				$this->destroy();
				break;
			default:
				
		}
	}
	
	/**
	* Re-initializes the query.
	*
	* @return boolean TRUE
	*/
	function newQuery() {
		$this->query = '';
		
		return TRUE;
	}
	
	/**
	* Discards the existing query.
	*
	* @return boolean TRUE
	*/
	function discardQuery() {
		unset( $this->query );
		
		return TRUE;
	}
	
	/** 
	* Appends a line to a query that is being built line by line
	*
	* @param string $data Line of SQL data or NULL to initialize a new query
	* @return string SQL query string.
	*/
	function buildQuery( $sql = NULL ) {
		if( !isset( $this->query ) OR empty( $sql ) ) {
			return FALSE;
		}
		
		$this->query .= $sql;
		
		return $this->query;
	}
	
	/**
	* Adds a completed query to the query list
	*
	* @return string	SQL of added query
	*/
	function addQuery() {
		if( !isset( $this->query ) ) {
			return FALSE;
		}
		
		$this->queries[] = $return = trim($this->query);
		
		unset( $this->query );
		
		return $return;
	}
	
	/**
	* Creates and returns the current query set
	*
	* @param object $xmls adoSchema object
	* @return array Query set
	*/
	function create( &$xmls ) {
		foreach( $this->queries as $id => $query ) {
			switch( $this->prefixMethod ) {
				case 'AUTO':
					// Enable auto prefix replacement
					
					// Process object prefix.
					// Evaluate SQL statements to prepend prefix to objects
					$query = $this->prefixQuery( '/^\s*((?is)INSERT\s+(INTO\s+)?)((\w+\s*,?\s*)+)(\s.*$)/', $query, $xmls->objectPrefix );
					$query = $this->prefixQuery( '/^\s*((?is)UPDATE\s+(FROM\s+)?)((\w+\s*,?\s*)+)(\s.*$)/', $query, $xmls->objectPrefix );
					$query = $this->prefixQuery( '/^\s*((?is)DELETE\s+(FROM\s+)?)((\w+\s*,?\s*)+)(\s.*$)/', $query, $xmls->objectPrefix );
					
					// SELECT statements aren't working yet
					#$data = preg_replace( '/(?ias)(^\s*SELECT\s+.*\s+FROM)\s+(\W\s*,?\s*)+((?i)\s+WHERE.*$)/', "\1 $prefix\2 \3", $data );
					
				case 'MANUAL':
					// If prefixKey is set and has a value then we use it to override the default constant XMLS_PREFIX.
					// If prefixKey is not set, we use the default constant XMLS_PREFIX
					if( isset( $this->prefixKey ) AND( $this->prefixKey !== '' ) ) {
						// Enable prefix override
						$query = str_replace( $this->prefixKey, $xmls->objectPrefix, $query );
					} else {
						// Use default replacement
						$query = str_replace( XMLS_PREFIX , $xmls->objectPrefix, $query );
					}
			}
			
			$this->queries[$id] = trim( $query );
		}
		
		// Return the query set array
		return $this->queries;
	}
	
	/**
	* Rebuilds the query with the prefix attached to any objects
	*
	* @param string $regex Regex used to add prefix
	* @param string $query SQL query string
	* @param string $prefix Prefix to be appended to tables, indices, etc.
	* @return string Prefixed SQL query string.
	*/
	function prefixQuery( $regex, $query, $prefix = NULL ) {
		if( !isset( $prefix ) ) {
			return $query;
		}
		
		if( preg_match( $regex, $query, $match ) ) {
			$preamble = $match[1];
			$postamble = $match[5];
			$objectList = explode( ',', $match[3] );
			// $prefix = $prefix . '_';
			
			$prefixedList = '';
			
			foreach( $objectList as $object ) {
				if( $prefixedList !== '' ) {
					$prefixedList .= ', ';
				}
				
				$prefixedList .= $prefix . trim( $object );
			}
			
			$query = $preamble . ' ' . $prefixedList . ' ' . $postamble;
		}
		
		return $query;
	}
}
?>