<?php

class BANK_DB
{
	protected $prefix = '';
	protected $logged = false;
	 
	private $queries = 0;
	private $log = '';
	
	
	public function fieldName($name)
	{
		return '"' . $name . '"';
	}
	
	public function fieldNames()
	{
		$ret = '';
		
		foreach(func_get_args() as $n)
		{
			$ret .= $this->fieldName($n) . ',';
		}
		$ret[strlen($ret) - 1] = '';
		return $ret;
	}
	public function tableName($name)
	{
		return $this->fieldName($this->prefix . $name);
	}
	
	public function SQLquery($query)
	{
		return query($query);
	}
	
	public function query($query)
	{
		if($this->logged)
		{
			$this->log .= $query . PHP_EOL;
		}
		$this->queries++;
		return parent::query($query);
	}
	public function select($table, $data)
	{
		$fields = array_keys($data);
		$values = array_values($data);
		$query = 'SELECT * FROM'.$this->tableName($table).'WHERE (';
		
		$count = count($fields);
		for($i=0; $i < $count; $i++)
			$query.= $this->fieldName($fields[$i]).' = '.$this->quote($values[$i]).' AND ';
		$query = substr($query, 0 ,-4);
		$query = ');';
		
		$query= $this->query($query);
		if($query->rowCount() != 1) return false;
		return $query->fetch();
	}
	
	public function insert($table, $data)
	{
		$fields = array_keys($data);
		$values = array_values($data);
		$query = 'INSERT INTO '.$this->tableName($table).' (';
		
		foreach($fields as $field){
			$query .= $this->fieldName($field).',';
		}
		$query = substr($query, 0, -1);
		$query .= ') VALUES (';
		foreach($values as $value){
			if($value === null){
				$query .= 'NULL, ';
			}
			else{
				$query .= $this->quote($value).',';
			}
		}
		$query = substr($query, 0, -1);
		$query .= ')';
		
		$this->exec($query);
		return true;
	}
	
    public function replace($table, $data)
	{
		$fields = array_keys($data);
		$values = array_values($data);
		$query = 'REPLACE INTO '.$this->tableName($table).' (';
		foreach ($fields as $field)
			$query.= $this->fieldName($field).',';

		$query = substr($query, 0, -1);
		$query.= ') VALUES (';
		foreach ($values as $value)
			if ($value === null)
				$query.= 'NULL,';
			else
				$query.= $this->quote($value).',';

		$query = substr($query, 0, -1);
		$query .= ')';

		$this->query($query);
		return true;
	}
	
	public function update($table, $data, $where, $limit = 1)
	{
		$fields = array_keys($data);
		$values = array_values($data);

		$query = 'UPDATE '.$this->tableName($table).' SET ';

		$count = count($fields);
		for ($i = 0; $i < $count; $i++)
			$query.= $this->fieldName($fields[$i]).' = '.$this->quote($values[$i]).', ';

		$query = substr($query, 0, -2);
		$query.=' WHERE (';
		$fields = array_keys($where);
		$values = array_values($where);

		$count = count($fields);
		for ($i = 0; $i < $count; $i++)
			$query.= $this->fieldName($fields[$i]).' = '.$this->quote($values[$i]).' AND ';

		$query = substr($query, 0, -4);
		if (isset($limit))
			$query .=') LIMIT '.$limit.';';
		else
			$query .=');';

		$this->exec($query);
		return true;
	}
	
	public function delete($table, $data, $limit = 1)
	{
		$fields = array_keys($data);
		$values = array_values($data);

		$query = 'DELETE FROM ' . $this->tableName($table) . ' WHERE (';

		$count = count($fields);
		for ($i = 0; $i < $count; $i++) {
			$query .= $this->fieldName($fields[$i]) . ' = ' . $this->quote($values[$i]) . ' AND ';
		}

		$query = substr($query, 0, -4);
		if ($limit > 0) {
			$query.=') LIMIT '.$limit.';';
		}
		else {
			$query.=');';
		}

		$this->exec($query);
		return true;
	}
	
	public function limit($limit = false, $offset = false)
    {
       
        $sql = '';

        if($limit !== false)
        {
            $sql = ' LIMIT ' . $limit;

            
            if($offset !== false)
            {
                $sql .= ' OFFSET ' . $offset;
            }
        }

        return $sql;
    }

	public function queries() {
		return $this->queries;
	}

	public function getLog() {
		return $this->log;
	}
}


?>