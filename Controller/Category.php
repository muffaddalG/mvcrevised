<?php

class Controller_Category extends Controller_Core_Action
{
	public function gridAction()
	{
		$layout = $this->getLayout();
		$grid = $layout->createBlock('Category_Grid');
		$layout->getChild('content')->addChild('grid',$grid);
		$layout->render();
	}

	public function addAction()
	{
		try 
		{
			$layout = $this->getLayout();
		    $edit = $layout->createBlock('Category_Edit');
			$content = $layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} 
		
		catch (Exception $e) 
		{
			$this->redirect('index.php?c=category&a=grid');
		}
	}

	public function editAction()
	{
		try 
		{
			$layout = $this->getLayout();
			$categoryModel = Ccc::getModel('Category');
			$id = $this->getRequest()->getParams('id');
			if (!$id) 
			{
				throw new Exception("Id Not Found", 1);
			}
			if(!$category = $categoryModel->load($id)) 
			{
				throw new Exception("Invaild Request.", 1);
			}
			$edit = new Block_Category_Edit();
			$content = $layout->getChild('content')->addChild('edit',$edit);
			$edit->setData(['category'=>$category]);
			$layout->render();
		}  
		catch (Exception $e) 
		{
			throw new Exception("category Not Found", 1);			
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
			if(!($categoryData = $this->getRequest()->getPost('category')))
			{
				throw new Exception("Invaild Request.", 1);
			}
			$categoryModel = Ccc::getModel('Category');
			if($category_id = $this->getRequest()->getParams('id'))
			{
				if(!($categoryModel = $categoryModel->load($category_id))->load($category_id,'category_id'))
				{
					throw new Exception("Invaild Request.", 1);
				}
			}
			if($categoryModel->category_id)
			{
				$categoryModel->updated_at = date('Y-m-d H:i:s');
			}
			else
			{
				$categoryModel->created_at = date('Y-m-d H:i:s');
			}
			$categoryModel->setData($categoryData);
			if(!($insert_id = $categoryModel->save()))
			{
				throw new Exception("Invaild Request.", 1);
			}
		}
			catch (Exception $e) 
		{

		}
			$this->redirect('index.php?c=category&a=grid');
	}

	public function deleteAction()
	{
		try 
		{
			$categoryModel = Ccc::getModel('Category');
			$url = Ccc::getModel('Core_Url');
			$request = $this->getRequest();
			$category_id = $request->getParams('id');
			if (!$category_id) 
			{
				throw new Exception("ID could not get.", 1);
			}
			$category = $categoryModel->load($category_id)->delete();
			if(!$category)
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