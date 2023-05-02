<?php

class Model_Core_View
{
	protected $template = null;
 	protected $data = [];

 	public function __construct()
 		{
 			// code...
 		}	
 	public function setTemplate($template)
 	{
 		$this->template = $template;\
 		return $this;
 	}

 	public function getTemplate()
 	{
 		if ($this->template)
 		 {
 			$this->template;
 		}
 		return null;
 	}

 	public function setData($data)
 	{
 		$this->data = $data;
 		return $data;
 	}

 	public function getData()
 	{
 		if ($this->data) 
 		{
 			 return $this->data;
 		}
 		return false;
 	}

 	public function render()
 	{
 		return "VIEW".DS.$this->getTemplate();
 	}


}



?>