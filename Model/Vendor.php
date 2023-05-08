<?php


class Model_Vendor extends Model_Core_Table
{
	function __construct()
	{
		$this->setTableName('vendor');
	    $this->setPrimaryKey('vendor_id');
	}
}

?>