<?php

class Model_Salesman_Address extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setTableName('salesman_address');
		$this->setPrimaryKey('address_id');
	}
}

?>