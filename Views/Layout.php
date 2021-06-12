<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width , initial-scale=1.0">
	<title>Prueba NETGRID</title>
	<link rel="stylesheet" type="text/css" href="Assets/css/bootstrap.min.css">
	<link rel="icon" href="Assets/img/2.png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-primary <?php echo ((isset($_SESSION['user'])) && ($_SESSION['user']->Rol == "Admin")) ? 'bg-dark' : 'bg-primary' ?>">
		<a class="navbar-brand text-info" href="?controller=home"><img src="Assets/img/2.png" width="100"></a>
		<?php if(isset($_SESSION['user'])){ ?>
				<p class="text-light mt-3"><?php echo $_SESSION['user']->Nombre." ".$_SESSION['user']->Apellido?></p>
		<?php } ?>	
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		    <span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse justify-content-center" id="navbarNav">
		    <ul class="navbar-nav">
			    <li class="nav-item">
			        <a class="nav-link text-light" href="?controller=weather">Busqueda del clima</a>
			    </li>
			    <?php if(isset($_SESSION['user'])){ ?>
			    	<li class="nav-item">
				        <a class="nav-link text-light" href="?controller=weather&method=story&id=<?php echo $_SESSION['user']->id?>">Ultimas busquedas de clima</a>
				    </li>
				    <li class="nav-item">
				        <a class="nav-link text-light" href="?controller=login&method=logout">Cerrar sesion</a>
				    </li>
			    <?php }else{ ?>	
				    <li class="nav-item">
				        <a class="nav-link text-light" href="?controller=login">Iniciar sesion</a>
				    </li>
				<?php } ?>
				<?php if(isset($_SESSION['user']) && $_SESSION['user']->Rol == "Admin"){ ?>
					<li class="nav-item">
				        <a class="nav-link text-danger" href="?controller=user&method=admin">PANEL DE ADMINISTRACION</a>
				    </li>
				<?php } ?>    
		    </ul>
		</div>
	</nav>
</body>
</html>