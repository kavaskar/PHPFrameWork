<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');


/*
 *---------------------------------------------------------------
 * ERROR REPORTING
 *---------------------------------------------------------------
 *
 * If Envidoment variable is set to tuee.
 */
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', BASEPATH. 'logs/errors/error.log');
	}


/*
 *---------------------------------------------------------------
 * REMOVES MAGIC QUOTES
 *---------------------------------------------------------------
 *
 * Cleans the url
 */
	function stripSlashesDeep($value) {
		
		$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
		return $value;
	}
	
	
	function removeMagicQuotes() {
		
		if ( get_magic_quotes_gpc() ) {
			$_GET    = stripSlashesDeep($_GET   );
			$_POST   = stripSlashesDeep($_POST  );
			$_COOKIE = stripSlashesDeep($_COOKIE);
		}
	}
	
	
	function unregisterGlobals() {
		
		if (ini_get('register_globals')) {
			$array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
			foreach ($array as $value) {
				foreach ($GLOBALS[$value] as $key => $var) {
					if ($var === $GLOBALS[$key]) {
						unset($GLOBALS[$key]);
					}
				}
			}
		}
	}


/*
 *---------------------------------------------------------------
 * Autoloading Classes
 *---------------------------------------------------------------
 *
 * Many developers writing object-oriented applications create one PHP source file per-class definition. 
 * One of the biggest annoyances is having to write a long list of needed includes at the beginning of each script (one for each class).
 * 
 * In PHP 5, this is no longer necessary. You may define an __autoload() function which is automatically called in 
 * case you are trying to use a class/interface which hasn't been defined yet. 
 * By calling this function the scripting engine is given a last chance to load the class before PHP fails with an error.
 * 
 * http://php.net/manual/en/language.oop5.autoload.php
 * 
 */
	function __autoload($name){
		
		if (file_exists(BASEPATH . 'system/' . $name . '.php'))
			require_once(BASEPATH . 'system/' . $name . '.php');
			
		else if (file_exists(BASEPATH . 'application/controllers/' . $name . '.php'))
			require_once(BASEPATH . 'application/controllers/' . $name . '.php');
			
		else if (file_exists(BASEPATH . 'application/helpers/' . $name . '.php'))
			require_once(BASEPATH . 'application/helpers/' . $name . '.php');

		else if (file_exists(BASEPATH . 'application/models/' . $name . '.php'))
			require_once(BASEPATH . 'application/models/' . $name . '.php');
			
		else {
			echo $name,' Class Not Found';
			//header('Location: ' . ERRORURL);
			exit;
		}
	}


/**
 *---------------------------------------------------------------
 * Load a config file
 *---------------------------------------------------------------
 */
	function load_config($name) {
		
		$configuration = array();
		
		if (!file_exists(BASEPATH . 'config/' . $name . '.php'))
			die('The file ' . BASEPATH . 'config/' . $name . '.php does not exist.');
	
		require(BASEPATH . 'config/' . $name . '.php');
			
		if (!isset($config) OR !is_array($config))
			die('The file ' . BASEPATH . 'config/' . $name . '.php file does not appear to be formatted correctly.');
				
		if (isset($config) AND is_array($config))
			$configuration = array_merge($configuration, $config);
		
		return $configuration;
	}
	
	
/**
 *---------------------------------------------------------------
 * Load a Model file
 *---------------------------------------------------------------
 */	
	function load_model($name){
		
		if (file_exists(BASEPATH . 'application/models/' . $name . '.php'))
			require_once(BASEPATH . 'application/models/' . $name . '.php');

		else {
			echo $name,' Class Not Found';
			//header('Location: ' . ERRORURL);
			exit;
		}
	}

	
/**
 *---------------------------------------------------------------
 * Loads a lib file
 *---------------------------------------------------------------
 */	
	function load_lib($name){
		
		if (file_exists(BASEPATH . 'application/library/' . $name . '.php'))
			require_once(BASEPATH . 'application/library/' . $name . '.php');

		else {
			echo $name,' Class Not Found';
			//header('Location: ' . ERRORURL);
			exit;
		}
	}

