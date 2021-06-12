<?php

require 'config.php';

/**
 * conexion a base de datos
 */
class Conexion extends PDO
{
    	
	public function __construct()
	{
		try {
			parent::__construct(DRIVER.':host='.HOST.';dbname='.DB_NAME.';charset='.CHARSET,USER,PASSWORD);
			$this->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function select($strSql, $arrayData = array(), $fetchMode = PDO::FETCH_OBJ)
	{
		$query = $this->prepare($strSql);

		foreach ($arrayData as $key => $value)
			$query->bindParam(":$key", $value);

		if (!$query->execute())
			echo "Error, la consulta no se realizó";
		else
			return $query->fetchAll($fetchMode);
	}

	public function insert($table, $data)
	{
		try {
			//Ordena un array por su indice
			ksort($data);
			//Eliminar indices de un array
			unset($data['controller'], $data['method']);

			$fieldNames = implode('`, `', array_keys($data));
			$fieldValues = ':' . implode(', :', array_keys($data));
			$strSql = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

			foreach ($data as $key => $value) {
				$strSql->bindValue(":$key", $value);
			}

			$strSql->execute();

		} catch(PDOException $e) {
			die($e->getMessage());
		}		
	}

	public function update($table, $data, $where)
	{
		try {
			ksort($data);
			$fieldDetails=null;
			foreach ($data as $key => $value) {
				$fieldDetails .= "`$key` =:$key,";
			}
			$fieldDetails = rtrim($fieldDetails, ',');

			$strSql = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

			foreach ($data as $key => $value) {
				$strSql->bindValue(":$key", $value);
			}
			$strSql->execute();
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function delete($table, $where)
	{
		try {
			return $this->exec("DELETE FROM $table WHERE $where");
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

}