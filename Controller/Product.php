<?php

class Controller_Product extends Controller_Core_Action
{
	public function gridAction()
	{	
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Product_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Product_Edit');
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=product&a=grid');
		}
	}

	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
			$productModel = Ccc::getModel('Product');
			$id = $this->getRequest()->getParams('id');
			if (!$id) 
			{
				throw new Exception("Id Not Found", 1);
			}
			if(!$product = $productModel->load($id)) 
			{
				throw new Exception("Invaild Request.", 1);
			}
			$edit = new Block_Product_Edit();
			$content = $layout->getChild('content')->addChild('edit',$edit);
			$edit->setData(['product'=>$product]);
			$layout->render();
		}  
		catch (Exception $e) 
		{
			throw new Exception("Product Not Found", 1);			
		}
		$this->getView()->getTemplate('edit');
	}


	public function saveAction()
	{
		try 
		{
			$url = Ccc::getModel('Core_Url');
			if(!$this->getRequest()->isPost())
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($productData = $this->getRequest()->getPost('product')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			$productModel = Ccc::getModel('Product');
			if($product_id = $this->getRequest()->getParams('id'))
			{
				if(!($productModel = $productModel->load($product_id))->load($product_id,'product_id'))
				{
					throw new Exception("Invaild Request.", 1);
				}
			}
			if($productModel->product_id)
			{
				$productModel->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$productModel->created_at = date('Y-m-d H:i:s');
			}
			$productModel->setData($productData);
			if(!($insert_id = $productModel->save()))
			{
				throw new Exception("Invaild Request.", 1);
			}
		}
			catch (Exception $e) 
		{

		}
			$this->redirect('index.php?c=product&a=grid');
	}

	public function deleteAction()
	{
		try 
		{
			$productModel = Ccc::getModel('Product');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$product_id = $request->getParams('id');
			if (!$product_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$product = $productModel->load($product_id)->delete();
			if(!$product)
			{
				throw new Exception("Data can not deleted.", 1);
			}
		} 
		catch (Exception $e) 
		{
		}
		$this->redirect($url->getUrl('grid'));
	}
}

?>