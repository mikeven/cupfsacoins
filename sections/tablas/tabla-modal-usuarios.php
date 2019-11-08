<table class="table table-bordered table-striped mb-none" id="datatable-default">
	<thead>
		<tr>
			<th>Nombre completo</th>
			<th>Departamento</th>
			<th>Email</th>
			<th>Rol</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $usuarios as $u ){ 
			$roles_u = obtenerRolesUsuario( $dbh, $u["idUSUARIO"] );
		?>
		<tr class="gradeX">
			<td>
				<a class="sel_persona" href="#!" 
				data-idp="<?php echo $u["idUSUARIO"] ?>"><?php echo $u["nombre"]." ".$u["apellido"] ?> </a>
			</td>
			<td><?php echo $u["departamento"] ?></td>
			<td><?php echo $u["email"] ?></td>
			<td>
				<?php foreach ( $roles_u as $r ) { ?>
					<div> <?php echo $r["nombre"] ?></div>
				<?php } ?>
			</td>
		</tr>
		<?php } ?>
	</tbody>
</table>