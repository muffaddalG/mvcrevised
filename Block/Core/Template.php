<?php
		
class Block_Core_Template extends Model_Core_View
{
	protected $children = [];
	protected $layout = null;
	protected $pager = null;


	public function __construct()
	{
		parent ::__construct();
	}

	public function getLayout()
	{
		return $this->layout ;
	}

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout =$layout;
		return $this;
	}

	public function setChildren(array $children)
	{
		$this->children = $children;
		return $this;
	}

	public function getChildren()
	{
		return $this->children;
	}

	public function getChild($key)
	{
		if (!array_key_exists($key,$this->children)) {
			return false;
		}
		return $this->children[$key];
	}

	public function addChild($key ,$value)
	{
		$this->children[$key] = $value;
		return $this;
	}

	public function removeChildren($key)
	{
		if (!array_key_exists($this->children)) {
			unset($this->children[$key]);
		}
		return $this;
	}
	public function setPager($pager)
	{
		$this->pager = $pager;
		return $this;
	}

	public function getPager()
	{
		if ($this->pager) {
			return $this->pager;
		}
		$pager = new Block_Core_Pager();
		$this->setPager($pager);
		return $pager;
	}
}


?>