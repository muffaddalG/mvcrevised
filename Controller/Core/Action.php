<?php

class Controller_Core_Action 
{

	public $view= null;

	public function redirect($url)
	{
		header("location:$url");
		exit();
	}
    public function request()
    {
    	return new Model_Core_Request(); 
    }

    public function setView(Model_Core_View $view)
    {
		$this->view = $view;
    }

    public function getView()
    {
    	
		if ($this->view) {
			return $this->view;
		}
		$view = Ccc::getModel('Core_View');
		$this->setView($view);
		return $view;
    }
	public function render()
	{
		return $this->getView()->render();
	}
	
	public function getTemplate($templatePath)
	{
		require_once 'View'.DS.$templatePath;
	}

}
?>