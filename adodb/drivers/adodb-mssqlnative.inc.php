<?php
/* 
V5.11 5 May 2010   (c) 2000-2010 John Lim (jlim#natsoft.com). All rights reserved.
  Released under both BSD license and Lesser GPL library license. 
  Whenever there is any discrepancy between the two licenses, 
  the BSD license will take precedence. 
Set tabs to 4 for best viewing.
  
  Latest version is available at http://adodb.sourceforge.net
  
  Native mssql driver. Requires mssql client. Works on Windows. 
    http://www.microsoft.com/sql/technologies/php/default.mspx
  To configure for Unix, see 
   	http://phpbuilder.com/columns/alberto20000919.php3

    $stream = sqlsrv_get_field($stmt, $index, SQLSRV_SQLTYPE_STREAM(SQLSRV_ENC_BINARY));
    stream_filter_append($stream, "convert.iconv.ucs-2/utf-8"); // Voila, UTF-8 can be read directly from $stream

*/

// security - hide paths
if (!defined('ADODB_DIR')) die();

if (!function_exists('sqlsrv_configure')) {
	die("mssqlnative extension not installed");
}

if (!function_exists('sqlsrv_set_error_handling')) {
	function sqlsrv_set_error_handling($constant) {
		sqlsrv_configure("WarningsReturnAsErrors", $constant);
	}
}
if (!function_exists('sqlsrv_log_set_severity')) {
	function sqlsrv_log_set_severity($constant) {
		sqlsrv_configure("LogSeverity", $constant);
	}
}
if (!function_exists('sqlsrv_log_set_subsystems')) {
	function sqlsrv_log_set_subsystems($constant) {
		sqlsrv_configure("LogSubsystems", $constant);
	}
}


//----------------------------------------------------------------
// MSSQL returns dates with the format Oct 13 2002 or 13 Oct 2002
// and this causes tons of problems because localized versions of 
// MSSQL will return the dates in dmy or  mdy order; and also the 
// month strings depends on what language has been configured. The 
// following two variables allow you to control the localization
// settings - Ugh.
//
// MORE LOCALIZATION INFO
// ----------------------
// To configure datetime, look for and modify sqlcommn.loc, 
//  	typically found in c:\mssql\install
// Also read :
//	 http://support.microsoft.com/default.aspx?scid=kb;EN-US;q220918
// Alternatively use:
// 	   CONVERT(char(12),datecol,120)
//
// Also if your month is showing as month-1, 
//   e.g. Jan 13, 2002 is showing as 13/0/2002, then see
//     http://phplens.com/lens/lensforum/msgs.php?id=7048&x=1
//   it's a localisation problem.
//----------------------------------------------------------------


// has datetime converstion to YYYY-MM-DD format, and also mssql_fetch_assoc
if (ADODB_PHPVER >= 0x4300) {
// docs say 4.2.0, but testing shows only since 4.3.0 does it work!
	ini_set('mssql.datetimeconvert',0); 
} else {
    global $ADODB_mssql_mths;		// array, months must be upper-case
	$ADODB_mssql_date_order = 'mdy'; 
	$ADODB_mssql_mths = array(
		'JAN'=>1,'FEB'=>2,'MAR'=>3,'APR'=>4,'MAY'=>5,'JUN'=>6,
		'JUL'=>7,'AUG'=>8,'SEP'=>9,'OCT'=>10,'NOV'=>11,'DEC'=>12);
}

//---------------------------------------------------------------------------
// Call this to autoset $ADODB_mssql_date_order at the beginning of your code,
// just after you connect to the database. Supports mdy and dmy only.
// Not required for PHP 4.2.0 and above.
function AutoDetect_MSSQL_Date_Order($conn)
{
    global $ADODB_mssql_date_order;
	$adate = $conn->GetOne('select getdate()');
	if ($adate) {
		$anum = (int) $adate;
		if ($anum > 0) {
			if ($anum > 31) {
				//ADOConnection::outp( "MSSQL: YYYY-MM-DD date format not supported currently");
			} else
				$ADODB_mssql_date_order = 'dmy';
		} else
			$ADODB_mssql_date_order = 'mdy';
	}
}

class ADODB_mssqlnative extends ADOConnection {
	var $databaseType = "mssqlnative";	
	var $dataProvider = "mssqlnative";
	var $replaceQuote = "''"; // string to use to replace quotes
	var $fmtDate = "'Y-m-d'";
	var $fmtTimeStamp = "'Y-m-d H:i:s'";
	var $hasInsertID = true;
	var $substr = "substring";
	var $length = 'len';
	var $hasAffectedRows = true;
	var $poorAffectedRows = false;
	var $metaDatabasesSQL = "select name from sys.sysdatabases where name <> 'master'";
	var $metaTablesSQL="select name,case when type='U' then 'T' else 'V' end from sysobjects where (type='U' or type='V') and (name not in ('sysallocations','syscolumns','syscomments','sysdepends','sysfilegroups','sysfiles','sysfiles1','sysforeignkeys','sysfulltextcatalogs','sysindexes','sysindexkeys','sysmembers','sysobjects','syspermissions','sysprotects','sysreferences','systypes','sysusers','sysalternates','sysconstraints','syssegments','REFERENTIAL_CONSTRAINTS','CHECK_CONSTRAINTS','CONSTRAINT_TABLE_USAGE','CONSTRAINT_COLUMN_USAGE','VIEWS','VIEW_TABLE_USAGE','VIEW_COLUMN_USAGE','SCHEMATA','TABLES','TABLE_CONSTRAINTS','TABLE_PRIVILEGES','COLUMNS','COLUMN_DOMAIN_USAGE','COLUMN_PRIVILEGES','DOMAINS','DOMAIN_CONSTRAINTS','KEY_COLUMN_USAGE','dtproperties'))";
	var $metaColumnsSQL = # xtype==61 is datetime
        "select c.name,t.name,c.length,
	    (case when c.xusertype=61 then 0 else c.xprec end),
	    (case when c.xusertype=61 then 0 else c.xscale end) 
	    from syscolumns c join systypes t on t.xusertype=c.xusertype join sysobjects o on o.id=c.id where o.name='%s'";
	var $hasTop = 'top';		// support mssql SELECT TOP 10 * FROM TABLE
	var $hasGenID = true;
	var $sysDate = 'convert(datetime,convert(char,GetDate(),102),102)';
	var $sysTimeStamp = 'GetDate()';
	var $maxParameterLen = 4000;
	var $arrayClass = 'ADORecordSet_array_mssqlnative';
	var $uniqueSort = true;
	var $leftOuter = '*=';
	var $rightOuter = '=*';
	var $ansiOuter = true; // for mssql7 or later
	var $identitySQL = 'select SCOPE_IDENTITY()'; // 'select SCOPE_IDENTITY'; # for mssql 2000
	var $uniqueOrderBy = true;
	var $_bindInputArray = true;
	var $_dropSeqSQL = "drop table %s";
	
	function ADODB_mssqlnative() 
	{		
        if ($this->debug) {
            error_log("<pre>");
            sqlsrv_set_error_handling( SQLSRV_ERRORS_LOG_ALL );
            sqlsrv_log_set_severity( SQLSRV_LOG_SEVERITY_ALL );
            sqlsrv_log_set_subsystems(SQLSRV_LOG_SYSTEM_ALL);
            sqlsrv_configure('warnings_return_as_errors', 0);
        } else {
            sqlsrv_set_error_handling(0);
            sqlsrv_log_set_severity(0);
            sqlsrv_log_set_subsystems(SQLSRV_LOG_SYSTEM_ALL);
            sqlsrv_configure('warnings_return_as_errors', 0);
        }
	}

	function ServerInfo()
	{
    	global $ADODB_FETCH_MODE;
		if ($this->fetchMode === false) {
			$savem = $ADODB_FETCH_MODE;
			$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		} else 
			$savem = $this->SetFetchMode(ADODB_FETCH_NUM);
		$arrServerInfo = sqlsrv_server_info($this->_connectionID);
		$arr['description'] = $arrServerInfo['SQLServerName'].' connected to '.$arrServerInfo['CurrentDatabase'];
		$arr['version'] = $arrServerInfo['SQLServerVersion'];//ADOConnection::_findvers($arr['description']);
		return $arr;
	}
	
