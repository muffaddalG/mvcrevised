<?php


class Model_Salesman extends Model_Core_Table
{
	function __construct()
	{
		$this->setTableName('salesman');
	    $this->setPrimaryKey('salesman_id');
	}
}

?>