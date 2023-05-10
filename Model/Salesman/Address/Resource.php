<?php

class Model_Salesman_Address_Resource extends Model_Core_Table_Resource
{
	
	function __construct()
	{
		$this->setTableName('salesman_address')->setPrimaryKey('address_id');

	}
}

?>