<div id="panel_aprobacion">
	<hr class="solid short">
	<div id="confirmar_seleccion">

		<button id="btn_aprobar" type="button" data-a="aprobada"
		class="mb-xs mt-xs mr-xs btn btn-primary adminev">
			<i class="fa fa-check"></i> Aprobar</button>
		
		<button id="btn_rechazar" type="button" data-a="rechazada"
		class="mb-xs mt-xs mr-xs btn btn-primary adminev">
			<i class="fa fa-times"></i> Rechazar</button>
		
		<?php if( $nominacion["motivo2"] == "" 
				&& $nominacion["sustento2"] == "" 
				&& $nominacion["estado"] == "pendiente" ) { ?>
		<button id="btn_sustento" type="button" data-a="sustento"
		class="mb-xs mt-xs mr-xs btn btn-primary adminev_s">
			<i class="fa fa-file-o"></i> Solicitar sustento</button>
		<?php } ?>
		
	</div>

	<div id="panel_comentario" style="display: none;" class="panel_comentario">
		<hr class="solid short">
		<form id="frm_admineval">
			<div class="form-group">
				<label class="col-sm-12 control-label">Comentario </label>
				<div class="col-sm-12">
					<textarea class="form-control" rows="3" id="textareaAutosize" name="comentario" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;"></textarea>
				</div>
				<input id="estado_nom" type="hidden" name="estado">
				<input type="hidden" name="idusuario" value="<?php echo $idu;?>">
				<input type="hidden" name="idnominacion" value="<?php echo $idn;?>">
			</div>
		</form>
	</div>
</div>