	function IfNull( $field, $ifNull ) 
	{
		return " ISNULL($field, $ifNull) "; // if MS SQL Server
	}
	
	function _insertid()
	{
	// SCOPE_IDENTITY()
	// Returns the last IDENTITY value inserted into an IDENTITY column in 
	// the same scope. A scope is a module -- a stored procedure, trigger, 
	// function, or batch. Thus, two statements are in the same scope if 
	// they are in the same stored procedure, function, or batch.
		return $this->GetOne($this->identitySQL);
	}

	function _affectedrows()
	{
        return sqlsrv_rows_affected($this->_queryID);
	}
	
	function CreateSequence($seq='adodbseq',$start=1)
	{
		if($this->debug) error_log("<hr>CreateSequence($seq,$start)");
        sqlsrv_begin_transaction($this->_connectionID);
		$start -= 1;
		$this->Execute("create table $seq (id int)");//was float(53)
		$ok = $this->Execute("insert into $seq with (tablock,holdlock) values($start)");
		if (!$ok) {
            if($this->debug) error_log("<hr>Error: ROLLBACK");
            sqlsrv_rollback($this->_connectionID);
			return false;
		}
        sqlsrv_commit($this->_connectionID);
		return true;
	}

	function GenID($seq='adodbseq',$start=1)
	{
        if($this->debug) error_log("<hr>GenID($seq,$start)");
        sqlsrv_begin_transaction($this->_connectionID);
		$ok = $this->Execute("update $seq with (tablock,holdlock) set id = id + 1");
		if (!$ok) {
			$this->Execute("create table $seq (id int)");
			$ok = $this->Execute("insert into $seq with (tablock,holdlock) values($start)");
			if (!$ok) {
                if($this->debug) error_log("<hr>Error: ROLLBACK");
                sqlsrv_rollback($this->_connectionID);
				return false;
			}
			sqlsrv_commit($this->_connectionID);
			return $start;
		}
		$num = $this->GetOne("select id from $seq");
        sqlsrv_commit($this->_connectionID);
        if($this->debug) error_log(" Returning: $num");
		return $num;
	}
	
	// Format date column in sql string given an input format that understands Y M D
	function SQLDate($fmt, $col=false)
	{	
		if (!$col) $col = $this->sysTimeStamp;
		$s = '';
		
		$len = strlen($fmt);
		for ($i=0; $i < $len; $i++) {
			if ($s) $s .= '+';
			$ch = $fmt[$i];
			switch($ch) {
			case 'Y':
			case 'y':
				$s .= "datename(yyyy,$col)";
				break;
			case 'M':
				$s .= "convert(char(3),$col,0)";
				break;
			case 'm':
				$s .= "replace(str(month($col),2),' ','0')";
				break;
			case 'Q':
			case 'q':
				$s .= "datename(quarter,$col)";
				break;
			case 'D':
			case 'd':
				$s .= "replace(str(day($col),2),' ','0')";
				break;
			case 'h':
				$s .= "substring(convert(char(14),$col,0),13,2)";
				break;
			
			case 'H':
				$s .= "replace(str(datepart(hh,$col),2),' ','0')";
				break;
				
			case 'i':
				$s .= "replace(str(datepart(mi,$col),2),' ','0')";
				break;
			case 's':
				$s .= "replace(str(datepart(ss,$col),2),' ','0')";
				break;
			case 'a':
			case 'A':
				$s .= "substring(convert(char(19),$col,0),18,2)";
				break;
				
			default:
				if ($ch == '\\') {
					$i++;
					$ch = substr($fmt,$i,1);
				}
				$s .= $this->qstr($ch);
				break;
			}
		}
		return $s;
	}

	
	function BeginTrans()
	{
		if ($this->transOff) return true; 
		$this->transCnt += 1;
        if ($this->debug) error_log('<hr>begin transaction');
		sqlsrv_begin_transaction($this->_connectionID);
	   	return true;
	}
		
	function CommitTrans($ok=true) 
	{ 
		if ($this->transOff) return true; 
        if ($this->debug) error_log('<hr>commit transaction');
		if (!$ok) return $this->RollbackTrans();
		if ($this->transCnt) $this->transCnt -= 1;
		sqlsrv_commit($this->_connectionID);
		return true;
	}
	function RollbackTrans()
	{
		if ($this->transOff) return true; 
        if ($this->debug) error_log('<hr>rollback transaction');
		if ($this->transCnt) $this->transCnt -= 1;
		sqlsrv_rollback($this->_connectionID);
		return true;
	}
	
	function SetTransactionMode( $transaction_mode ) 
	{
		$this->_transmode  = $transaction_mode;
		if (empty($transaction_mode)) {
			$this->Execute('SET TRANSACTION ISOLATION LEVEL READ COMMITTED');
			return;
		}
		if (!stristr($transaction_mode,'isolation')) $transaction_mode = 'ISOLATION LEVEL '.$transaction_mode;
		$this->Execute("SET TRANSACTION ".$transaction_mode);
	}
	
	/*
		Usage:
		
		$this->BeginTrans();
		$this->RowLock('table1,table2','table1.id=33 and table2.id=table1.id'); # lock row 33 for both tables
		
		# some operation on both tables table1 and table2
		
		$this->CommitTrans();
		
		See http://www.swynk.com/friends/achigrik/SQL70Locks.asp
	*/
	function RowLock($tables,$where,$col='1 as adodbignore') 
	{
		if ($col == '1 as adodbignore') $col = 'top 1 null as ignore';
		if (!$this->transCnt) $this->BeginTrans();
		return $this->GetOne("select $col from $tables with (ROWLOCK,HOLDLOCK) where $where");
	}
	 
	function SelectDB($dbName) 
	{
		$this->database = $dbName;
		$this->databaseName = $dbName; # obsolete, retained for compat with older adodb versions
		if ($this->_connectionID) {
            $rs = $this->Execute('USE '.$dbName); 
            if($rs) {
                return true;
            } else return false;		
		}
		else return false;	
	}
	
	function ErrorMsg() 
	{
		$retErrors = sqlsrv_errors(SQLSRV_ERR_ALL);
		if($retErrors != null) {
			foreach($retErrors as $arrError) {
				$this->_errorMsg .= "SQLState: ".$arrError[ 'SQLSTATE']."\n";
				$this->_errorMsg .= "Error Code: ".$arrError[ 'code']."\n";
				$this->_errorMsg .= "Message: ".$arrError[ 'message']."\n";
			}
		} else {
			$this->_errorMsg = "No errors found";
		}
		return $this->_errorMsg;
	}
	
	function ErrorNo() 
	{
		if ($this->_logsql && $this->_errorCode !== false) return $this->_errorCode;
		$err = sqlsrv_errors(SQLSRV_ERR_ALL);
        if($err[0]) return $err[0]['code'];
        else return -1;
	}
	
	// returns true or false
	function _connect($argHostname, $argUsername, $argPassword, $argDatabasename)
	{
		if (!function_exists('sqlsrv_connect')) return null;
		global $connectTime,$connectTimes;
		$startTime1 = microtime();
        $connectionInfo = array("Database"=>$argDatabasename,'UID'=>$argUsername,'PWD'=>$argPassword,"CharacterSet" => "UTF-8");
        if ($this->debug) error_log("<hr>connecting... hostname: $argHostname params: ".var_export($connectionInfo,true));
        //if ($this->debug) error_log("<hr>_connectionID before: ".serialize($this->_connectionID));
        if(!($this->_connectionID = sqlsrv_connect($argHostname,$connectionInfo))) { 
            if ($this->debug) error_log( "<hr><b>errors</b>: ".print_r( sqlsrv_errors(), true));
            return false;
        }
		$endTime1 = microtime();
		$deltaTime1 = microtime_diff($startTime1, $endTime1);
		$connectTime += $deltaTime1;
		$connectTimes = $connectTimes +1;
        //if ($this->debug) error_log(" _connectionID after: ".serialize($this->_connectionID));
        //if ($this->debug) error_log("<hr>defined functions: <pre>".var_export(get_defined_functions(),true)."</pre>");
		return true;	
	}
	
