<?php

  
class Model_Product_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
    $this->setTableName('product');
    $this->setPrimaryKey('product_id');  
    }

    public function getStatusOptions()
    {
        return [
            Model_Product::STATUS_ACTIVE => Model_Product::STATUS_ACTIVE_lBl,
            Model_Product::STATUS_INACTIVE => Model_Product::STATUS_INACTIVE_lBl
        ];
    }
}   


?>  