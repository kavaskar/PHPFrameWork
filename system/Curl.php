<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

/**
 * Curl Class
 * 
 * @author stephen
 */
class Curl {
	
	
	protected $_curlHandler;			// Stores resource handle for the current CURL request
	protected $_connections;
	
	
	function __construct($url, $data=false, $method='POST') {
		
		$this->_connections = false;
		
		if(is_array($url)){
			
			$this->_curlHandler = curl_multi_init();
			$this->_connections = array();
			
			foreach($url as $i=>$_){
				
				$this->_connections[$i] = curl_init($_);
				
				if($data[$i]) $this->setPostData($this->_connections[$i], $data[$i]);
				$this->setOptions($this->_connections[$i], $this->getDefaultOptions(), $method);
				
				curl_multi_add_handle($this->_curlHandler, $this->_connections[$i]);
			}
		}
		else{
			$this->_curlHandler = curl_init($url);
			if($data) $this->setPostData($this->_curlHandler, $data);
			$this->setOptions($this->_curlHandler, $this->getDefaultOptions(), $method);
		}
	}
	
	
	function request(){
		
		if(!$this->_connections){
			
			$result = curl_exec($this->_curlHandler);
			curl_close($this->_curlHandler);
		}
		else{
			
			$running = 0;
			do{
				curl_multi_exec($this->_curlHandler, $running);
			} while ($running > 0);
			
			$result = array();
			foreach($this->_connections as $i=>$_){
				$result[] = curl_multi_getcontent($_);
				curl_multi_remove_handle($this->_curlHandler, $_);
			}
			
			curl_multi_close($this->_curlHandler);
		}
		
		return $result;
	}
	
	
	function multiPostRequest(){
		
		$running = 0;
		do{
			curl_multi_exec($mh, $running);
		} while ($running > 0);
	}
	
	
	function setOptions(&$ch, $options, $method){
		
		foreach ($options as $option => $value) {
			curl_setopt($ch, constant('CURLOPT_'.str_replace('CURLOPT_', '', strtoupper($option))), $value);
		}
		
		switch(strtoupper($method)){
			case 'GET':
				curl_setopt($ch, CURLOPT_HTTPGET, true);		
				break;
			case 'POST':
				curl_setopt($ch, CURLOPT_POST, true); 		// TRUE to do a regular HTTP POST. This POST is the normal application/x-www-form-urlencoded kind, most commonly used by HTML forms.
				break;
		}
	}
	
	
	/**
	 * Array of headers
	 * 
	 * ex. $headers = array("Content-Type: text/xml","Accept-Encoding: gzip")
	 */
	function setHeaders(&$ch, $headers){
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	}
	
	
	function setPostData(&$ch, $data){
		
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	}
	
	
	/**
	 * getDefaultOptions returns the default options for CURL
	 * 
	 * more info can be found at http://php.net/manual/en/function.curl-setopt.php
	 */
	function getDefaultOptions(){
		
		return array(
			'CURLOPT_RETURNTRANSFER' => true,		// TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
			'CURLOPT_HEADER' => false,				// TRUE to include the header in the output.
			'CURLOPT_FOLLOWLOCATION' => true,		// TRUE to follow any "Location: " header that the server sends as part of the HTTP header (note this is recursive, PHP will follow as many "Location: " headers that it is sent, unless CURLOPT_MAXREDIRS is set).
			'CURLOPT_ENCODING' => "",				// The contents of the "Accept-Encoding: " header. This enables decoding of the response. Supported encodings are "identity", "deflate", and "gzip". If an empty string, "", is set, a header containing all supported encoding types is sent.
			'CURLOPT_AUTOREFERER' => true,			// TRUE to automatically set the Referer: field in requests where it follows a Location: redirect.
			'CURLOPT_SSL_VERIFYPEER' => false,		// FALSE to stop cURL from verifying the peer's certificate. Alternate certificates to verify against can be specified with the CURLOPT_CAINFO option or a certificate directory can be specified with the CURLOPT_CAPATH option.
			'CURLOPT_TIMEOUT' => 300				// The maximum number of seconds to allow cURL functions to execute.
		);
	}
}


# ============================================================================ TESTS ============================================================================ #






















