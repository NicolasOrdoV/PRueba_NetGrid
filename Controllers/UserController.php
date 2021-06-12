<?php

require "Models/User.php";
require "Models/City.php";
require "Models/Message.php";
/**
 * Controlador usuarios
 */
class UserController
{
	private $model;
	private $city;
	private $message;

	public function __construct()
	{
		$this->model = new User;
		$this->city = new City;
		$this->message = new Message;
	}

	public function new()
	{
		require "Views/Layout.php";
		$cities = $this->city->getAll();
		require "Views/Users/new.php";
		require "Views/Scripts.php";
	}

	public function save()
	{
		if (isset($_POST)) {
			$data = [
				'Nombre' => $_POST['Nombre'],
				'Apellido' => $_POST['Apellido'],
				'id_ciudad' => $_POST['id_ciudad'],
				'Correo' => $_POST['Correo'],
				'Contrasena' => $_POST['Contrasena'],
				'Rol' => 'User',
				'Estado' => 'Activo'
			];
			$this->model->saveUser($data);
			require "Views/Layout.php";
			$cities = $this->city->getAll();
			$succesfull = "Muchas gracias, por favor ve a iniciar sesion";
			require "Views/Users/new.php";
			require "Views/Scripts.php";
		}
	}

	public function admin()
	{
		if (isset($_SESSION['user'])) {
			require "Views/Layout.php";
			$data = $this->model->getAll();
			$messages = $this->message->getAll();
			require "Views/Users/admin.php";
			require "Views/Scripts.php";
		}else{
			header('Location: ?controller=home');
		}
	}

	public function edit()
	{
		if (isset($_SESSION['user'])) {
			if (isset($_REQUEST['id'])) {
				$id = $_REQUEST['id'];
				require "Views/Layout.php";
				$cities = $this->city->getAll();
				$data = $this->model->getById($id);
				require "Views/Users/edit.php";
			    require "Views/Scripts.php";
			}
		}else{
			header('Location: ?controller=home');
		}
	}

	public function update()
	{
		if (isset($_SESSION['user'])) {
			if (isset($_POST)) {
				$this->model->updateUser($_POST);
				header('Location: ?controller=user&method=admin');
			}
		} else {
			header('Location: ?controller=home');
		}
		
	}

	public function delete()
	{
		if (isset($_SESSION['user'])) {
			$this->model->deleteUser($_POST);
			header('Location: ?controller=user&method=admin');
		} else {
			header('Location: ?controller=home');
		}	
	}
}