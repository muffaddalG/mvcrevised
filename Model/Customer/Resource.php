<?php

  
class Model_Customer_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
	$this->setTableName('customer');
    $this->setPrimaryKey('customer_id');	
    }

    public function getStatusOptions()
    {
        return [
            Model_Customer::STATUS_ACTIVE => Model_Customer::STATUS_ACTIVE_lBl,
            Model_Customer::STATUS_INACTIVE => Model_Customer::STATUS_INACTIVE_lBl
        ];
    }

    public function getGenderOptions()
    {
        return [
            self::GENDER_MALE => self::GENDER_MALE_LBL,
            self::GENDER_FEMALE => self::GENDER_FEMALE_LBL,
        ];
    }
}   


?>  