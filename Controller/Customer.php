<?php

/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Customer_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Customer_Edit');
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=customer&a=grid');
		}
	}

	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Customer_Edit');
			$customerModel = Ccc::getModel('Customer');
			$customerAddressModel = Ccc::getModel('Customer_Address');
			if(!($customer_id = $this->getRequest()->getParams('id')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($customer = $customerModel->load($customer_id)) || !($customer_address = $customerAddressModel->load($customer_id,'customer_id')))
		{
			throw new Exception("Error Processing Request", 1);
		}
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$edit->setData(['customer'=>$customer, 'customer_address'=>$customer_address]);
			$layout->render();			
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=customer&a=grid');
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
			if(!($customerData = $this->getRequest()->getPost('customer')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($customeraddressData = $this->getRequest()->getPost('customer_address')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			$customerModel = Ccc::getModel('Customer');
			$customer_address = Ccc::getModel('Customer_Address');
			if($customer_id = $this->getRequest()->getParams('id'))
			{
				if(!($customerModel = $customerModel->load($customer_id)) || !($customer_address = $customer_address->load($customer_id,'customer_id')))
				{
					throw new Exception("Invaild Request.", 1);
				}
			}
			if($customerModel->customer_id)
			{
				$customerModel->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$customerModel->created_at = date('Y-m-d H:i:s');
			}
			$customerModel->setData($customerData);
			if(!($insert_id = $customerModel->save()))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!$customer_address->address_id)
			{
				$customer_address->customer_id = $insert_id;
			}
			$customer_address->setData($customeraddressData);
			if(!$customer_address->save())
			{
				throw new Exception("Invaild Request.", 1);
			}
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=customer&a=grid');		
	}

	public function deleteAction()
	{
		try 
		{
			$customerModel = Ccc::getModel('Customer');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$customer_id = $request->getParams('id');
			if (!$customer_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$customer = $customerModel->load($customer_id)->delete();
			if(!$customer)
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