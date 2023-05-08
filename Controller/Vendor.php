<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$vendorRow = Ccc::getModel('Vendor_Row');
			$query = "SELECT * FROM `vendor`";
			$vendors = $vendorRow->fetchAll($query);
			if(!$vendors)
			{
				throw new Exception("Could not fetch vendors", 1);
			}
			$this->getView()->setTemplate('vendor/grid.phtml')->setData($vendors);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("Could not fetch vendors", 1);
		}
		$this->getView()->getTemplate('vendor/grid.phtml');
	}

	public function addAction()
	{
		$this->getView()->setTemplate('vendor/add.phtml');
		$this->render();
	}
	
	public function editAction()
	{
		try 
		{
			$vendorRow = Ccc::getModel('Vendor_Row');
			$vendorAddressRow = Ccc::getModel('Vendor_Address_Row');
			$request = $this->request();
			$vendor_id = $request->getParams('id');
			$vendor = $vendorRow->load($vendor_id);
			$vendorAddress = $vendorAddressRow->load($vendor_id,'vendor_id');
			$this->getView()->setTemplate('vendor/edit.phtml')->setData(['vendor'=>$vendor, 'vendorAddress'=>$vendorAddress])->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("vendor Not Found", 1);			
		}
		$this->getView()->getTemplate('vendor/edit.phtml');
	}

	public function saveAction()
	{
		try
		{
			$request = $this->request();
			$vendorData = $request->getPost('vendor');
			$id=$request->getParams('id');
			if ($id) 
			{
				$vendor=Ccc::getModel('Vendor_Row')->load($id);
				$vendor->updated_at=date('Y-m-d H:i:s');
			}
			else
			{
				$vendor= Ccc::getModel('Vendor_Row');
				$vendor->inserted_at = date("Y-m-d h:i:s");
			}
			$vendor->setData($vendorData);
			$vendor->save();

			$vendorAddressData = $this->request()->getpost('vendor_address');
			if ($id = (int)$this->request()->getParams('id')) 
			{
			$vendorAddress = Ccc::getModel('vendor_Address_Row')->load($id);
			}
			else
			{
				$vendorAddress = Ccc::getModel('Vendor_Address_Row');
				$vendorAddress->vendor_id = $vendor->vendor_id;
			}
				$vendorAddress->setData($vendorAddressData);
				$vendorAddress->save();
		}
		catch(Exception $e)
		{	
			echo "catch found";
		}
		header("Location: index.php?c=vendor&a=grid");
	}

	public function deleteAction()
	{
		try 
		{
			$vendorRow = Ccc::getModel('Vendor_Row');
			$request = $this->request();
			$vendor_id = $request->getParams('id');
			if (!$vendor_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$vendor = $vendorRow->load($vendor_id)->delete();
			if (!$vendor) 
			{
				throw new Exception("vendor Not Deleted.", 1);
			}
			header("Location: index.php?c=vendor&a=grid");
		} 
		catch (Exception $e) 
		{
			throw new Exception("vendor Not Deleted.", 1);	
		}
		header("Location: index.php?c=vendor&a=grid");
	}
}

?>