	// returns true or false
	function _pconnect($argHostname, $argUsername, $argPassword, $argDatabasename)
	{
		//return null;//not implemented. NOTE: Persistent connections have no effect if PHP is used as a CGI program. (FastCGI!)
        return $this->_connect($argHostname, $argUsername, $argPassword, $argDatabasename);
	}
	
	function Prepare($sql)
	{
		$stmt = sqlsrv_prepare( $this->_connectionID, $sql);
		if (!$stmt)  return $sql;
		return array($sql,$stmt);
	}
	
	// returns concatenated string
    // MSSQL requires integers to be cast as strings
    // automatically cast every datatype to VARCHAR(255)
    // @author David Rogers (introspectshun)
    function Concat()
    {
        $s = "";
        $arr = func_get_args();

        // Split single record on commas, if possible
        if (sizeof($arr) == 1) {
            foreach ($arr as $arg) {
                $args = explode(',', $arg);
            }
            $arr = $args;
        }

        array_walk($arr, create_function('&$v', '$v = "CAST(" . $v . " AS VARCHAR(255))";'));
        $s = implode('+',$arr);
        if (sizeof($arr) > 0) return "$s";
        
		return '';
    }
	
	/* 
		Unfortunately, it appears that mssql cannot handle varbinary > 255 chars
		So all your blobs must be of type "image".
		
		Remember to set in php.ini the following...
		
		; Valid range 0 - 2147483647. Default = 4096. 
		mssql.textlimit = 0 ; zero to pass through 

		; Valid range 0 - 2147483647. Default = 4096. 
		mssql.textsize = 0 ; zero to pass through 
	*/
	function UpdateBlob($table,$column,$val,$where,$blobtype='BLOB')
	{
	
		if (strtoupper($blobtype) == 'CLOB') {
			$sql = "UPDATE $table SET $column='" . $val . "' WHERE $where";
			return $this->Execute($sql) != false;
		}
		$sql = "UPDATE $table SET $column=0x".bin2hex($val)." WHERE $where";
		return $this->Execute($sql) != false;
	}
	
