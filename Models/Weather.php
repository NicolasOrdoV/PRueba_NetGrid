<?php 

/**
 * Modelo Clima
 */
class Weather
{
	
	private $pdo;

	public function __construct()
	{
		try {
			$this->pdo = new Conexion;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function saveWeather($data)
	{
		try {
			$this->pdo->insert("clima", $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$strSql = "SELECT * FROM clima WHERE id_us = $id";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getAllCities($country)
	{
		try {
			$strSql = "SELECT * FROM ciudad WHERE nombre_pais = '$country' limit 20";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}