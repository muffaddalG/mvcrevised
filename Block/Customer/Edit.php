<?php

/**
 * 
 */
class Block_Customer_Edit extends Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('customer/edit.phtml');
	}

	public function prepareChild()
	{
		$customerModel = Ccc::getModel('Customer');
		$this->setData(['customer'=>$customerModel]);
				// print_r($customerModel);
	}
}

?>