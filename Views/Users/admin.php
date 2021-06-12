<main class="container-fluid">
	<section class="row text-center">
		<div class="col-6 justify-content-between">
			<h1 class="text-center">Usuarios registrados</h1>
			<section class="col-12 m-2">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<th scope="col">#</th>
						<th scope="col">Nombre</th>
						<th scope="col">Apellido</th>
						<th scope="col">Ciudad</th>
						<th scope="col">Correo</th>
						<th scope="col">Estado</th>
						<th scope="col">Acciones</th>
					</thead>
					<tbody>
						<?php foreach ($data as $user) { ?>
							<tr>
								<td><?php echo $user->id?></td>
								<td><?php echo $user->Nombre?></td>
								<td><?php echo $user->Apellido?></td>
								<td><?php echo $user->ciudad?></td>
								<td><?php echo $user->Correo?></td>
								<td><?php echo $user->Estado?></td>
								<td>
									<a href="?controller=user&method=edit&id=<?php echo $user->id?>" class="btn btn-warning">Editar</a>
									<form action="?controller=user&method=delete" method="POST">
										<input type="hidden" name="id" value="<?php echo $user->id?>">
										<button type="submit" class="btn btn-danger"  onclick="return confirm('¿Si quieres borrar este dato?')">Eliminar</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</section>
		</div>
		<div class="col-6 justify-content-between">
			<h1 class="text-center">Mensajes de los usuarios</h1>
			<section class="col-12 m-2">
				<table class="table table-striped table-hover">
					<thead class="thead-dark">
						<th scope="col">Mensaje</th>
						<th scope="col">Correo</th>
					</thead>
					<tbody>
						<?php foreach($messages as $message){ ?>
							<tr>
								<td><?php echo $message->Mensaje ?></td>
								<td><?php echo $message->Correo_usuario ?></td>
							</tr>
						<?php } ?>	
					</tbody>
				</table>
			</section>
		</div>
	</section>
</main>