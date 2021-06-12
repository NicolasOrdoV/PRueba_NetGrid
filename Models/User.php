<?php
/**
 * Modelo usuarios
 */
class User
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
			$strSql = "SELECT u.*, c.nombre_ciudad as ciudad FROM usuario u
			INNER JOIN ciudad c ON c.identificador_ciudad = u.id_ciudad
			WHERE u.Rol = 'User'";
			$query = $this->pdo->select($strSql);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function saveUser($data)
	{
		try {
			$this->pdo->insert("usuario", $data);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function getById($id)
	{
		try {
			$strSql = "SELECT u.*,c.nombre_ciudad as ciudad FROM usuario u 
			INNER JOIN ciudad c ON c.identificador_ciudad = u.id_ciudad
			WHERE id = :id";
			$array = ['id' => $id];
			$query = $this->pdo->select($strSql, $array);
			return $query;
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function updateUser($data)
	{
		try {
			$strWhere = "id=".$data['id'];
			$this->pdo->update('usuario',$data, $strWhere);		
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}

	public function deleteUser($data)
	{
		try {
			$strWhere = "id=".$data['id'];
			$this->pdo->delete('usuario',$strWhere);
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
}