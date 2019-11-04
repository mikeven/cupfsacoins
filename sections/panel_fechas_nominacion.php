<hr class="solid short">
<div class="form-group">
	<label class="col-sm-4 text-right">Fecha nominación: 
	</label>
	<div class="col-sm-8 text-left">
		<?php echo $nominacion["fregistro"]; ?>
	</div>
</div>
<?php if ( $nominacion["fcierre"] != "" ){ ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Fecha cierre: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["fcierre"]; ?>
		</div>
	</div>
<?php } ?>
<?php if ( $nominacion["fadjudicada"] != "" ){ ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Fecha adjudicación: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["fadjudicada"]; ?>
		</div>
	</div>
<?php } ?>
