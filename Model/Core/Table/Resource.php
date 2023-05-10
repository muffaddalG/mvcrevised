<?php

class Model_Core_Table_Resource
{
	public $adapter = null;
	public $tableName = null;
	public $primaryKey = null;

	public function setAdapter(Model_Core_Adapter $adapter)
	{
		$this->adapter = $adapter;
		return $this;
	}

	public function getAdapter()
	{
		if ($this->adapter) 
		{
			return $this->adapter;
		}
		$adapter = Ccc::getModel('Core_Adapter');
		$this->setAdapter($adapter);
		return $adapter;
	}

	public function setTableName($tableName)
	{
		$this->tableName = $tableName;
		return $this;
	}

	public function getTableName()
	{
		return $this->tableName;
	}

	public function setPrimaryKey($primaryKey)
	{
		$this->primaryKey = $primaryKey;
		return $this;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}

	public function fetchAll($query)
	{
		$adapter = $this->getAdapter();
		$result = $adapter->fetchAll($query);
		if(!$result){
			return false;
		}
		return $result;
	}

	public function fetchRow($query)
	{
		$adapter = $this->getAdapter();
		$result = $adapter->fetchRow($query);
		if(!$result){
			return false;
		}
		return $result;
	}

	public function insert($arrayData)
	{
		$keyString = '`'.implode('`,`', array_keys($arrayData)).'`';
		$valueString = "'".implode("','", array_values($arrayData))."'";
		$sql = "INSERT INTO `{$this->getTableName()}` ({$keyString}) VALUES ({$valueString})";
		$result = $this->getAdapter()->insert($sql);
		if(!$result){
			return false;
		}
		return $result;
	}

	public function update($data, $condition)
	{
		if (!$data) 
		{
			throw new Exception("Data not found", 1);
		}
		$final = [];
		foreach ($data as $key => $value) 
		{
			$final[] = "`{$key}` = '{$value}'";
		}
		if (is_array($condition)) 
		{
			$where = [];
			foreach ($data as $key => $value) 
			{
				$where[] = "`{$key}` = '{$value}'";
			}
			$whereString = implode(" AND ", $where);
		} 
		else 
		{
			$whereString = "`{$this->getPrimaryKey()}` = {$condition}";
		}
		$updated = implode(",", $final);
		$query = "UPDATE `{$this->getTableName()}` SET {$updated} WHERE {$whereString}";
		$result = $this->getAdapter()->update($query);
		return $result;
	}

	public function delete($condition)
	{
		if (!$condition) 
		{
			throw new Exception("ENTER THE RECODE.", 1);
		}

		if (is_array($condition)) 
		{
			$where = [];
			foreach ($condition as $key => $value) 
			{
				$where[] = "`{$key}` = '{$value}'";
			}
			$whereString = implode(" AND ", $where);
		}
		else
		{
			$whereString = "`{$this->getPrimaryKey()}`={$condition}";
		}

		$query = "DELETE FROM `{$this->getTableName()}` WHERE $whereString";
		$result = $this->getAdapter()->Delete($query);
		return $result;
	}

	public function load($value, $column=null)
	{
		$column=(!$column) ? $this->getPrimaryKey() : $column;

		$query = "SELECT * FROM `{$this->getTableName()}` WHERE `{$column}` = {$value}";
		
		$result = $this->getAdapter()->fetchRow($query);
		return $result;
	}
}

?>