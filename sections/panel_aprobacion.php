<div id="panel_aprobacion">
	<hr class="solid short">
	<div id="confirmar_seleccion">
		
		<button id="btn_aprobar" type="button" data-a="aprobada"
		class="mb-xs mt-xs mr-xs btn btn-primary adminev">
			<i class="fa fa-check"></i> Aprobar</button>
		
		<button id="btn_rechazar" type="button" data-a="rechazada"
		class="mb-xs mt-xs mr-xs btn btn-primary adminev">
			<i class="fa fa-times"></i> Rechazar</button>

		<?php if( $mismo_dpto ) { 
			// Nominación entre usuarios del mismo departamento. Aprueba solo el VP ?>
			<?php if( $es_aprob_vp ) {  // Aprobación completa y directa por el VP del depto ?>
				
				<?php if( $nominacion["estado"] == "pendiente" ) {  ?>
					<button id="btn_aprobar_vp" type="button" data-a="aprobada"
						class="mb-xs mt-xs mr-xs btn btn-primary vp_ev">
						<i class="fa fa-star"></i> Aprobar</button>
				<?php } ?>

			<?php } else { ?>

				<i class="fa fa-lock"></i> VP del departamento debe aprobar esta nominación

			<?php } ?>

		<?php } else { 
		// Nominación entre usuarios de departamentos diferentes. 
		// Valida primero el VP del depto del nominado y luego pasa a votación ?>

			<?php if( $nominacion["estado"] == "validada" ) { ?>

				<?php if( solicitableSustento( $dbh, $idu, $nominacion )  ) { ?>
				<button id="btn_sustento" type="button" data-a="sustento"
				class="mb-xs mt-xs mr-xs btn btn-primary adminev_s">
					<i class="fa fa-file-o"></i> Solicitar sustento</button>
				<?php } ?>

			<?php } else { ?>

				<?php if( $es_valid_vp ) {  
					// Es evaluable por el VP del depto del nominado ?>
					<button id="btn_validar_vp" type="button" data-a="validada"
						class="mb-xs mt-xs mr-xs btn btn-primary vp_ev">
						<i class="fa fa-check-circle"></i> Validar</button>

					<button id="btn_rechazar" type="button" data-a="rechazada"
						class="mb-xs mt-xs mr-xs btn btn-primary vp_ev">
						<i class="fa fa-times"></i> Rechazar</button>

					<?php if( solicitableSustento2VP( $nominacion ) ) { ?>
						<button id="btn_sustento" type="button" data-a="sustento"
							class="mb-xs mt-xs mr-xs btn btn-primary adminev_s">
							<i class="fa fa-file-o"></i> Solicitar sustento</button>
					<?php } ?>
						
				<?php } else { ?>

					<?php if( $nominacion["estado"] == "pendiente" ) { ?>
						<i class="fa fa-lock"></i> VP del departamento debe validar esta nominación primero
					<?php } ?>

				<?php } ?>
						
			<?php } ?>

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
				<input id="usuariovp" type="hidden" name="es_vp" value="<?php echo $es_valid_vp; ?>">
				<input id="estado_nom" type="hidden" name="estado">
				<input type="hidden" name="idusuario" value="<?php echo $idu;?>">
				<input type="hidden" name="idnominacion" value="<?php echo $idn;?>">
			</div>
		</form>
	</div>
</div>