	// returns query ID if successful, otherwise false
	function _query($sql,$inputarr=false)
	{
		//global $queryTime,$queryTimes,$root_directory;
		//$startTime1 = microtime();
		$this->_errorMsg = false;
		if (is_array($inputarr)) {
            $rez = sqlsrv_query($this->_connectionID,$sql,$inputarr,array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
		} else if (is_array($sql)) {
            $rez = sqlsrv_query($this->_connectionID,$sql[1],$inputarr,array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
		} else {
			$rez = sqlsrv_query($this->_connectionID,$sql,array(),array( "Scrollable" => SQLSRV_CURSOR_KEYSET));
		}
		//$endTime1 = microtime();
		//$deltaTime1 = microtime_diff($startTime1, $endTime1);
		//$queryTime += $deltaTime1;
		//$queryTimes = $queryTimes + 1;
		//$logfilename = $root_directory."logs/sql.log";
		//file_put_contents($logfilename, $sql.",querytime:".$deltaTime1."\n", FILE_APPEND);
        if ($this->debug) error_log("<hr>running query: ".var_export($sql,true)."<hr>input array: ".var_export($inputarr,true)."<hr>result: ".var_export($rez,true));//"<hr>connection: ".serialize($this->_connectionID)
        //fix for returning true on anything besides select statements
        if (is_array($sql)) $sql = $sql[1];
        $sql = ltrim($sql);
        if(stripos($sql, 'SELECT') !== 0 && $rez !== false) {
            if ($this->debug) error_log(" isn't a select query, returning boolean true");
            return true;
        }
        //end fix
        if(!$rez) $rez = false;
		return $rez;
	}
	
	// returns true or false
	function _close()
	{ 
		if ($this->transCnt) $this->RollbackTrans();
		$rez = @sqlsrv_close($this->_connectionID);
		$this->_connectionID = false;
		return $rez;
	}
	
	// mssql uses a default date like Dec 30 2000 12:00AM
	function UnixDate($v)
	{
		return ADORecordSet_array_mssql::UnixDate($v);
	}
	
	function UnixTimeStamp($v)
	{
		return ADORecordSet_array_mssql::UnixTimeStamp($v);
	}	

	function &MetaIndexes($table,$primary=false, $owner = false)
	{
		$table = $this->qstr($table);

		$sql = "SELECT i.name AS ind_name, C.name AS col_name, USER_NAME(O.uid) AS Owner, c.colid, k.Keyno, 
			CASE WHEN I.indid BETWEEN 1 AND 254 AND (I.status & 2048 = 2048 OR I.Status = 16402 AND O.XType = 'V') THEN 1 ELSE 0 END AS IsPK,
			CASE WHEN I.status & 2 = 2 THEN 1 ELSE 0 END AS IsUnique
			FROM dbo.sysobjects o INNER JOIN dbo.sysindexes I ON o.id = i.id 
			INNER JOIN dbo.sysindexkeys K ON I.id = K.id AND I.Indid = K.Indid 
			INNER JOIN dbo.syscolumns c ON K.id = C.id AND K.colid = C.Colid
			WHERE LEFT(i.name, 8) <> '_WA_Sys_' AND o.status >= 0 AND O.Name LIKE $table
			ORDER BY O.name, I.Name, K.keyno";

		global $ADODB_FETCH_MODE;
		$save = $ADODB_FETCH_MODE;
        $ADODB_FETCH_MODE = ADODB_FETCH_NUM;
        if ($this->fetchMode !== FALSE) {
        	$savem = $this->SetFetchMode(FALSE);
        }
        
        $rs = $this->Execute($sql);
        if (isset($savem)) {
        	$this->SetFetchMode($savem);
        }
        $ADODB_FETCH_MODE = $save;

        if (!is_object($rs)) {
        	return FALSE;
        }

		$indexes = array();
		while ($row = $rs->FetchRow()) {
			if (!$primary && $row[5]) continue;
			
            $indexes[$row[0]]['unique'] = $row[6];
            $indexes[$row[0]]['columns'][] = $row[1];
    	}
        return $indexes;
	}
	
	function MetaForeignKeys($table, $owner=false, $upper=false)
	{
    	global $ADODB_FETCH_MODE;
	
		$save = $ADODB_FETCH_MODE;
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		$table = $this->qstr(strtoupper($table));
		
		$sql = 
            "select object_name(constid) as constraint_name,
	            col_name(fkeyid, fkey) as column_name,
	            object_name(rkeyid) as referenced_table_name,
   	            col_name(rkeyid, rkey) as referenced_column_name
            from sysforeignkeys
            where upper(object_name(fkeyid)) = $table
            order by constraint_name, referenced_table_name, keyno";
		
		$constraints =& $this->GetArray($sql);
		
		$ADODB_FETCH_MODE = $save;
		
		$arr = false;
		foreach($constraints as $constr) {
			//print_r($constr);
			$arr[$constr[0]][$constr[2]][] = $constr[1].'='.$constr[3]; 
		}
		if (!$arr) return false;
		
		$arr2 = false;
		
		foreach($arr as $k => $v) {
			foreach($v as $a => $b) {
				if ($upper) $a = strtoupper($a);
				$arr2[$a] = $b;
			}
		}
		return $arr2;
	}

	//From: Fernando Moreira <FMoreira@imediata.pt>
	function MetaDatabases() 
	{ 
	    $this->SelectDB("master");
        $rs =& $this->Execute($this->metaDatabasesSQL);
        $rows = $rs->GetRows();
        $ret = array();
        for($i=0;$i<count($rows);$i++) {
            $ret[] = $rows[$i][0];
        }
        $this->SelectDB($this->database);
        if($ret)
            return $ret;
        else 
            return false;
	} 

	// "Stein-Aksel Basma" <basma@accelero.no>
	// tested with MSSQL 2000
	function &MetaPrimaryKeys($table)
	{
    	global $ADODB_FETCH_MODE;
	
		$schema = '';
		$this->_findschema($table,$schema);
		if (!$schema) $schema = $this->database;
		if ($schema) $schema = "and k.table_catalog like '$schema%'"; 

		$sql = "select distinct k.column_name,ordinal_position from information_schema.key_column_usage k,
		information_schema.table_constraints tc 
		where tc.constraint_name = k.constraint_name and tc.constraint_type =
		'PRIMARY KEY' and k.table_name = '$table' $schema order by ordinal_position ";
		
		$savem = $ADODB_FETCH_MODE;
		$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
		$a = $this->GetCol($sql);
		$ADODB_FETCH_MODE = $savem;
		
		if ($a && sizeof($a)>0) return $a;
		$false = false;
		return $false;	  
	}

	
	function &MetaTables($ttype=false,$showSchema=false,$mask=false) 
	{
	    if ($mask) {
			$save = $this->metaTablesSQL;
			$mask = $this->qstr(($mask));
			$this->metaTablesSQL .= " AND name like $mask";
		}
		$ret =& ADOConnection::MetaTables($ttype,$showSchema);

		if ($mask) {
			$this->metaTablesSQL = $save;
		}
		return $ret;
	}


	
   /**
     * This function take in the sql for a union query, the start and offset,
     * and wraps it around an "mssql friendly" limit query
     *
     * @param  string $sql
     * @param  int    $start record to start at
     * @param  int    $count number of records to retrieve
     * @return string SQL statement
     */
    private function handleUnionLimitQuery(
        $sql,
        $start,
        $count
        )
    {
        //set the start to 0, no negs
        if ($start < 0)
            $start=0;

//        $GLOBALS['log']->debug(print_r(func_get_args(),true));

        $this->lastsql = $sql;

        //change the casing to lower for easier string comparison, and trim whitespaces
        $sql = strtolower(trim($sql)) ;

        //set default sql
        $limitUnionSQL = $sql;
        $order_by_str = 'order by';

        //make array of order by's.  substring approach was proving too inconsistent
        $orderByArray = explode($order_by_str, $sql);
        $unionOrderBy = '';
        $rowNumOrderBy = '';

        //count the number of array elements
        $unionOrderByCount = count($orderByArray);
        $arr_count = 0;

        //process if there are elements
        if ($unionOrderByCount){
            //we really want the last ordery by, so reconstruct string
            //adding a 1 to count, as we dont wish to process the last element
            $unionsql = '';
            while ($unionOrderByCount>$arr_count+1) {
                $unionsql .= $orderByArray[$arr_count];
                $arr_count = $arr_count+1;
                //add an "order by" string back if we are coming into loop again
                //remember they were taken out when array was created
                if ($unionOrderByCount>$arr_count+1) {
                    $unionsql .= "order by";
                }
            }
            //grab the last order by element, set both order by's'
            $unionOrderBy = $orderByArray[$arr_count];
            $rowNumOrderBy = $unionOrderBy;

            //if last element contains a "select", then this is part of the union query,
            //and there is no order by to use
            if (strpos($unionOrderBy, "select")) {
                $unionsql = $sql;
                //with no guidance on what to use for required order by in rownumber function,
                //resort to using name column.
                $rowNumOrderBy = 'id';
                $unionOrderBy = "";
            }
        }
        else {
            //there are no order by elements, so just pass back string
            $unionsql = $sql;
            //with no guidance on what to use for required order by in rownumber function,
            //resort to using name column.
            $rowNumOrderBy = 'id';
            $unionOrderBy = '';
        }
        //Unions need the column name being sorted on to match acroos all queries in Union statement
        //so we do not want to strip the alias like in other queries.  Just add the "order by" string and
        //pass column name as is
        if ($unionOrderBy != '') {
            $unionOrderBy = ' order by ' . $unionOrderBy;
        }

        //if start is 0, then just use a top query
        if($start == 0) {
            $limitUnionSQL = "select top $count * from (" .$unionsql .") as top_count ".$unionOrderBy;
        }
        else {
            //if start is more than 0, then use top query in conjunction
            //with rownumber() function to create limit query.
            $limitUnionSQL = "select top $count * from( select ROW_NUMBER() OVER ( order by "
            .$rowNumOrderBy.") AS row_number, * from ("
            .$unionsql .") As numbered) "
            . "As top_count_limit WHERE row_number > $start "
            .$unionOrderBy;
        }

        return $limitUnionSQL;
    }

    public function limitQuery2(
        $sql,
        $start,
        $count,
        $orderby,
		$sorder,
        $dieOnError = false,
        $msg = '')
    {
//      $now=microtime(true);
        $newSQL = $sql;
		$orderby = $orderby." ".$sorder;
		if ($start < 0) $start = 0;
		$matches = array();
		if(javaStrPos($sql,"WHERE") > -1) {
			preg_match("/^(.*SELECT )(.*?FROM.*WHERE.*)$/isU",$sql, $matches);			
		} else {
			preg_match("/^(.*SELECT )(.*?FROM.*)$/isU",$sql, $matches);
		}
		if ($start == 0) {
		   $newSQL = $matches[1] . " TOP $count " . $matches[2];
		   if($orderby != "") {
			   $newSQL .= " order by ".$orderby;
		   }
		}
		else {
			if (!empty($orderby)) {
				//if there is a distinct clause, form query with rownumber after distinct
				$startnum=$start+1;
				$endnum=$start+$count;
				$newSQL = "SELECT * FROM
							(
								" . $matches[1] . " ROW_NUMBER()
								OVER (ORDER BY $orderby) AS row_number,
								" . $matches[2] . "
							) AS a
							WHERE row_number between $startnum and $endnum";

			} else {
				
					$startnum=$start+1;
					$endnum=$start+$count;
					 $newSQL = "SELECT  * FROM
								   (
						  " . $matches[1] . " ROW_NUMBER() OVER (ORDER BY modifiedtime) AS row_number, " . $matches[2] . "
								   )
								   AS a
								   WHERE row_number between $startnum and $endnum";
				
			}
		}

		//$nowend=microtime(true);
		//echo $nowend-$now;
		global $log;
		$log->info("query being executed:".$newSQL);
		$result =  $this->Execute($newSQL);
		//$this->dump_slow_queries($newSQL);
		return $result;

    }

    /**
     * @see DBManager::limitQuery()
     */
    public function limitQuery(
        $sql,
        $start,
        $count,
        $dieOnError = false,
        $msg = '')
    {
//        $now=microtime(true);
        $newSQL = $sql;
        $distinctSQLARRAY = array();
        if (strpos($sql, "UNION") && !preg_match("/(\')(UNION).?(\')/i", $sql))
            $newSQL = $this->handleUnionLimitQuery($sql,$start,$count);
        else {
            if ($start < 0) $start = 0;
            $this->lastsql = $sql;
            $matches = array();
            preg_match("/^(.*SELECT )(.*?FROM.*WHERE)(.*)$/isU",$sql, $matches);
            if (!empty($matches[3])) {
                if ($start == 0) {
                    $match_two = strtolower($matches[2]);
                    if (!strpos($match_two, "distinct")> 0 && strpos($match_two, "distinct") !==0) {
    					//proceed as normal
                    	$newSQL = $matches[1] . " TOP $count " . $matches[2] . $matches[3];
                    }
                    else {
                        $distinct_o = strpos($match_two, "distinct");
                        $up_to_distinct_str = substr($match_two, 0, $distinct_o);
                        //check to see if the distinct is within a function, if so, then proceed as normal
                        if (strpos($up_to_distinct_str,"(")) {
                            //proceed as normal
                            $newSQL = $matches[1] . " TOP $count " . $matches[2] . $matches[3];
                        }
                        else {
                            //if distinct is not within a function, then parse
                            //string contains distinct clause, "TOP needs to come after Distinct"
                            //get position of distinct
                            $match_zero = strtolower($matches[0]);
                            $distinct_pos = strpos($match_zero , "distinct");
                            //get position of where
                            $where_pos = strpos($match_zero, "where");
                            //parse through string
                            $beg = substr($matches[0], 0, $distinct_pos+9 );
                            $mid = substr($matches[0], strlen($beg), ($where_pos+5) - (strlen($beg)));
                            $end = substr($matches[0], strlen($beg) + strlen($mid) );
                            //repopulate matches array
                            $matches[1] = $beg; $matches[2] = $mid; $matches[3] = $end;

                            $newSQL = $matches[1] . " TOP $count " . $matches[2] . $matches[3];
                        }
                    }
                }
                else {
                    $orderByMatch = array();
                    preg_match("/^(.*)(ORDER BY)(.*)$/is",$matches[3], $orderByMatch);

                    //if there is a distinct clause, parse sql string as we will have to insert the rownumber
                    //for paging, AFTER the distinct clause
                    $hasDistinct = strpos(strtolower($matches[0]), "distinct");
                    if ($hasDistinct) {
                        $matches_sql = strtolower($matches[0]);
                        //remove reference to distinct and select keywords, as we will use a group by instead
                        //we need to use group by because we are introducing rownumber column which would make every row unique

                        //take out the select and distinct from string so we can reuse in group by
                        $dist_str = ' distinct ';
                        $distinct_pos = strpos($matches_sql, $dist_str);
                        $matches_sql = substr($matches_sql,$distinct_pos+ strlen($dist_str));
                        //get the position of where and from for further processing
                        $from_pos = strpos($matches_sql , " from ");
                        $where_pos = strpos($matches_sql, "where");
                        //split the sql into a string before and after the from clause
                        //we will use the columns being selected to construct the group by clause
                        if ($from_pos>0 ) {
                            $distinctSQLARRAY[0] = substr($matches_sql,0, $from_pos+1);
                            $distinctSQLARRAY[1] = substr($matches_sql,$from_pos+1);
                            //get position of order by (if it exists) so we can strip it from the string
                            $ob_pos = strpos($distinctSQLARRAY[1], "order by");
                            if ($ob_pos) {
                                $distinctSQLARRAY[1] = substr($distinctSQLARRAY[1],0,$ob_pos);
                            }
                        }

                        //place group by string into array
                        $grpByArr = explode(',', $distinctSQLARRAY[0]);
                        $grpByStr = '';
                        $first = true;
                        //remove the aliases for each group by element, sql server doesnt like these in group by.
                        foreach ($grpByArr as $gb) {
                            $gb = trim($gb);

                            //remove outer reference if they exist
                            if (strpos($gb,"'")!==false){
                                continue;
                            }
                            //if there is a space, then an alias exists, remove alias
                            if (strpos($gb,' ')){
                                $gb = substr( $gb, 0,strpos($gb,' '));
                            }

                            //if resulting string is not empty then add to new group by string
                            if (!empty($gb)) {
                                if ($first) {
                                    $grpByStr .= " $gb";
                                    $first = false;
                                }
                                else {
                                    $grpByStr .= ", $gb";
                                }
                            }
                        }
                    }

                    if (!empty($orderByMatch[3])) {//sql with order by
                        //if there is a distinct clause, form query with rownumber after distinct
                        if ($hasDistinct) {
                            $newSQL = "SELECT TOP $count * FROM
                                        (
                                            SELECT ROW_NUMBER()
                                                OVER (ORDER BY ".$this->returnOrderBy($sql, $orderByMatch[3]).") AS row_number,
                                                count(*) counter, " . $distinctSQLARRAY[0] . "
                                                " . $distinctSQLARRAY[1] . "
                                                group by " . $grpByStr . "
                                        ) AS a
                                        WHERE row_number > $start";
                        }
                        else {
                        $newSQL = "SELECT TOP $count * FROM
                                    (
                                        " . $matches[1] . " ROW_NUMBER()
                                        OVER (ORDER BY " . $this->returnOrderBy($sql, $orderByMatch[3]) . ") AS row_number,
                                        " . $matches[2] . $orderByMatch[1]. "
                                    ) AS a
                                    WHERE row_number > $start";
                        }
                    }else{
						////sql with order by,may be something wrong with sql in order by field
                        $upperQuery = strtoupper($matches[2]);
                        if (!strpos($upperQuery,"JOIN")){
                            $from_pos = strpos($upperQuery , "FROM") + 4;
                            $where_pos = strpos($upperQuery, "WHERE");
                            $tablename = trim(substr($upperQuery,$from_pos, $where_pos - $from_pos));
                        }else{
                            //$tablename = $this->getTableNameFromModuleName($_REQUEST['module'],$sql);
                        }
                        //if there is a distinct clause, form query with rownumber after distinct
                        if ($hasDistinct) {
                             $newSQL = "SELECT TOP $count * FROM
                                            (
                            SELECT ROW_NUMBER() OVER (ORDER BY modifiedtime) AS row_number, count(*) counter, " . $distinctSQLARRAY[0] . "
                                                        " . $distinctSQLARRAY[1] . "
                                                    group by " . $grpByStr . "
                                            )
                                            AS a
                                            WHERE row_number > $start";
                        }
                        else {
                             $newSQL = "SELECT TOP $count * FROM
                                           (
                                  " . $matches[1] . " ROW_NUMBER() OVER (ORDER BY modifiedtime) AS row_number, " . $matches[2] . $matches[3]. "
                                           )
                                           AS a
                                           WHERE row_number > $start";
                        }
                    }
                }
            }
        }


//        $nowend=microtime(true);
//        echo $nowend-$now;
//        echo $newSQL;
        $result =  $this->Execute($newSQL);
//        $this->dump_slow_queries($newSQL);
        return $result;
    }
    
     /**
     * Searches for begginning and ending characters.  It places contents into
     * an array and replaces contents in original string.  This is used to account for use of
     * nested functions while aliasing column names
     *
     * @param  string $p_sql     SQL statement
     * @param  string $strip_beg Beginning character
     * @param  string $strip_end Ending character
     * @param  string $patt      Optional, pattern to
     */
    private function removePatternFromSQL(
        $p_sql,
        $strip_beg,
        $strip_end,
        $patt = 'patt')
    {
        //strip all single quotes out
        $beg_sin = 0;
        $sec_sin = 0;
        $count = substr_count ( $p_sql, $strip_beg);
        $increment = 1;
        if ($strip_beg != $strip_end)
            $increment = 2;

        $i=0;
        $offset = 0;
        $strip_array = array();
        while ($i<$count) {
            $beg_sin = strpos($p_sql, $strip_beg, $offset);
            if (!$beg_sin)
                break;
            $sec_sin = strpos($p_sql, $strip_end, $beg_sin+1);
            $strip_array[$patt.$i] = substr($p_sql, $beg_sin, $sec_sin - $beg_sin +1);
            if ($increment > 1) {
                //we are in here because beginning and end patterns are not identical, so search for nesting
                $exists = strpos($strip_array[$patt.$i], $strip_beg );
                if ($exists>=0) {
                    $nested_pos = (strrpos($strip_array[$patt.$i], $strip_beg ));
                    $strip_array[$patt.$i] = substr($p_sql,$nested_pos+$beg_sin,$sec_sin - ($nested_pos+$beg_sin)+1);
                    $p_sql = substr($p_sql, 0, $nested_pos+$beg_sin) . " ##". $patt.$i."## " . substr($p_sql, $sec_sin+1);
                    $i = $i + 1;
                    $beg_sin = $nested_pos;
                    continue;
                }
            }
            $p_sql = substr($p_sql, 0, $beg_sin) . " ##". $patt.$i."## " . substr($p_sql, $sec_sin+1);
            //move the marker up
            $offset = $sec_sin+1;

            $i = $i + 1;
        }
        $strip_array['sql_string'] = $p_sql;

        return $strip_array;
    }

      /**
     * adds a pattern
     *
     * @param  string $token
     * @param  array  $pattern_array
     * @return string
     */
	private function addPatternToSQL(
        $token,
        array $pattern_array
        )
    {
        //strip all single quotes out
        $pattern_array = array_reverse($pattern_array);

        foreach ($pattern_array as $key => $replace) {
            $token = str_replace( "##".$key."##", $replace,$token);
        }

        return $token;
    }

    /**
     * gets an alias from the sql statement
     *
     * @param  string $sql
     * @param  string $alias
     * @return string
     */
	private function getAliasFromSQL(
        $sql,
        $alias
        )
    {
        $matches = array();
        preg_match("/^(.*SELECT)(.*?FROM.*WHERE)(.*)$/isU",$sql, $matches);
        //parse all single and double  quotes out of array
        $sin_array = $this->removePatternFromSQL($matches[2], "'", "'","sin_");
        $new_sql = array_pop($sin_array);
        $dub_array = $this->removePatternFromSQL($new_sql, "\"", "\"","dub_");
        $new_sql = array_pop($dub_array);

        //search for parenthesis
        $paren_array = $this->removePatternFromSQL($new_sql, "(", ")", "par_");
        $new_sql = array_pop($paren_array);

        //all functions should be removed now, so split the array on comma's
        $mstr_sql_array = split(",", $new_sql);
        foreach($mstr_sql_array as $token ) {
            if (strpos($token, $alias)) {
                //found token, add back comments
                $token = $this->addPatternToSQL($token, $paren_array);
                $token = $this->addPatternToSQL($token, $dub_array);
                $token = $this->addPatternToSQL($token, $sin_array);

                //log and break out of this function
                return $token;
            }
        }
        return null;
    }


    /**
     * Finds the alias of the order by column, and then return the preceding column name
     *
     * @param  string $sql
     * @param  string $orderMatch
     * @return string
     */
    private function findColumnByAlias(
        $sql,
        $orderMatch
        )
    {
        //change case to lowercase
        $sql = strtolower($sql);

        //check for the alias plus a space and comma
        $found_in_sql = strpos($sql, $orderMatch." ,");

        //if no match found, then try with no space and comma
        if(!$found_in_sql)
            $found_in_sql = strpos($sql, $orderMatch.",");

        //set default for found variable
        $found = $found_in_sql;

        //if still no match found, then we need to parse through the string
        if (!$found_in_sql){
            //get count of how many times the match exists in string
            $found_count = substr_count($sql, $orderMatch);
            $i = 0;
            $first_ = 0;
            $len = strlen($orderMatch);
            //loop through string as many times as there is a match
            while ($found_count > $i) {
                //get the first match
                $found_in_sql = strpos($sql, $orderMatch,$first_);
                //make sure there was a match
                if($found_in_sql){
                    //grab the next 2 individual characters
                    $str_plusone = substr($sql,$found_in_sql + $len,1);
                    $str_plustwo = substr($sql,$found_in_sql + $len+1,1);
                    //if one of those characters is a comma, then we have our alias
                    if ($str_plusone === "," || $str_plustwo === ","){
                        //keep track of this position
                        $found = $found_in_sql;
                    }
                }
                //set the offset and increase the iteration counter
                $first_ = $found_in_sql+$len;
                $i = $i+1;
            }
        }
        //return $found, defaults have been set, so if no match was found it will be a negative number
        return $found;
    }



        /**
     * Return the order by string to use in case the column has been aliased
     *
     * @param  string $sql
     * @param  string $orig_order_match
     * @return string
     */
    private function returnOrderBy(
        $sql,
        $orig_order_match
        )
    {
        $sql = strtolower($sql);
        $orig_order_match = trim($orig_order_match);
        if (strpos($orig_order_match, "."))
            //this has a tablename defined, pass in the order match
            return $orig_order_match;

        //grab first space in order by
        $firstSpace = strpos($orig_order_match, " ");

        //split order by into column name and ascending/descending
        $orderMatch = " " . strtolower(substr($orig_order_match, 0, $firstSpace));
        $asc_desc =  substr($orig_order_match,$firstSpace);

        //look for column name as an alias in sql string
        $found_in_sql = $this->findColumnByAlias($sql, $orderMatch);

        if (!$found_in_sql) {
            //check if this column needs the tablename prefixed to it
            $orderMatch = ".".trim($orderMatch);
            $colMatchPos = strpos($sql, $orderMatch);
            if ($colMatchPos !== false) {
                //grab sub string up to column name
                $containsColStr = substr($sql,0, $colMatchPos);
                //get position of first space, so we can grab table name
                $lastSpacePos = strrpos($containsColStr, " ");
                //use positions of column name, space before name, and length of column to find the correct column name
                $col_name = substr($sql, $lastSpacePos, $colMatchPos-$lastSpacePos+strlen($orderMatch));
				//bug 25485. When sorting by a custom field in Account List and then pressing NEXT >, system gives an error
				$containsCommaPos = strpos($col_name, ",");
				if($containsCommaPos !== false) {
					$col_name = substr($col_name, $containsCommaPos+1);
				}
                //return column name
                return $col_name;
            }
            //break out of here, log this
//            $GLOBALS['log']->debug("No match was found for order by, pass string back untouched as: $orig_order_match");
            return $orig_order_match;
        }
        else {
            //if found, then parse and return
            //grab string up to the aliased column
//            $GLOBALS['log']->debug("order by found, process sql string");

            $psql = (trim($this->getAliasFromSQL($sql, $orderMatch )));
            if (empty($psql))
                $psql = trim(substr($sql, 0, $found_in_sql));

            //grab the last comma before the alias
            $comma_pos = strrpos($psql, " ");
            //substring between the comma and the alias to find the joined_table alias and column name
            $col_name = substr($psql,0, $comma_pos);

            //make sure the string does not have an end parenthesis
            //and is not part of a function (i.e. "ISNULL(leads.last_name,'') as name"  )
            //this is especially true for unified search from home screen

            if(strpos($psql, " as "))
                $alias_beg_pos = strpos($psql, " as ");
            else
                $alias_beg_pos = strpos($psql, " ");

            $col_name = substr($psql,0, $alias_beg_pos );
            //add the "asc/desc" order back
            $col_name = $col_name. " ". $asc_desc;

            //pass in new order by
//            $GLOBALS['log']->debug("order by being returned is " . $col_name);
            return $col_name;
        }
    }

	function &SelectLimit($sql,$nrows=-1,$offset=-1, $inputarr=false,$secs2cache=0)
	{
//		if ($nrows > 0 && $offset <= 0) {
//			$sql = preg_replace(
//				'/(^\s*select\s+(distinctrow|distinct)?)/i','\\1 '.$this->hasTop." $nrows ",$sql);
//			$rs =& $this->Execute($sql,$inputarr);
//		} else
//			$rs =& ADOConnection::SelectLimit($sql,$nrows,$offset,$inputarr,$secs2cache);
              $start=$offset;
              $count=$nrows;
              $rs=$this->limitQuery($sql, $start,$count);
	
		return $rs;
	}
}
	
/*--------------------------------------------------------------------------------------
	 Class Name: Recordset
--------------------------------------------------------------------------------------*/

class ADORecordset_mssqlnative extends ADORecordSet {	

	var $databaseType = "mssqlnative";
	var $canSeek = true;
	var $fieldOffset = 0;
	var $previousfields=array();
	// _mths works only in non-localised system
	
	function ADORecordset_mssqlnative($id,$mode=false)
	{
		if ($mode === false) { 
			global $ADODB_FETCH_MODE;
			$mode = $ADODB_FETCH_MODE;

		}
		$this->fetchMode = $mode;
		return $this->ADORecordSet($id,$mode);
	}
	
	
	function _initrs()
	{
	    global $ADODB_COUNTRECS;	
		/*
        if ($this->connection->debug) error_log("(before) ADODB_COUNTRECS: {$ADODB_COUNTRECS} _numOfRows: {$this->_numOfRows} _numOfFields: {$this->_numOfFields}");
        /*$retRowsAff = sqlsrv_rows_affected($this->_queryID);//"If you need to determine the number of rows a query will return before retrieving the actual results, appending a SELECT COUNT ... query would let you get that information, and then a call to next_result would move you to the "real" results."
        error_log("rowsaff: ".serialize($retRowsAff));
		$this->_numOfRows = ($ADODB_COUNTRECS)? $retRowsAff:-1;
        $this->_numOfRows = -1;//not supported
        $fieldmeta = sqlsrv_field_metadata($this->_queryID);
        $this->_numOfFields = ($fieldmeta)? count($fieldmeta):-1;
        if ($this->connection->debug) error_log("(after) _numOfRows: {$this->_numOfRows} _numOfFields: {$this->_numOfFields}");
		*/
		//add support for driver 1.1
		$this->_numOfRows = ($ADODB_COUNTRECS)? @sqlsrv_num_rows($this->_queryID):-1;
		$this->_numOfFields = @sqlsrv_num_fields($this->_queryID);
	}
	

	//Contributed by "Sven Axelsson" <sven.axelsson@bokochwebb.se>
	// get next resultset - requires PHP 4.0.5 or later
	function NextRecordSet()
	{
		if (!sqlsrv_next_result($this->_queryID)) return false;
		$this->_inited = false;
		$this->bind = false;
		$this->_currentRow = -1;
		$this->Init();
		return true;
	}

	/* Use associative array to get fields array */
	function Fields($colname)
	{
		if ($this->fetchMode != ADODB_FETCH_NUM) return $this->fields[$colname];
		if (!$this->bind) {
			$this->bind = array();
			for ($i=0; $i < $this->_numOfFields; $i++) {
				$o = $this->FetchField($i);
				$this->bind[strtoupper($o->name)] = $i;
			}
		}
		
		return $this->fields[$this->bind[strtoupper($colname)]];
	}
	
	/*	Returns: an object containing field information. 
		Get column information in the Recordset object. fetchField() can be used in order to obtain information about
		fields in a certain query result. If the field offset isn't specified, the next field that wasn't yet retrieved by
		fetchField() is retrieved.	*/

	function &FetchField($fieldOffset = -1) 
	{
        if ($this->connection->debug) error_log("<hr>fetchfield: $fieldOffset, fetch array: <pre>".print_r($this->fields,true)."</pre> backtrace: ".adodb_backtrace(false));
		if ($fieldOffset != -1) $this->fieldOffset = $fieldOffset;
		/*
		$arrKeys = array_keys($this->fields);
		if(array_key_exists($this->fieldOffset,$arrKeys) && !array_key_exists($arrKeys[$this->fieldOffset],$this->fields)) {
			$f = false;
		} else {
			$f = $this->fields[ $arrKeys[$this->fieldOffset] ];
			if($fieldOffset == -1) $this->fieldOffset++;
		}

        if (empty($f)) {
            $f = false;//PHP Notice: Only variable references should be returned by reference
        }
		print_r($f);
		*/
		$metadatas=sqlsrv_field_metadata($this->_queryID);
		$f=$metadatas[$this->fieldOffset];
		if($fieldOffset == -1) $this->fieldOffset++;
		return new MSSQLMetaData($f);
	}
	
	function _seek($row) 
	{
		if($row!=0){
			return sqlsrv_fetch($this->_queryID,SQLSRV_SCROLL_ABSOLUTE,$row-1);
		}else{
			return sqlsrv_fetch($this->_queryID,SQLSRV_SCROLL_ABSOLUTE,$row);
		}
		//return false;//There is no support for cursors in the driver at this time.  All data is returned via forward-only streams.
	}
	
		/**
	 * Random access to a specific row in the recordset. Some databases do not support
	 * access to previous rows in the databases (no scrolling backwards).
	 *
	 * @param rowNumber is the row to move to (0-based)
	 *
	 * @return true if there still rows available, or false if there are no more rows (EOF).
	 */
	function Move($rowNumber = 0) 
	{
		$this->EOF = false;
		if ($rowNumber == $this->_currentRow) return true;
		if ($rowNumber >= $this->_numOfRows)
	   		if ($this->_numOfRows != -1) $rowNumber = $this->_numOfRows-2;

		
		if ($this->canSeek) { 
	
			
				
				if ($this->move_fetch($rowNumber)) {
					$this->_currentRow = $rowNumber;
					return true;
				}
			
		} 
		
		$this->fields = false;	
		$this->EOF = true;
		return false;
	}
	// speedup
	function MoveNext() 
	{
        if ($this->connection->debug) error_log("movenext()");
        //if ($this->connection->debug) error_log("eof (beginning): ".$this->EOF);
		if ($this->EOF) return false;
		
		$this->_currentRow++;
        if ($this->connection->debug) error_log("_currentRow: ".$this->_currentRow);
		
		if ($this->_fetch()) return true;
		$this->EOF = true;
        //if ($this->connection->debug) error_log("eof (end): ".$this->EOF);
		
		return false;
	}
	
	function move_fetch($rownum) 
	{
       // add relative offset for poor performance--no use
	   // add cache for previous field 
	    if(isset($this->previousfields[$rownum])){
			$this->fields=$this->previousfields[$rownum];
			sqlsrv_fetch($this->_queryID,SQLSRV_SCROLL_ABSOLUTE,$rownum);
			return $this->fields;
		}
		$current_row=$this->_currentRow;
		if($current_row>=0&&$current_row<$this->_numOfRows){
			$is_absolute=false;
			$relativeoffset=$rownum-$current_row;
		}else{
			$is_absolute=true;
		}
        if ($this->connection->debug) error_log("_fetch()");
		if ($this->fetchMode & ADODB_FETCH_ASSOC) {
			if ($this->fetchMode & ADODB_FETCH_NUM) {
                if ($this->connection->debug) error_log("fetch mode: both");
				if($is_absolute){
					$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_BOTH,SQLSRV_SCROLL_ABSOLUTE,$rownum);
				}else{
					$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_BOTH,SQLSRV_SCROLL_RELATIVE,$relativeoffset);
				}
			} else {
                if ($this->connection->debug) error_log("fetch mode: assoc");
				if($is_absolute){
					$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_ASSOC,SQLSRV_SCROLL_ABSOLUTE,$rownum);
				}else{
					$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_ASSOC,SQLSRV_SCROLL_RELATIVE,$relativeoffset);
				}
			}
			
