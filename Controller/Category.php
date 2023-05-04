<?php

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$query = "SELECT * FROM `category`";
			$categories = $categoryRow->fetchAll($query);
			
			$this->getView()->setTemplate('category/grid.phtml')->setData($categories);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("Could not fetch categories", 1);
		}
		$this->getView()->getTemplate('category/grid.phtml');
	}

	public function addAction()
	{
		$this->getView()->setTemplate('category/add.phtml');
		$this->render();
	}

	public function editAction()
	{try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$request = $this->request();
			$category_id = $request->getParams('id');
			if (!$category_id) 
			{
				throw new Exception("ID Not There", 1);
			}
			$category = $categoryRow->load($category_id);
			$query = "SELECT * FROM `category` WHERE `category_id` = {$category_id}";
			$categorys = $categoryRow->fetchRow($query);
			if(!$categorys)
			{
				throw new Exception("category Not There", 1);
			}
			$this->getView()->setTemplate('category/edit.phtml')->setData($category);
			$this->render();
		} 
		catch (Exception $e) 
		{
			throw new Exception("category Not Found", 1);			
		}
		$this->getView()->getTemplate('category/edit.phtml');
	}

		public function saveAction()
	{
		try{
			// echo "<pre>";
			$request=Ccc::getModel('Core_Request');
			
			$data = $request->getPost('category');
			// print_r($data); die();

			if (!$data) {
				throw new Exception("no data posted");
			}
			$id = $request->getParams('id');
			// print_r($id); die();
			if ($id) 
			{
				// echo 111; die();

				$category=Ccc::getModel('Category_Row')->load($id);
				$category->updated_at=date('Y-m-d H:i:s');
				
			}
			else
			{
				$category= Ccc::getModel('Category_Row');
				$category->created_at = date("Y-m-d h:i:s");
				// print_r($category); die();
			}
			$category->setData($data);
			// print_r($category);
			// die;
			$category->save();
			// print_r($result); die();
			
		}
		catch(Exception $e){	
				echo "catch found";
		}
		header("Location: index.php?c=category&a=grid");
	}
	

	 public function deleteAction()
	 {
	 	try 
		{
			$categoryRow = Ccc::getModel('Category_Row');
			$request = $this->request();
			$category_id = $request->getParams('id');
			if (!$category_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$category = $categoryRow->load($category_id)->delete();
			if (!$category) 
			{
				throw new Exception("category Not Deleted.", 1);
			}
			header("Location: index.php?c=category&a=grid");
		} 
		catch (Exception $e) 
		{
			throw new Exception("Category Not Deleted.", 1);	
		}
		header("Location: index.php?c=category&a=grid");
	}


}


?>