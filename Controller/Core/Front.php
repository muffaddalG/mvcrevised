<?php
class Controller_Core_Front
 {
 	
 	public function init()
	{
		$action = new Controller_Core_Action();
		$request = $action->getRequest();
		$controller = $request->getControllerName();
		$action = $request->getActionName().'Action';

		$string_replace = str_replace('_', ' ', $controller);
		$replace = str_replace(' ', '_', ucwords($string_replace));

		$className = "Controller_".ucwords($replace);
		$filePath = str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
		$this->filePath($filePath);
	    $name = new $className;
		$name->$action();
	}

	public function filePath($path)
	{
		require_once getcwd().DIRECTORY_SEPARATOR.$path;
	}
}
	
?>