			if (ADODB_ASSOC_CASE == 0) {
				foreach($this->fields as $k=>$v) {
					$this->fields[strtolower($k)] = $v;
				}
			} else if (ADODB_ASSOC_CASE == 1) {
				foreach($this->fields as $k=>$v) {
					$this->fields[strtoupper($k)] = $v;
				}
			}
		} else {
            if ($this->connection->debug) error_log("fetch mode: num");
			if($is_absolute){
				$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_NUMERIC,SQLSRV_SCROLL_ABSOLUTE,$rownum);
			}else{
				$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_NUMERIC,SQLSRV_SCROLL_RELATIVE,$relativeoffset);
			}
		}
		$metadatahash=$this->get_rs_metadata($this->_queryID);
        if(is_array($this->fields) && array_key_exists(1,$this->fields) && !array_key_exists(0,$this->fields)) {//fix fetch numeric keys since they're not 0 based 
            $arrFixed = array();
            foreach($this->fields as $key=>$value) {
                if(is_numeric($key)) {
                    $arrFixed[$key-1] = $value;
                } else {
                    $arrFixed[$key] = $value;
                }
            }
            //if($this->connection->debug) error_log("<hr>fixing non 0 based return array, old: ".print_r($this->fields,true)." new: ".print_r($arrFixed,true));
            $this->fields = $arrFixed;
        }
		if(is_array($this->fields)) {
			foreach($this->fields as $key=>$value) {
				if (is_object($value) && method_exists($value, 'format')) {//is DateTime object
					$this->fields[$key] = $value->format("Y-m-d H:i:s");
				}
				if(isset($metadatahash[$key])&&$metadatahash[$key]==2) $this->fields[$key] =(double)$value;
			}
		}
        if($this->fields === null) $this->fields = false;
        if ($this->connection->debug) error_log("<hr>after _fetch, fields: <pre>".print_r($this->fields,true)." backtrace: ".adodb_backtrace(false));
		if($this->fields) $this->previousfields=array($rownum=>$this->fields);
		return $this->fields;
	}
	
	function get_rs_metadata($stmt) {
		$metadatas=sqlsrv_field_metadata($stmt);
		$metadataHash=array();
		foreach($metadatas as $metadata){
			$metadataHash[$metadata['Name']]=$metadata['Type'];
		}
		return $metadataHash;
	}
	
	// INSERT UPDATE DELETE returns false even if no error occurs in 4.0.4
	// also the date format has been changed from YYYY-mm-dd to dd MMM YYYY in 4.0.4. Idiot!
	function _fetch($ignore_fields=false) 
	{
        if ($this->connection->debug) error_log("_fetch()");
		if ($this->fetchMode & ADODB_FETCH_ASSOC) {
			if ($this->fetchMode & ADODB_FETCH_NUM) {
                if ($this->connection->debug) error_log("fetch mode: both");
				$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_BOTH);
			} else {
                if ($this->connection->debug) error_log("fetch mode: assoc");
				$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_ASSOC);
			}
			
			if (ADODB_ASSOC_CASE == 0) {
				foreach($this->fields as $k=>$v) {
					$this->fields[strtolower($k)] = $v;
				}
			} else if (ADODB_ASSOC_CASE == 1) {
				foreach($this->fields as $k=>$v) {
					$this->fields[strtoupper($k)] = $v;
				}
			}
		} else {
            if ($this->connection->debug) error_log("fetch mode: num");
			$this->fields = @sqlsrv_fetch_array($this->_queryID,SQLSRV_FETCH_BOTH);
		}
		$metadatahash=$this->get_rs_metadata($this->_queryID);
        if(is_array($this->fields) && array_key_exists(1,$this->fields) && !array_key_exists(0,$this->fields)) {//fix fetch numeric keys since they're not 0 based 
            $arrFixed = array();
            foreach($this->fields as $key=>$value) {
                if(is_numeric($key)) {
                    $arrFixed[$key-1] = $value;
                } else {
                    $arrFixed[$key] = $value;
                }
            }
            //if($this->connection->debug) error_log("<hr>fixing non 0 based return array, old: ".print_r($this->fields,true)." new: ".print_r($arrFixed,true));
            $this->fields = $arrFixed;
        }
		if(is_array($this->fields)) {
			foreach($this->fields as $key=>$value) {
				if (is_object($value) && method_exists($value, 'format')) {//is DateTime object
					$this->fields[$key] = $value->format("Y-m-d H:i:s ");
				}
				if(isset($metadatahash[$key])&&$metadatahash[$key]==2) $this->fields[$key] =(double)$value;
			}
		}
        if($this->fields === null) $this->fields = false;
        if ($this->connection->debug) error_log("<hr>after _fetch, fields: <pre>".print_r($this->fields,true)." backtrace: ".adodb_backtrace(false));
		return $this->fields;
	}
	
    /*	close() only needs to be called if you are worried about using too much memory while your script
		is running. All associated result memory for the specified result identifier will automatically be freed.	*/
	function _close() 
	{
		$rez = sqlsrv_free_stmt($this->_queryID);	
		$this->_queryID = false;
		return $rez;
	}

	// mssql uses a default date like Dec 30 2000 12:00AM
	function UnixDate($v)
	{
		return ADORecordSet_array_mssqlnative::UnixDate($v);
	}
	
	function UnixTimeStamp($v)
	{
		return ADORecordSet_array_mssqlnative::UnixTimeStamp($v);
	}
}


