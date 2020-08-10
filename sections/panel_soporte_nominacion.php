<?php if ( enviaSustento( $idu, $nominacion ) ) { 
	// Solicitar segunda sustentación: 
	// Nominación pendiente por 2do sustento
	// usuario en sesión es el nominador de la nominación actual
?>

<div id="panel_sustento2" class="panel_sustento2">
	<hr class="solid short">
	<h5>Agregar sustentación</h5>
	<form id="frm_asustento" class="form-horizontal form-bordered" action="">
		<div class="form-group">
			<label class="col-sm-3 control-label">Motivo <span class="required">*</span></label>
			<div class="col-sm-9" align="left">
				<textarea class="form-control" rows="3" id="textareaAutosize" name="motivo2" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;" required></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Sustento </label>
			<div class="col-md-9">
				<div class="fileupload fileupload-new" data-provides="fileupload" align="left">
					<div class="input-append">
						<div class="uneditable-input" style="width: 39%;">
							<i class="fa fa-file fileupload-exists"></i>
							<span class="fileupload-preview"></span>
						</div>
						<span class="btn btn-default btn-file">
							<span class="fileupload-exists">Cambiar</span>
							<span class="fileupload-new">Archivo</span>
							<input id="archivo2" type="file" name="archivo"/>
						</span>
						<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Quitar</a>
					</div>
				</div>
			</div>
		</div>

		<input id="idnominacion" type="hidden" name="seg_sustento" value="<?php echo $idn;?>">
		<input id="estado_nom" type="hidden" name="edo_nom" value="<?php echo $nominacion["estado"];?>">

		<!--<div class="row">
			<div class="col-sm-12" align="right">
				<button id="btn_sustento2" class="btn btn-primary">Enviar</button>
			</div>
		</div>-->

	</form>
</div>
<?php } ?>

<?php if ( $nominacion["estado"] == "aprobada" && $nominacion["idNOMINADOR"] == $idu ) { 
	// Nominación aprobada y el usuario en sesión es el nominador de la nominación actual
?>
	<hr class="solid short">
	<div class="accion-adj">
		<a class="adjudicacion" href="#!" data-idn="<?php echo $nominacion["idNOMINACION"]; ?>"
			data-o="full">
			<i class='fa fa-gift'></i> Adjudicar 
		</a>
	</div>

	<div id="panel_comentario_adj" style="display: none;" class="panel_comentario_adj">
		<hr class="solid short">
		<form id="frm_adjudicacion">
			<div class="form-group">
				<label class="col-sm-12 control-label">Saludo para el adjudicado: </label>
				<div class="col-sm-12">
					<textarea class="form-control" rows="3" id="textareaAutosize" name="comentario" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;"></textarea>
				</div>
				<input type="hidden" name="idusuario" value="<?php echo $idu;?>">
				<input type="hidden" name="idnominacion" value="<?php echo $idn;?>">
			</div>
		</form>
	</div>

<?php } ?>
