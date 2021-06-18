<main>
	<?php if(isset($_SESSION['user'])){?>
		<section class="container-fluid">
			<div class="row mt-3">
				<div class="col-8 text-center">
					<h1>El clima a tu alcanze</h1>
					<p>Conoce el clima de las ciudades que te parescan, con el fin de planificar viajes y demas.</p>
					<img src="Assets/img/clima.jpg" class="img-fluid" width="800">
				</div>
				<div class="col-4 p-2">
					<div class="card">
						<div class="card-header">
							<h4>¿Deseas dejarnos un comentario?</h4>
						</div>
						<div class="card-body">
							<form action="?controller=message&method=save" method="post">
								<input type="hidden" name="id_us" value="<?php echo $_SESSION['user']->id?>">
								<input type="hidden" name="Correo_usuario" class="form-control" value="<?php echo $_SESSION['user']->Correo ?>">
								<div class="form-group">
									<label>Mensaje</label>
									<textarea name="Mensaje" class="form-control"></textarea>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Enviar</button>
								</div>
							</form>
							<?php if(isset($_POST['Correo_usuario'])){ ?>
								<div class="alert alert-success">
									<?php echo $message; ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php }else{ ?>
		<section class="container-fluid text-center">
			<h1>El clima a tu alcanze</h1>
			<p>Conoce el clima de las ciudades que te parescan, con el fin de planificar viajes y demas.</p>
			<img src="Assets/img/clima.jpg" class="img-fluid" width="900">
		</section>
	<?php } ?>
</main>