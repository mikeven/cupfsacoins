<?php if ( $nominacion["estado"] == "sustento" && $nominacion["idNOMINADOR"] == $idu ) { 
	// Solicitar segunda sustentación: 
	// Nominación pendiente por 2do sustento
	// usuario en sesión es el nominador de la nominación actual
?>

<div id="panel_sustento2" class="panel_sustento2">
	<hr class="solid short">
	<h5>Segunda sustentación</h5>
	<form id="frm_sustento2" class="form-horizontal form-bordered" action="">
		<div class="form-group">
			<label class="col-sm-3 control-label">Motivo 2 <span class="required">*</span></label>
			<div class="col-sm-9" align="left">
				<textarea class="form-control" rows="3" id="textareaAutosize" name="motivo2" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;" required></textarea>
			</div>
		</div>

		<div class="form-group">
			<label class="col-md-3 control-label">Sustento 2</label>
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
		<input id="idnominacion" type="hidden" name="seg_sustento" 
		value="<?php echo $idn;?>">
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
<?php } ?>
