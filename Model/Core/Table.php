<?php

class Model_Core_Table
{
	protected $data = [];
	protected $resourceClass = 'Model_Core_Table_Resource';
	protected $collectionClass = 'Model_Core_Table_Collection';
	protected $resource = null;
	protected $collection = null;

	function __construct()
	{
		
	}

	public function __set($key, $value)
	{
		$this->data[$key] = $value;
	}

	public function __get($key)
	{
		if (!array_key_exists($key, $this->data)) 
		{
			return null;
		}
		return $this->data[$key];
	}

	public function __unset($key)
	{
		if (!array_key_exists($key, $this->data)) 
		{
			return $this;
		}
		unset ($this->data[$key]);
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->getResource()->setPrimaryKey($primaryKey);
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->getResource()->getPrimaryKey();
	}

	public function setId($id)
	{
		$this->data[$this->getResource()->getPrimaryKey()] = (int) $id;
		return $this;
	}

	public function getId()
	{
		$primaryKey = $this->getResource()->getPrimaryKey();
		return $this->$primaryKey;
	}

	public function setResourceClass($resourceClass)
	{
		$this->resourceClass = $resourceClass;
		return $this;
	}

	public function setResource($resource)
	{
		$this->resource = $resource;
		return $this;
	}

	public function getResource()
	{
		$resourceClass = $this->resourceClass;
		if ($this->resource!=null) 
		{
			return $this->resource;
		}
		$model = new $resourceClass();
		$this->setResource($model);
		return $model;
	}

	public function setCollectionClass($collectionClass)
	{
		$this->collectionClass = $collectionClass;
		return $this;
	}

	public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function getCollection()
	{
		$collectionClass = $this->collectionClass;
		if ($this->collection!=null) 
		{
			return $this->collection;
		}
		$model = new $collectionClass();
		$this->setCollection($model);
		return $model;
	}

	public function setData(array $data)
	{
		$this->data =array_merge($this->data,$data) ;
		return $this;
	}

	public function getData($key=null)
	{
		if ($key == null) 
		{
			return $this->data;
		}
		if (array_key_exists($key, $this->data)) 
		{
			return $this->data[$key];
		}
		return null;
	}

	public function addData($key,$value)
	{
		$this->data[$key] = $value;
		return $this;
	}

	public function removeData($key=null)
	{
		if ($key == null) 
		{
			$this->data = [];
		}
		if (array_key_exists($key,$this->data)) 
		{
			unset($this->data[$key]);
		}
		return $this;
	}

	public function fetchAll($query)
	{
		$result = $this->getResource()->fetchAll($query);
		if (!$result) 
		{
			return false;
		}
		foreach ($result as &$row) {
			$row = (new $this)->setData($row)->setResource($this->getResource())
				->setCollection($this->getCollection());
		}
		$collection = $this->getCollection()->setData($result);
		return $collection;
	}

	public function fetchRow($query)
	{
		$result = $this->getResource()->fetchRow($query);
		if ($result) 
		{
			 $this->data = $result;
			 return $this;
		}
		return false;
	}

	public function delete()
	{
		$id = $this->getData($this->getResource()->getPrimaryKey());
		if (!$id) 
		{
			return false;
		}
		$model = $this->getResource()->delete($id);
		return true;
	}

	public function load($id,$column = null)
	{
		if (!$column) 
		{
			$column = $this->getResource()->getPrimaryKey();
		}
		$query = "SELECT * FROM `{$this->getResource()->getTableName()}` WHERE `{$column}` = '{$id}'";
		$resource = new Model_Core_Table_Resource();
		$result = $resource->fetchRow($query);
		if ($result) {
			 $this->data = $result;
		}
		return $this;
	}

	public function save()
	{
		if($id = $this->getId()){
			$this->removeData($this->getPrimaryKey());
			$result = $this->getResource()->update($this->data, $id);
			if(is_array($id)){
				return $this;
			}
			if(!$result){
				return false;
			}			
			return $this->load($id);			
		}
		else{
			$result = $this->getResource()->insert($this->data);
			if(!$result){
				return false;
			}
			return $this->load($result);
		}
	}
}
?>