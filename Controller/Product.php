<?php


class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		$adapter = Ccc::getModel('Core_Adapter');
		$query = "SELECT * FROM `product`";
		$products = $adapter->fetchAll($query);
		require_once 'View/product/grid.phtml';
	}

	public function addAction()
	{
		require_once 'View/product/add.phtml';
	}

	public function insertAction()
	{
		$adapter = Ccc::getModel('Core_Adapter');
		$request = $this->request();
		if (!$request->isPost()) 
		{
		throw new Exception("Error Processing Request", 1);
		}

		$product = $request->getPost('product');
		$created_at = date("Y-m-d h:i:s");
		$query = "INSERT INTO `product`( `name`, `sku`, `cost`, `status` ) VALUES ('$product[name]','$product[sku]','$product[cost]','$product[status]')";
		$insert = $adapter->insert($query);

		if (!$insert) {
		throw new Exception("Unable to insert record.", 1);
		}
		$this->redirect("index.php?c=product&a=grid");
	}

	public function editAction()
	{
		$adapter = Ccc::getModel('Core_Adapter');
		$request = $this->request();
		$id = $request->getParams('id');
		$query = "SELECT * FROM `product` WHERE `product_id` = {$id}";
		$product = $adapter->fetchRow($query);
		require_once 'View/product/edit.phtml';
	}

	public function updateAction()
	{
		$adapter = Ccc::getModel('Core_Adapter');
		$request = $this->request();
		if (!$request->isPost()) 
		{
			throw new Exception("invalid request", 1);
		}
		$product = $request->getPost('product');
		$id =$request->getPost('id');
		if (!$id) 
		{
			throw new Exception("id not found", 1);
			
		}
		$date = date("Y-m-d h:i:s");
		$query = "UPDATE `product` SET `sku`='$product[sku]',`cost`='$product[cost]',`status`='$product[status]' WHERE `product_id` = {$id}";
		$result = $adapter->update($query);
		$this->redirect("index.php?c=product&a=grid");
	}

	public function deleteAction()
	{
		$adapter = Ccc::getModel('Core_Adapter');
		$request = $this->request();
		$id = $_GET['id'];
		if (!$id) 
		{
			throw new Exception("Error Processing Request", 1);
			
		}
		$query = "DELETE FROM `product` WHERE `product_id` = {$id}";
		$result = $adapter->delete($query);
		if (!$result) 
		{
			throw new Exception("cannot delete record", 1);
			
		}
		$this->redirect("index.php?c=product&a=grid");
	}
}

?>