<?php

class Model_Customer_Address extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setTableName('customer_address');
		$this->setPrimaryKey('address_id');
	}
}

?>