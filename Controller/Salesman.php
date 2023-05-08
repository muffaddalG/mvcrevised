<?php

class Controller_Salesman extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$query = "SELECT * FROM `salesman`";
			$salesmans = $salesmanRow->fetchAll($query);
			if(!$salesmans)
			{
				throw new Exception("Could not fetch salesmans", 1);
			}
			$this->getView()->setTemplate('salesman/grid.phtml')->setData($salesmans);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("Could not fetch salesmans", 1);
		}
		$this->getView()->getTemplate('salesman/grid.phtml');
	}

	public function addAction()
	{
		$this->getView()->setTemplate('salesman/add.phtml');
		$this->render();
	}
	
	public function editAction()
	{
		try 
		{
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$salesmanAddressRow = Ccc::getModel('Salesman_Address_Row');
			$request = $this->request();
			$salesman_id = $request->getParams('id');
			$salesman = $salesmanRow->load($salesman_id);
			$salesmanAddress = $salesmanAddressRow->load($salesman_id,'salesman_id');
			$this->getView()->setTemplate('salesman/edit.phtml')->setData(['salesman'=>$salesman, 'salesmanAddress'=>$salesmanAddress])->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("salesman Not Found", 1);			
		}
		$this->getView()->getTemplate('salesman/edit.phtml');
	}

	public function saveAction()
	{
		try
		{
			$request = $this->request();
			$salesmanData = $request->getPost('salesman');
			$id=$request->getParams('id');
			if ($id) 
			{
				$salesman=Ccc::getModel('Salesman_Row')->load($id);
				$salesman->updated_at=date('Y-m-d H:i:s');
			}
			else
			{
				$salesman= Ccc::getModel('Salesman_Row');
				$salesman->created_at = date("Y-m-d h:i:s");
			}
			$salesman->setData($salesmanData);
			$salesman->save();

			$salesmanAddressData = $this->request()->getpost('salesman_address');
			if ($id = (int)$this->request()->getParams('id')) 
			{
			$salesmanAddress = Ccc::getModel('Salesman_Address_Row')->load($id);
			}
			else
			{
				$salesmanAddress = Ccc::getModel('Salesman_Address_Row');
				$salesmanAddress->salesman_id = $salesman->salesman_id;
			}
				$salesmanAddress->setData($salesmanAddressData);
				$salesmanAddress->save();
		}
		catch(Exception $e)
		{	
			echo "catch found";
		}
		header("Location: index.php?c=salesman&a=grid");
	}


	public function deleteAction()
	{
		try 
		{
			$salesmanRow = Ccc::getModel('Salesman_Row');
			$request = $this->request();
			$salesman_id = $request->getParams('id');
			if (!$salesman_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$salesman = $salesmanRow->load($salesman_id)->delete();
			if (!$salesman) 
			{
				throw new Exception("salesman Not Deleted.", 1);
			}
			header("Location: index.php?c=salesman&a=grid");
		} 
		catch (Exception $e) 
		{
			throw new Exception("salesman Not Deleted.", 1);	
		}
		header("Location: index.php?c=salesman&a=grid");
	}
}

?>