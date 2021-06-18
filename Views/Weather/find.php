<main class="container">
    <section class="row mt-5 ">
    	<div class="card m-100 m-auto w-80">
		  <div class="card-header justify-content-center">
		    <h1 class="text-center">Consulta el clima de la ciudad que desees</h1>
		  </div>
		  <div class="card-body w-100">
		    <form action="?controller=weather&method=save" method="post">
		    	<input type="hidden" name="id_us" value="<?php echo isset($_SESSION['user']->id) ? $_SESSION['user']->id : '' ?>">
		    	<div class="row">
		    		<div class="col-12">
		    			<div class="form-group">
							<label>Ciudad de residencia*</label>
							<input type="hidden" name="email" value="<?php echo $_SESSION['user']->Correo ?>">
							<input list="city" name="city" class="form-control" placeholder="busca tu ciudad de residencia">
							<datalist id="city">
								<?php foreach ($cities as $city) { ?>
									<option value="<?php echo $city->identificador_ciudad?>"><?php echo $city->nombre_ciudad?></option>
								<?php } ?>
							</datalist>
						</div>
		    		</div>
		    	</div>
				<div class="form-group">
					<button class="btn btn-primary m-auto">Ingresar</button>
				</div>
				<?php if (isset($_POST['city'])) {
				        if(!empty($_POST['id_us'])){ ?>
						<div class="card">
					        <div class="card-header">
					        	<h2>Estado del clima del: <?php echo $data->name; ?></h2>
					            <div><?php echo date("l g:i a", $currentTime); ?></div>
					            <div><?php echo date("jS F, Y",$currentTime); ?></div>
					            <div><?php echo ucwords($data->weather[0]->description); ?></div>
					        </div>
					        <div class="card-body">
					            <img src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png" class="weather-icon" /> <br>
					            <?php echo $data->main->temp_max; ?>°C <br>
					            <span class="min-temperature"><?php echo $data->main->temp_min; ?>°C</span>
					        </div>
					        <div class="card-footer">
					            <div>Humedad: <?php echo $data->main->humidity; ?> %</div>
					            <div>Viento: <?php echo $data->wind->speed; ?> km/h</div>
					        </div>
					    </div>
					<?php }else{ ?> 
						<div class="alert alert-danger">
							<?php echo $message?>
						</div>
					<?php }
				}?>
			</form>
		</div>
	</section>	
</main>	