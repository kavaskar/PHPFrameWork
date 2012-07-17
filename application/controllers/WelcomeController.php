<?php

class WelcomeController extends Controller {

	function __construct($controller, $action) {
		parent::__construct($controller, $action);
		
		
		$authentication =  new Authentication();
		
		//CHECK IF THE USER IS LOGGED IN
		if (!$authentication->logged_in()) header("Location: " . BASEURL . "authentication/");
	}


	function index() {
		
		
		
	}
}