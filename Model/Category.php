<?php


class Model_Category extends Model_Core_Table
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_lBl = 'Active';
	const STATUS_INACTIVE_lBl = 'Inactive';
	const STATUS_DEFAULT = 2;

	function __construct()
	{
		 parent::__construct();
        $this->setResourceClass('Model_Category_Resource');
        $this->setCollectionClass('Model_Category_Collection');
	}

	public function getStatus()
	{
		if($this->status){
			return $this->status;
		}
		return self::STATUS_DEFAULT;
	}

	public function getStatusText()
	{
		$statuses = $this->getResource()->getStatusOptions();
		if(array_key_exists($this->status, $statuses)){
			return $statuses[$this->status];
		}
		return $statuses[self::STATUS_DEFAULT];
	}
	
}

?>