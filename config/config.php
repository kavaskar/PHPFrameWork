<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * Set this to false if in production mode.
 *
 */
	define ('DEVELOPMENT_ENVIRONMENT',true);
	

/*
 *---------------------------------------------------------------
 * Define All other required Constants
 *---------------------------------------------------------------
 */
	
	$subFolder =  str_replace('/index.php', "", $_SERVER['PHP_SELF']);

	// Path to the root folder
	define('BASEPATH', $_SERVER['DOCUMENT_ROOT'].$subFolder.'/');
	
	// 'http://localhost/PHPFrameWork/'
	define ('BASEURL','http://'.$_SERVER['SERVER_NAME'].$subFolder.'/');
	
	//http://localhost/PHPFrameWork/application/views/
	define ('VIEWURL','http://'.$_SERVER['SERVER_NAME'].$subFolder.'/application/views/');
	
	//http://localhost/PHPFrameWork/error
	define ('ERRORURL','http://'.$_SERVER['SERVER_NAME'].$subFolder.'/error');