<?php 

class Block_Product_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('product/edit.phtml');
	}

	public function prepareChild()
	{
		$productModel = Ccc::getModel('Product');
		$this->setData(['product'=>$productModel]);
				// print_r($productModel);
	}
}
?>