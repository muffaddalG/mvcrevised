<?php 

class Block_Vendor_Edit extends Block_Core_Template
{
	
	function __construct()
	{
		parent::__construct();
		$this->prepareChild();
		$this->setTemplate('vendor/edit.phtml');
	}

	public function prepareChild()
	{
		$vendorModel = Ccc::getModel('Vendor');
		$vendorAddressModel =Ccc::getModel('Vendor_Address');
		$this->setData(['vendor'=>$vendorModel,'vendor_address'=>$vendorAddressModel]);
				// print_r($vendorModel);
	}
}
?>