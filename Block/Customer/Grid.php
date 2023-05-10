<?php

class Block_Customer_Grid extends Block_Core_Grid
{
	
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Manage Customers');
	}

	public function getCollection()
	{
		$query = "SELECT count('customer_id') FROM `customer`";
		$totalRecords = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$currentPage = Ccc::getModel('Core_Request')->getParams('p',1);
		$pager = Ccc::getModel('Core_Pager');
		$pager->setCurrentPage($currentPage)->setTotalRecords($totalRecords);
		$pager->calculate();
		$this->setPager($pager);

		$query = "SELECT * FROM `customer` LIMIT $pager->startLimit,$pager->recordPerPage";
		$customers = Ccc::getModel('customer')->fetchAll($query);
		return $customers->getData();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('customer_id',[
			'title' => 'Id'
		]);
		$this->addColumn('first_name',[
			'title' => 'Name'
		]);
		$this->addColumn('last_name',[
			'title' => 'Surname'
		]);
		$this->addColumn('email',[
			'title' => 'Email'
		]);
		$this->addColumn('gender',[
			'title' => 'Gender'
		]);
		$this->addColumn('mobile',[
			'title' => 'Mobile'
		]);
		$this->addColumn('status',[
			'title' => 'Status'
		]);
		$this->addColumn('created_at',[
			'title' => 'Created at'
		]);
		$this->addColumn('updated_at',[
			'title' => 'Updated at'
		]);
		return parent::_prepareColumns();
	}

	protected function _prepareActions()
	{
		$this->addAction('edit',[
			'title' => 'Edit',
			'method' => 'getEditUrl'
		]);
		$this->addAction('delete',[
			'title' => 'Delete',
			'method' => 'getDeleteUrl'
		]);
		return parent::_prepareActions();
	}

	protected function _prepareButtons()
	{
		$this->addButton('customer_id',[
			'title' => 'Add Customer',
			'url' => $this->getUrl('add')
		]);
		return parent::_prepareButtons();
	}

}

?>