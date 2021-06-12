<main class="container">
    <section class="row mt-5 ">
    	<div class="card m-100 m-auto w-100">
		  <div class="card-header justify-content-center">
		    <h1 class="text-center"><a href="?controller=user&method=admin" class="btn btn-danger text-left"><<</a>Datos de <?php echo $data[0]->Nombre." ".$data[0]->Apellido?></h1>
		  </div>
		  <div class="card-body w-100">
		    <form action="?controller=user&method=update" method="post">
		    	<input type="hidden" name="id" value="<?php echo $data[0]->id ?>">
		    	<div class="row">
		    		<div class="col-6">
		    			<div class="form-group">
							<label>Ciudad de residencia*</label>
							<input list="city" name="id_ciudad" class="form-control" placeholder="busca tu ciudad de residencia" value="<?php echo $data[0]->ciudad?>">
							<datalist id="city">
								<?php foreach ($cities as $city) { ?>
									<option value="<?php echo $city->identificador_ciudad?>"><?php echo $city->nombre_ciudad?></option>
								<?php } ?>
							</datalist>
						</div>
		    		</div>
		    		<div class="col-6">
		    			<div class="form-group">
							<label>Correo*</label>
							<input type="email" name="Correo" class="form-control" placeholder="test@test.com" value="<?php echo $data[0]->Correo ?>">
						</div>
		    		</div>
		    	</div>
				<div class="form-group">
					<button class="btn btn-warning m-auto">Actualizar</button>
				</div>
			</form>
		</div>
	</section>	
</main>	