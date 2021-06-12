<main class="container">
    <section class="row mt-5 ">
    	<div class="card m-100 m-auto w-100">
		  <div class="card-header justify-content-center">
		  	<a href="?controller=login" class="btn btn-danger">Volver al login</a>
		    <h1 class="text-center">Registrate aqui</h1>
		  </div>
		  <div class="card-body w-100">
		    <form action="?controller=user&method=save" method="post">
		    	<div class="row">
		    		<div class="col-6">
		    			<div class="form-group">
							<label>Nombre*</label>
							<input type="text" name="Nombre" class="form-control" placeholder="Ingresa un nombre">
						</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
							<label>Apellido*</label>
							<input type="text" name="Apellido" class="form-control" placeholder="ingresa un apellido">
						</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-4">
		    			<div class="form-group">
							<label>Ciudad de residencia*</label>
							<input list="city" name="id_ciudad" class="form-control" placeholder="busca tu ciudad de residencia">
							<datalist id="city">
								<?php foreach ($cities as $city) { ?>
									<option value="<?php echo $city->identificador_ciudad?>"><?php echo $city->nombre_ciudad?></option>
								<?php } ?>
							</datalist>
						</div>
		    		</div>
		    		<div class="col-4">
		    			<div class="form-group">
							<label>Correo*</label>
							<input type="email" name="Correo" class="form-control" placeholder="test@test.com">
						</div>
		    		</div>
		    		<div class="col-4">
		    			<div class="form-group">
							<label>Contraseña*</label>
							<input type="password" name="Contrasena" class="form-control" placeholder="*******">
						</div>
		    		</div>
		    	</div>
				<div class="form-group">
					<button class="btn btn-primary m-auto">Ingresar</button>
				</div>
				<?php if (isset($_POST['Nombre'])) { ?>
					<div class="alert alert-success">
						<?php echo $succesfull ?>
					</div>
				<?php }?>
			</form>
		</div>
	</section>	
</main>	