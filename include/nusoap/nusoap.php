<?php

require_once('include/logging.php');


require_once('include/nusoap/class.nusoap_base.php');

// necessary classes
require_once('include/nusoap/class.soapclient.php');
require_once('include/nusoap/class.soap_val.php');
require_once('include/nusoap/class.soap_parser.php');
require_once('include/nusoap/class.soap_fault.php');

// transport classes
require_once('include/nusoap/class.soap_transport_http.php');

// optional add-on classes
require_once('include/nusoap/class.xmlschema.php');
require_once('include/nusoap/class.wsdl.php');
require_once('include/nusoap/class.wsdlcache.php');


// server class
require_once('include/nusoap/class.soap_server.php');

// class variable emulation
// cf. http://www.webkreator.com/php/techniques/php-static-class-variables.html
$GLOBALS['_transient']['static']['nusoap_base']->globalDebugLevel = 9;
global $soap_log;
$soap_log =& LoggerManager::getLogger('SOAP');

?>