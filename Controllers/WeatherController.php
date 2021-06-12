<?php 

require "Models/Weather.php";
require "Models/City.php";
/**
 * controlador clima
 */
class WeatherController
{
	private $model;
	private $city;
	public function __construct()
	{
		$this->model = new Weather;
		$this->city = new City;
	}

	public function index()
	{
		require "Views/Layout.php";
		$cities = $this->city->getAll();
		require "Views/Weather/find.php";
		require "Views/Scripts.php";
	}

	public function save()
	{
		if(isset($_POST['city'])){
			if (!empty($_POST['id_us'])) {
				$city = $_POST['city'];
				$key = '50fdad62d68185b67dd2696047a62a55';
				$url = "http://api.openweathermap.org/data/2.5/weather?id=" . $city . "&lang=es&units=metric&APPID=" . $key;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_VERBOSE, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$response = curl_exec($ch);

				curl_close($ch);
				require "Views/Layout.php";
				$cities = $this->city->getAll();
				$data = json_decode($response);
				$datesWeather = [
					'Descripcion_clima' => $data->weather[0]->description,
					'temp_max' => $data->main->temp_max,
					'temp_min' => $data->main->temp_min,
					'Humedad' => $data->main->humidity,
					'Viento' => $data->wind->speed,
					'id_us' => $_POST['id_us']
				];
				$this->model->saveWeather($datesWeather);
				$currentTime = time();
				require "Views/Weather/find.php";
				require "Views/Scripts.php";
			}else{
				require "Views/Layout.php";
				$cities = $this->city->getAll();
				$message = "Para saber el clima de una ciudad debes loguearte primero";
				require "Views/Weather/find.php";
				require "Views/Scripts.php";
			}
		}
	}

	public function story()
	{
		if (isset($_SESSION['user'])) {
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
				require "Views/Layout.php";
				$data = $this->model->getById($id);
				require "Views/Weather/story.php";
				require "Views/Scripts.php";
			}
		}else{
			header('Location: ?controller=home');
		}
	}
}