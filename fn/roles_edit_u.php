<select class="form-control" multiple="multiple" name="rol[]" data-plugin-multiselect id="ms_example0">
	<?php 
		foreach ( $roles as $rl ){  
	?>
		<option value="<?php echo $rl["idROL"] ?>" 
			<?php echo sop_a( $rl["idROL"], $ids_roles_u ); ?>>
			<?php echo $rl["nombre"] ?>
		</option>
	<?php } ?>
</select>