class ADORecordSet_array_mssqlnative extends ADORecordSet_array {
	function ADORecordSet_array_mssqlnative($id=-1,$mode=false) 
	{
		$this->ADORecordSet_array($id,$mode);
	}
	
		// mssql uses a default date like Dec 30 2000 12:00AM
	function UnixDate($v)
	{
	
		if (is_numeric(substr($v,0,1)) && ADODB_PHPVER >= 0x4200) return parent::UnixDate($v);
		
    	global $ADODB_mssql_mths,$ADODB_mssql_date_order;
	
		//Dec 30 2000 12:00AM 
		if ($ADODB_mssql_date_order == 'dmy') {
			if (!preg_match( "|^([0-9]{1,2})[-/\. ]+([A-Za-z]{3})[-/\. ]+([0-9]{4})|" ,$v, $rr)) {
				return parent::UnixDate($v);
			}
			if ($rr[3] <= TIMESTAMP_FIRST_YEAR) return 0;
			
			$theday = $rr[1];
			$themth =  substr(strtoupper($rr[2]),0,3);
		} else {
			if (!preg_match( "|^([A-Za-z]{3})[-/\. ]+([0-9]{1,2})[-/\. ]+([0-9]{4})|" ,$v, $rr)) {
				return parent::UnixDate($v);
			}
			if ($rr[3] <= TIMESTAMP_FIRST_YEAR) return 0;
			
			$theday = $rr[2];
			$themth = substr(strtoupper($rr[1]),0,3);
		}
		$themth = $ADODB_mssql_mths[$themth];
		if ($themth <= 0) return false;
		// h-m-s-MM-DD-YY
		return  mktime(0,0,0,$themth,$theday,$rr[3]);
	}
	
