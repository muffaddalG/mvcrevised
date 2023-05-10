<?php
 
class Block_Product_Grid extends Block_Core_Grid
{
	public function __construct()
	{
		parent::__construct();
		$this->setTitle('Product Grid');	
	}

	public function getCollection()
	{
		$query = "SELECT count('product_id') FROM `product`";
		$totalRecords = Ccc::getModel('Core_Adapter')->fetchOne($query);
		$currentPage = Ccc::getModel('Core_Request')->getParams('p',1);
		$pager = Ccc::getModel('Core_Pager');
		$pager->setCurrentPage($currentPage)->setTotalRecords($totalRecords);
		$pager->calculate();
		$this->setPager($pager);

		$query = "SELECT * FROM `product` LIMIT $pager->startLimit,$pager->recordPerPage";
		$products = Ccc::getModel('product')->fetchAll($query);
		return $products->getData();
	}

	protected function _prepareColumns()
	{
		$this->addColumn('product_id', [
			'title' => 'Product Id'
		]);

		$this->addColumn('name', [
			'title' => 'Name'
		]);

		$this->addColumn('sku', [
			'title' => 'Sku',
		]);

		$this->addColumn('cost', [
			'title' => 'Cost',
		]);

		$this->addColumn('price', [
			'title' => 'Price',
		]);

		$this->addColumn('quantity', [
			'title' => 'Quantity',
		]);

		$this->addColumn('description', [
			'title' => 'Description',
		]);

		$this->addColumn('status', [
			'title' => 'Status',
		]);

		$this->addColumn('color', [
			'title' => 'Color',
		]);

		$this->addColumn('material', [
			'title' => 'Material',
		]);

		$this->addColumn('created_at', [
			'title' => 'Created Date'
		]);

		$this->addColumn('updated_at', [
			'title' => 'Updated Date'
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
		$this->addButton('product_id', [
			'title' => 'ADD Product',
			'url' => $this->getUrl('add')
		]);

		return parent::_prepareButtons();		
	}
}
?>