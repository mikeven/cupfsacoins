<?php 
	if ( !$votada ) { 
		if ( $nominacion["votable"] ) {
?>
	<hr class="solid short">
	<div id="panel_voto">
		<button type="button" class="mb-xs mt-xs mr-xs btn btn-success btn-lg cnf-voto" data-valor="si"><i class="fa fa-thumbs-up"></i> </button>
		<button type="button" class="mb-xs mt-xs mr-xs btn btn-danger btn-lg cnf-voto" data-valor="no"><i class="fa fa-thumbs-down"></i> </button>
		<div id="confirmar_seleccion" style="display: none;">
			<hr class="solid short">
			<div>Haga clic en Votar para confirmar su selección</div>
			<form id="nvoto" name="votar">
				<input id="idnominacion" type="hidden" name="idnominacion" value="<?php echo $idn;?>">
				<input id="idusuario" type="hidden" name="idusuario" value="<?php echo $idu;?>">
				<input id="valor_voto" type="hidden" name="voto" value="">
				<button id="btn_votar" type="button" 
				class="mb-xs mt-xs mr-xs btn btn-primary">
					<i class="fa fa-hand-o-down"></i> Votar
				</button>
			</form>
		</div>
	</div>
	<div id="panel_resultado" style="display: none;">
		<i class="fa fa-3x fa-check-square-o"></i>
		Voto registrado
	</div>
<?php } else { ?>
	<hr class="solid short">
	<i class="fa fa-lock"></i> Nominación cerrada para votacion
<?php } ?>	
<?php } ?>