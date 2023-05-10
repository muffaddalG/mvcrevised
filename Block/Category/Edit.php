<?php

/**
 * 
 */
class Block_Category_Edit extends Block_Core_Template
{
	
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('category/edit.phtml');
	}

	public function prepareChild()
	{
		$categoryModel = Ccc::getModel('Category');
		$this->setData(['category'=>$categoryModel]);
				// print_r($categoryModel);
	}
}

?>