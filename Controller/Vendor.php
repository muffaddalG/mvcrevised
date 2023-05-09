<?php

class Controller_Vendor extends Controller_Core_Action
{
	public function gridAction()
	{

		$layout = $this->getLayout();
		$grid = $layout->createBlock('Vendor_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();

	}

	public function addAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Vendor_Edit');
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=vendor&a=grid');
		}
	}
	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Vendor_Edit');
			$vendorModel = Ccc::getModel('Vendor');
			$vendorAddressModel = Ccc::getModel('Vendor_Address');
			if(!($vendor_id = $this->getRequest()->getParams('id')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($vendor = $vendorModel->load($vendor_id)) || !($vendor_address = $vendorAddressModel->load($vendor_id,'vendor_id')))
		{
			throw new Exception("Error Processing Request", 1);
		}
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$edit->setData(['vendor'=>$vendor, 'vendor_address'=>$vendor_address]);
			$layout->render();			
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=vendor&a=grid');
		
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
			if(!($vendorData = $this->getRequest()->getPost('vendor')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($vendoraddressData = $this->getRequest()->getPost('vendor_address')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			$vendorModel = Ccc::getModel('Vendor');
			$vendor_address = Ccc::getModel('Vendor_Address');
			if($vendor_id = $this->getRequest()->getParams('id'))
			{
				if(!($vendorModel = $vendorModel->load($vendor_id)) || !($vendor_address = $vendor_address->load($vendor_id,'vendor_id')))
				{
					throw new Exception("Invaild Request.", 1);
				}
			}
			if($vendorModel->vendor_id)
			{
				$vendorModel->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$vendorModel->created_at = date('Y-m-d H:i:s');
			}
			$vendorModel->setData($vendorData);
			if(!($insert_id = $vendorModel->save()))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!$vendor_address->address_id)
			{
				$vendor_address->vendor_id = $insert_id;
			}
			$vendor_address->setData($vendoraddressData);
			if(!$vendor_address->save())
			{
				throw new Exception("Invaild Request.", 1);
			}
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=vendor&a=grid');
	}

	public function deleteAction()
	{
		try 
		{
			$vendorModel = Ccc::getModel('Vendor');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$vendor_id = $request->getParams('id');
			if (!$vendor_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$vendor = $vendorModel->load($vendor_id)->delete();
			if(!$vendor)
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