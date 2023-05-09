<?php 

/**
 * 
 */
class Model_Vendor_Address extends Model_Core_Table
{
	public function __construct()
	{
		$this->setResourceClass('Model_Vendor_Address_Resource')->setCollectionClass('Model_Vendor_Address_Collection');
	}
}