<main class="container">
	<section class="row text-center">
		<div class="col-12 justify-content-between">
			<h1 class="text-center">Ultimos climas consultados</h1>
		</div>
		<section class="col-12 m-2">
			<table class="table table-striped table-hover">
				<thead class="thead-dark">
					<th scope="col">#</th>
					<th scope="col">Descripcion</th>
					<th scope="col">Temperatura maxima</th>
					<th scope="col">Temperatura minima</th>
					<th scope="col">Humedad</th>
					<th scope="col">Viento</th>
				</thead>
				<tbody>
					<?php foreach ($data as $weather) { ?>
						<tr>
							<td><?php echo $weather->id?></td>
							<td><?php echo $weather->Descripcion_clima?></td>
							<td><?php echo $weather->temp_max?></td>
							<td><?php echo $weather->temp_min?></td>
							<td><?php echo $weather->Humedad?></td>
							<td><?php echo $weather->Viento?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</section>
	</section>
</main>