<?php

  
class Model_Salesman_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
	$this->setTableName('salesman');
    $this->setPrimaryKey('salesman_id');	
    }

    public function getStatusOptions()
    {
        return [
            Model_Salesman::STATUS_ACTIVE => Model_Salesman::STATUS_ACTIVE_lBl,
            Model_Salesman::STATUS_INACTIVE => Model_Salesman::STATUS_INACTIVE_lBl
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