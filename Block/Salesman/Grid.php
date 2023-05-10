<?php



class Block_Salesman_Grid extends Block_Core_Grid
{
	
	function __construct()
	{
		parent::__construct();
		$this->setTitle('MANAGE SALESMAN');
	}

	public function getCollection()
	{
		$query = "SELECT count('salesman_id') FROM `salesman`";
		$totalRecords = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$currentPage = Ccc::getModel('Core_Request')->getParams('p',1);
		$pager = Ccc::getModel('Core_Pager');
		$pager->setCurrentPage($currentPage)->setTotalRecords($totalRecords);
		$pager->calculate();
		$this->setPager($pager);

		$query = "SELECT * FROM `salesman` LIMIT $pager->startLimit,$pager->recordPerPage";
		$salesmans = Ccc::getModel('salesman')->fetchAll($query);
		return $salesmans->getData();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('salesman_id', [
			'title'=>'Salesman_Id'
		]);		
		$this->addColumn('firstname', [
			'title'=>'FirstName'
		]);		
		$this->addColumn('lastname', [
			'title'=>'LastName'
		]);	
		$this->addColumn('email', [
			'title'=>'Email'
		]);		
		$this->addColumn('gender', [
			'title'=>'gender'
		]);			
		$this->addColumn('mobile', [
			'title'=>'Mobile'
		]);		
		$this->addColumn('status', [
			'title'=>'Status'
		]);		
		$this->addColumn('company', [
			'title'=>'Company'
		]);		
		$this->addColumn('created_at', [
			'title'=>'Created At'
		]);
		$this->addColumn('updated_at', [
			'title'=>'Updated At'
		]);

		return parent::_prepareColumns();
	}


	protected function _prepareActions()
	{
		$this->addAction('edit', [
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);		
		$this->addAction('delete', [
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);	

		return parent::_prepareActions();	
	}


	protected function _prepareButtons()
	{
		$this->addButton('salesman_id', [
			'title' => 'ADD Salesman',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();		
	}
}



?>