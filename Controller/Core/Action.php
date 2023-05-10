<?php

class Controller_Core_Action 
{

	protected $view= null;
    protected $layout = null;
    protected $request = null;
    protected $url = null;
    protected $adapter = null;


    protected function setAdapter(Model_Core_Adapter $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    public function getAdapter()
    {
        if ($this->adapter) 
        {
            return $this->adapter;          
        }
        $adapter = new Model_Core_Adapter();
        $this->setAdapter($adapter); 
        return $adapter;
    }


	public function redirect($url)
    {
        header("location:$url");
        exit();
    }

  public function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if ($this->request) 
		{
			return $this->request;
		}
		$request = Ccc::getModel('Core_Request');
		$this->setRequest($request);
		return $request;
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
	
    public function setLayout($layout)
    {
        $this->layout = $layout;
        return $this;
    }
    public function getLayout()
    {
        if (!$this->layout) {
            $this->layout = new Block_Core_Layout();
        }
        return $this->layout;

    }

}
?>