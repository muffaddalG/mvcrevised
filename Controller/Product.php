<?php

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$productRow = Ccc::getModel('Product_Row');
			$query = "SELECT * FROM `product`";
			$products = $productRow->fetchAll($query);
			
			$this->getView()->setTemplate('product/grid.phtml')->setData($products);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("Could not fetch products", 1);
		}
		$this->getView()->getTemplate('product/grid.phtml');
	}

	public function addAction()
	{
		$this->getView()->setTemplate('product/add.phtml');
		$this->render();
	}

	public function editAction()
	{
		try 
		{
			$productRow = Ccc::getModel('Product_Row');
			$request = $this->request();
			$product_id = $request->getParams('id');
			if (!$product_id) 
			{
				throw new Exception("ID Not There", 1);
			}
			$product = $productRow->load($product_id);
			$query = "SELECT * FROM `product` WHERE `product_id` = {$product_id}";
			$products = $productRow->fetchRow($query);
			if(!$products)
			{
				throw new Exception("Product Not There", 1);
			}
			$this->getView()->setTemplate('product/edit.phtml')->setData($product);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("Product Not Found", 1);			
		}
		$this->getView()->getTemplate('product/edit.phtml');
	}

	public function saveAction()
	{
		try{
			// echo "<pre>";
			$request=Ccc::getModel('Core_Request');
			
			$data = $request->getPost('product');
			// print_r($data); die();

			if (!$data) {
				throw new Exception("no data posted");
			}
			$id = $request->getParams('id');
			// print_r($id); die();
			if ($id) 
			{
				// echo 111; die();

				$product=Ccc::getModel('Product_Row')->load($id);
				$product->updated_at=date('Y-m-d H:i:s');
				
			}
			else
			{
				$product= Ccc::getModel('Product_Row');
				$product->created_at = date("Y-m-d h:i:s");
				// print_r($product); die();
			}
			$product->setData($data);
			// print_r($product);
			// die;
			$product->save();
			// print_r($result); die();
			
		}
		catch(Exception $e){	
				echo "catch found";
		}
		header("Location: index.php?c=product&a=grid");
	}

	public function deleteAction()
	{
		try 
		{
			$productRow = Ccc::getModel('Product_Row');
			$request = $this->request();
			$product_id = $request->getParams('id');
			if (!$product_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$product = $productRow->load($product_id)->delete();
			if (!$product) 
			{
				throw new Exception("Product Not Deleted.", 1);
			}
			header("Location: index.php?c=product&a=grid");
		} 
		catch (Exception $e) 
		{
			throw new Exception("Product Not Deleted.", 1);	
		}
		header("Location: index.php?c=product&a=grid");
	}
}

?>