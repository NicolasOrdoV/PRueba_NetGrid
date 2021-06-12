<?php

require 'Models/Login.php';

class LoginController
{
    private $model;

    public function __construct()
	{
		$this->model = new Login;
    }
    
    public function index()
	{
		require 'Views/Layout.php';
		require 'Views/Login.php';
		require 'Views/Scripts.php';
    }
    
    public function login()
	{    
		
		$validateUser = $this->model->validateUser($_POST);
		if ($validateUser === true) {
			header('Location: ?controller=home');
	    }else {
			$error = [
				'errorMessage' => $validateUser,
				'email' => $_POST['correo']
			];
			require 'Views/Layout.php';
			require 'Views/login.php';
			require 'Views/Scripts.php';
		}	
	}

	public function logout()
	{
		if ($_SESSION['user']) {
			session_destroy();
			header('Location: ?controller=home');
		} else {
			header('Location: ?controller=home');
		}
	}
}