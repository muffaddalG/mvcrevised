<?php

  
class Model_Vendor_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
	$this->setTableName('vendor');
    $this->setPrimaryKey('vendor_id');	
    }

    public function getStatusOptions()
    {
        return [
            Model_Vendor::STATUS_ACTIVE => Model_Vendor::STATUS_ACTIVE_lBl,
            Model_Vendor::STATUS_INACTIVE => Model_Vendor::STATUS_INACTIVE_lBl
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