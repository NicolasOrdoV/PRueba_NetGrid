<main class="container">
    <section class="row mt-5">
        <div class="card w-70 ml-auto mr-auto mt-3 border-success">
            <div class="card-body table-dark w-100">
				<div class="row justify-content-center">
					<img src="Assets/img/2.png" class="img-fluide" width="250">
					<h1 class="col-12 d-flex justify-content-center pb-4">Iniciar Sesión</h1>
				</div>
				<form action="?controller=login&method=login" method="post">

					<?php
						if(isset($error['errorMessage'])) {
					?>
							<div class="alert alert-danger alert-dismissable alert-width" role="alert">
								<button class="close" data-dismiss="alert">&times;</button>
								<p class="text-dark"><?php echo $error['errorMessage']; ?></p>
							</div>
					<?php
						}
					?>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="correo" class="form-control" placeholder="test@test.com" value="<?php echo isset($error['email']) ? $error['email'] : '' ?>">
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" name="contrasena" class="form-control" placeholder="Ingrese su contraseña">
					</div>
					<div class="form-group">
						<button class="btn btn-primary m-auto">Ingresar</button>
					</div>
					<div class="form-group">
						<p>¿No tienes una cuenta?Creala <a href="?controller=user&method=new">Aqui</a> </p>
					</div>
				</form>
			</div>
		</div>
	</section>	
</main>	