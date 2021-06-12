<?php 

/**
 * Modelo de mensajes
 */
class Message
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

	public function getAll()
	{
		try {
			$strSql = "SELECT * FROM mensaje";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function saveMessage($data)
	{
		try {
			$this->pdo->insert("mensaje", $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}