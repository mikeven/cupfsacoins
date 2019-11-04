<table class="table table-bordered table-striped mb-none" id="datatable-default">
	<thead>
		<tr>
			<th>Nombre completo</th>
			<th>Email</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ( $usuarios as $usuario ){ ?>
		<tr class="gradeX">
			<td>
				<a class="sel_persona" href="#!" 
				data-idp="<?php echo $usuario["idUSUARIO"] ?>"><?php echo $usuario["nombre"]." ".$usuario["apellido"] ?> </a>
			</td>
			<td><?php echo $usuario["email"] ?></td>
		</tr>
		<?php } ?>
	</tbody>
</table>