	function UnixTimeStamp($v)
	{
	
		if (is_numeric(substr($v,0,1)) && ADODB_PHPVER >= 0x4200) return parent::UnixTimeStamp($v);
		
	    global $ADODB_mssql_mths,$ADODB_mssql_date_order;
	
		//Dec 30 2000 12:00AM
		 if ($ADODB_mssql_date_order == 'dmy') {
			 if (!preg_match( "|^([0-9]{1,2})[-/\. ]+([A-Za-z]{3})[-/\. ]+([0-9]{4}) +([0-9]{1,2}):([0-9]{1,2}) *([apAP]{0,1})|"
			,$v, $rr)) return parent::UnixTimeStamp($v);
			if ($rr[3] <= TIMESTAMP_FIRST_YEAR) return 0;
		
			$theday = $rr[1];
			$themth =  substr(strtoupper($rr[2]),0,3);
		} else {
			if (!preg_match( "|^([A-Za-z]{3})[-/\. ]+([0-9]{1,2})[-/\. ]+([0-9]{4}) +([0-9]{1,2}):([0-9]{1,2}) *([apAP]{0,1})|"
			,$v, $rr)) return parent::UnixTimeStamp($v);
			if ($rr[3] <= TIMESTAMP_FIRST_YEAR) return 0;
		
			$theday = $rr[2];
			$themth = substr(strtoupper($rr[1]),0,3);
		}
		
		$themth = $ADODB_mssql_mths[$themth];
		if ($themth <= 0) return false;
		
		switch (strtoupper($rr[6])) {
		case 'P':
			if ($rr[4]<12) $rr[4] += 12;
			break;
		case 'A':
			if ($rr[4]==12) $rr[4] = 0;
			break;
		default:
			break;
		}
		// h-m-s-MM-DD-YY
		return  mktime($rr[4],$rr[5],0,$themth,$theday,$rr[3]);
	}
}

