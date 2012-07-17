<?php

class AuthenticationController extends Controller {


	private $_authentication;

	function __construct($controller, $action) {
		parent::__construct($controller, $action);
		
		
		
		$this->_authentication = new Authentication();
		
		//CHECK IF THE USER IS LOGGED IN
		if ($this->_authentication->logged_in()) header("Location: " . BASEURL . "welcome");
		
		//LOGIN
		if (isset($_POST['submit'])) {
		
			if ($this->_authentication->login($_POST['username'], $_POST['password']))
				header("Location: " . BASEURL . "welcome");
			else
				$failed = true;
		
		}
	}


	function index() {
		
	}
	
	function logout(){
		
		$this->_authentication->logout();
		$this->render = 0;
	}
}