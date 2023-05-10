<?php

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Salesman_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Salesman_Edit');
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('grid');
		}
	}
	
	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Salesman_Edit');
			$salesmanModel = Ccc::getModel('Salesman');
			$salesmanAddressModel = Ccc::getModel('Salesman_Address');
			if(!($salesman_id = $this->getRequest()->getParams('id')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($salesman = $salesmanModel->load($salesman_id)) || !($salesman_address = $salesmanAddressModel->load($salesman_id,'salesman_id')))
		{
			throw new Exception("Error Processing Request", 1);
		}
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$edit->setData(['salesman'=>$salesman, 'salesman_address'=>$salesman_address]);
			$layout->render();			
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=salesman&a=grid');
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
			if(!($salesmanData = $this->getRequest()->getPost('salesman')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!($salesmanaddressData = $this->getRequest()->getPost('salesman_address')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			$salesmanModel = Ccc::getModel('Salesman');
			$salesman_address = Ccc::getModel('Salesman_Address');
			if($salesman_id = $this->getRequest()->getParams('id'))
			{
				if(!($salesmanModel = $salesmanModel->load($salesman_id)) || !($salesman_address = $salesman_address->load($salesman_id,'salesman_id')))
				{
					throw new Exception("Invaild Request.", 1);
				}
			}
			if($salesmanModel->salesman_id)
			{
				$salesmanModel->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$salesmanModel->created_at = date('Y-m-d H:i:s');
			}
			$salesmanModel->setData($salesmanData);
			if(!($insert_id = $salesmanModel->save()))
			{
				throw new Exception("Invaild Request.", 1);
			}
			if(!$salesman_address->address_id)
			{
				$salesman_address->salesman_id = $insert_id;
			}
			$salesman_address->setData($salesmanaddressData);
			if(!$salesman_address->save())
			{
				throw new Exception("Invaild Request.", 1);
			}
		} 
		catch (Exception $e) 
		{
		}
			$this->redirect('index.php?c=salesman&a=grid');
	}

	public function deleteAction()
	{
		try 
		{
			$salesmanModel = Ccc::getModel('Salesman');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$salesman_id = $request->getParams('id');
			if (!$salesman_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$salesman = $salesmanModel->load($salesman_id)->delete();
			if(!$salesman)
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