<?php

class Model_Vendor_Address extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setTableName('vendor_address');
		$this->setPrimaryKey('address_id');
	}
}

?>