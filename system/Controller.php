<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

/**
 * Controller Class
 * 
 * @author stephen
 */
class Controller {
	
	protected $_controller;
	protected $_action;
	protected $_view;
	protected $_model;
	
	public $renderHeader;
	public $render;

	public function __construct($controller, $action) {
		
		$this->_controller = ucfirst($controller);
		$this->_action = $action;
		
		$model = ucfirst($controller);
		
		if (file_exists(BASEPATH . 'application/models/' . $model . '.php')){
			require_once(BASEPATH . 'application/models/' . $model . '.php');
			$this->_model = new $model;
		}
		
		$this->_view = new View($this->_controller,$this->_action);
		
		$this->renderHeader = 0;
		$this->render = 1;
	}
	
	public function __destruct() {
		if ($this->render) {
			$this->_view->render($this->renderHeader);
		}
	}
}