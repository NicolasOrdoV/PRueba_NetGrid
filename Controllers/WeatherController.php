<?php 

require "Models/Weather.php";
require "Models/City.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';
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
			if (!empty($_POST['id_us'])){
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
				$currentTime = time();
				require "Views/Weather/find.php";
				require "Views/Scripts.php";

				//------------------------------------------//
				$strCities = $this->model->getAllCities($data->sys->country);
				$idCities = json_decode(json_encode($strCities),true);

				$dataId = [];
				$dataTemMin = [];

				foreach ($idCities as $llave => $idCity) {
				    $urlProgress = "http://api.openweathermap.org/data/2.5/weather?id=" . $idCity["identificador_ciudad"] . "&lang=es&units=metric&APPID=" . $key;
				    $chId = curl_init();
					curl_setopt($chId, CURLOPT_HEADER, 0);
					curl_setopt($chId, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($chId, CURLOPT_URL, $urlProgress);
					curl_setopt($chId, CURLOPT_FOLLOWLOCATION, 1);
					curl_setopt($chId, CURLOPT_VERBOSE, 0);
					curl_setopt($chId, CURLOPT_SSL_VERIFYPEER, false);
					$responseId = curl_exec($chId);
					curl_close($chId);
				    $dataId[$llave] = json_decode($responseId);
				    $dataId = json_decode(json_encode($dataId),true);
				    // $dataId = intval($dataId[$llave]["main"]["temp_max"]);
				    // $dataId = min($dataId[$llave]["main"]["temp_max"]);
				}


				// echo max($dataId->main->temp_min);

				$datesWeather = [
					'Descripcion_clima' => $data->weather[0]->description,
					'temp_max' => $data->main->temp_max,
					'temp_min' => $data->main->temp_min,
					'Humedad' => $data->main->humidity,
					'Viento' => $data->wind->speed,
					'id_us' => $_POST['id_us']
				];
				$this->model->saveWeather($datesWeather);
				
				$mail = new PHPMailer(true);
				try {
		            //Server settings
		            $mail->SMTPDebug = 0;                      // Enable verbose debug output
		            $mail->isSMTP();                                            // Send using SMTP
		            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
		            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
		            $mail->Username   = 'jnordonez7@misena.edu.co';                     // SMTP username
		            $mail->Password   = 'Colombia2000';                               // SMTP password
		            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
		            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

		            //Recipients
		            $mail->setFrom('jnordonez7@misena.edu.co');
		            $mail->addAddress($_POST['email']);     // Add a recipient

		            // Content
		            $mail->isHTML(true);                                  // Set email format to HTML
		            $mail->Subject = 'Climas del pais';
		            $html = '<h1>Climas del pais- Mas caliente y mas frio</h1>
		                    <div class="card">
						        <div class="card-header">
						        	<h2>Estado del clima del:'.$dataId[2]["name"].'</h2>
						            <div>'.date("l g:i a", $currentTime).'</div>
						            <div>'.date("jS F, Y",$currentTime).'</div>
						            <div>'.ucwords($dataId[2]["weather"][0]["description"]).'</div>
						        </div>
						        <div class="card-body">
						            <img src="http://openweathermap.org/img/w/'.$dataId[2]["weather"][0]["icon"].'.png" class="weather-icon" /> <br>
						            '.$dataId[2]["main"]["temp_max"].'°C <br>
						            <span class="min-temperature">'.$dataId[2]["main"]["temp_min"].'°C</span>
						        </div>
						        <div class="card-footer">
						            <div>Humedad: '.$dataId[2]["main"]["humidity"].' %</div>
						            <div>Viento: '.$dataId[2]["wind"]["speed"] .' km/h</div>
						        </div>
					        </div>
					        <div class="card">
						        <div class="card-header">
						        	<h2>Estado del clima del:'.$dataId[5]["name"].'</div>
						            <div>'.date("jS F, Y",$currentTime).'</div>
						            <div>'.ucwords($dataId[5]["weather"][0]["description"]).'</div>
						        </div>
						        <div class="card-body">
						            <img src="http://openweathermap.org/img/w/'.$dataId[5]["weather"][0]["icon"].'.png" class="weather-icon" /> <br>
						            '.$dataId[5]["main"]["temp_max"].'°C <br>
						            <span class="min-temperature">'.$dataId[5]["main"]["temp_min"].'°C</span>
						        </div>
						        <div class="card-footer">
						            <div>Humedad: '.$dataId[5]["main"]["humidity"].' %</div>
						            <div>Viento: '.$dataId[5]["wind"]["speed"] .' km/h</div>
						        </div>
					        </div>';
		            $mail->Body = $html;
		            $mail->send();
		        } catch (Exception $e) {
		            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		        }
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