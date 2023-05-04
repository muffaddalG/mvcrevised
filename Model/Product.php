<?php


class Model_Product extends Model_Core_Table
{
	function __construct()
	{
		$this->setTableName('product');
	    $this->setPrimaryKey('product_id');
	}
}

?>