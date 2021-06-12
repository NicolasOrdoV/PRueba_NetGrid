<?php

/**
 * Controlador Principal
 */
class HomeController
{
	public function index()
	{
		require 'Views/Layout.php';
		require 'Views/Home.php';
		require 'Views/Scripts.php';
	}
}