<?php

class Model_Customer_Address_Resource extends Model_Core_Table_Resource
{
	
	function __construct()
	{
		$this->setTableName('customer_address')->setPrimaryKey('address_id');
	}
}

?>