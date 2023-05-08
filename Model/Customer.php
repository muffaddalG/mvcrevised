<?php

class Model_Customer extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setTableName('customer');
		$this->setPrimaryKey('customer_id');
	}
}

?>