<?php

require 'Models/Message.php';
/**
 * Controlador de mensajes
 */
class MessageController
{
	private $model;

	public function __construct()
	{
		$this->model = new Message;
	}

	public function save()
	{
		if (isset($_POST)) {
			$data = [
				'Mensaje' => $_POST['Mensaje'],
				'Correo_usuario' => $_POST['Correo_usuario'],
				'id_us' => $_POST['id_us']
			];
			$this->model->saveMessage($data);
			require "Views/Layout.php";
			$message = "Tu mensaje se envio correctamente";
			require "Views/Home.php";
			require "Views/Scripts.php";
		}
	}
}