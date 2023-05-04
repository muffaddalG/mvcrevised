<?php

class Model_Category extends Model_Core_Table
{
	
	function __construct()
	{
		$this->setTableName('category');
		$this->setPrimaryKey('category_id');
	}
}

?>