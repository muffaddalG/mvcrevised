<?php 

class Block_Salesman_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('salesman/edit.phtml');
	}

	public function prepareChild()
	{
		$salesmanModel = Ccc::getModel('Salesman');
		$salesmanAddressModel =Ccc::getModel('Salesman_Address');
		$this->setData(['salesman'=>$salesmanModel,'salesman_address'=>$salesmanAddressModel]);
				// print_r($salesmanModel);
	}
}
?>