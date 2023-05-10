<?php

class Model_Salesman_Address extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setResourceClass('Model_Vendor_Address_Resource')->setCollectionClass('Model_Vendor_Address_Collection');
	}
}

?>