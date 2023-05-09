<?php


class Model_Vendor extends Model_Core_Table
{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 2;
	const STATUS_ACTIVE_lBl = 'Active';
	const STATUS_INACTIVE_lBl = 'Inactive';
	const STATUS_DEFAULT = 2;
	const GENDER_MALE = 1;
    const GENDER_MALE_LBL = 'MALE';
    const GENDER_FEMALE = 2;
    const GENDER_FEMALE_LBL = 'FEMALE';
    const GENDER_DEFUALT = 1;

	function __construct()
	{
		 parent::__construct();
        $this->setResourceClass('Model_Vendor_Resource');
        $this->setCollectionClass('Model_Vendor_Collection');
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
	
	
        public function getGenderOptions()
    {
        return [
            self::GENDER_MALE => self::GENDER_MALE_LBL,
            self::GENDER_FEMALE => self::GENDER_FEMALE_LBL,
        ];
    }
    public function  getGenderText()
    {
        $genders = $this->getGenderOptions();
        if (array_key_exists($this->gender, $genders)) {
            return $genders[$this->gender];
        }

        return $genders[self::GENDER_DEFAULT];
    }

    public function getGender()
    {
        if ($this->gender) {
            return $this->gender;
        }

        return self::GENDER_DEFAULT;
    }
}

?>