class MSSQLMetaData {
	var $name;
	var $type;
	function MSSQLMetaData($f) {
		$this->name=iconv_ec("GBK","UTF-8",$f['Name']);
		$this->type=$this->realtype($f['Type']);
	}

	function realtype($type) {
		$transfermap=array(-5=>'bigint',-2=>'binary',-7=>'bit',1=>'char',91=>'date',93=>'datetime',93=>'datetime2',-155=>'datetimeoffset',3=>'decimal',6=>'float',-4=>'image',4=>'int',3=>'money',-8=>'nchar',-10=>'ntext',2=>'numeric',-9=>'nvarchar',7=>'real',93=>'smalldatetime',5=>'smallint',3=>'smallmoney',-1=>'text',-154=>'time',-2=>'timestamp',-6=>'tinyint',-151=>'udt',-11=>'uniqueidentifier',-3=>'varbinary',12=>'varchar',-152=>'xml');
		return $transfermap[$type];
	}
}
/*
Code Example 1:

select 	object_name(constid) as constraint_name,
       	object_name(fkeyid) as table_name, 
        col_name(fkeyid, fkey) as column_name,
	object_name(rkeyid) as referenced_table_name,
   	col_name(rkeyid, rkey) as referenced_column_name
from sysforeignkeys
where object_name(fkeyid) = x
order by constraint_name, table_name, referenced_table_name,  keyno

Code Example 2:
select 	constraint_name,
	column_name,
	ordinal_position
from information_schema.key_column_usage
where constraint_catalog = db_name()
and table_name = x
order by constraint_name, ordinal_position

http://www.databasejournal.com/scripts/article.php/1440551
*/

?>