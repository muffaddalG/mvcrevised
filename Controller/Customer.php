<?php

/**
 * 
 */
class Controller_Customer extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$customerRow = Ccc::getModel('Customer_Row');
			$query = "SELECT * FROM `customer`";
			$customers=$customerRow->fetchAll($query);
			$this->getView()->setTemplate('customer/grid.phtml')->setData($customers);
			$this->render();
		} 
		catch (Exception $e)
		 {
			throw new Exception("could not fetch customer", 1);
		}
		$this->getView()->getTemplate('customer/grid.phtml');
	}

	public function addAction()
	{
		$this->getView()->setTemplate('customer/add.phtml');
		$this->render();
	}

	public function editAction()
	{
		try 
		{
			$customerRow = Ccc::getModel('Customer_Row');
			$customerAddressRow = Ccc::getModel('Customer_Address_Row');
			$request = $this->request();
			$customer_id = $request->getParams('id');
			$customer = $customerRow->load($customer_id);
			$customerAddress = $customerAddressRow->load($customer_id,'customer_id');
			$this->getView()->setTemplate('customer/edit.phtml')->setData(['customer'=>$customer, 'customerAddress'=>$customerAddress])->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Found", 1);			
		}
		$this->getView()->getTemplate('customer/edit.phtml');
	}

	public function saveAction()
	{
		try
		{
			$request = $this->request();
			$customerData = $request->getPost('customer');
			$id=$request->getParams('id');
			if ($id) 
			{
				$customer=Ccc::getModel('Customer_Row')->load($id);
				$customer->updated_at=date('Y-m-d H:i:s');
			}
			else
			{
				$customer= Ccc::getModel('Customer_Row');
				$customer->created_at = date("Y-m-d h:i:s");
			}
			$customer->setData($customerData);
			$customer->save();
			// print_r($customer);
			// die;

			$customerAddressData = $this->request()->getpost('customer_address');
			if ($id = (int)$this->request()->getParams('id')) 
			{
			$customerAddress = Ccc::getModel('Customer_Address_Row')->load($id);
			}
			else
			{
				$customerAddress = Ccc::getModel('Customer_Address_Row');
				$customerAddress->customer_id = $customer->customer_id;
			}
				$customerAddress->setData($customerAddressData);
				$customerAddress->save();
		}
		catch(Exception $e)
		{	
			echo "catch found";
		}
		header("Location: index.php?c=customer&a=grid");
	}

	public function deleteAction()
	{
		try 
		{
			$customerRow = Ccc::getModel('Customer_Row');
			$request = $this->request();
			$customer_id = $request->getParams('id');
			if (!$customer_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$customer = $customerRow->load($customer_id)->delete();
			if (!$customer) 
			{
				throw new Exception("customer Not Deleted.", 1);
			}
			header("Location: index.php?c=customer&a=grid");
		} 
		catch (Exception $e) 
		{
			throw new Exception("customer Not Deleted.", 1);	
		}
		header("Location: index.php?c=customer&a=grid");
	}
}

?>