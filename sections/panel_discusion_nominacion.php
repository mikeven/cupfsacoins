<div id="bloque_discusion">

	<!-- -OBSERVACIÓN SOLICITUD SUSTENTO DEL VP -->
	<?php if( $nominacion["obs_sustento_vp"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Obs del VP: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["obs_sustento_vp"]; ?>
		</div>
	</div>
	<?php } ?>

	<!-- ----------------------- SUSTENTO PARA VP -->
	<?php if( $nominacion["motivo_vp"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Sustentación: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["motivo_vp"]; ?>
		</div>
	</div>
	<?php } ?>
	
	<?php if( $nominacion["sustento_vp"] != "" ) { ?>
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-8 text-left">9
			<a href="<?php echo $nominacion["sustento_vp"]; ?>" 
				target="_blank">
			<i class="fa fa-file-text-o"></i> Sustento </a>
		</div>
	</div>
	<?php } ?>

	<!-- -------------- OBSERVACIÓN DEL VP (Final) -->
	<?php if( $nominacion["obs_vp"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Obs del VP: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["obs_vp"]; ?>
		</div>
	</div>
	<?php } ?>
	
	<!-- -OBSERVACIÓN SOLICITUD SUSTENTO DEL ADMIN -->
	<?php if( $nominacion["obs_sustento"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Obs del comité: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["obs_sustento"]; ?>
		</div>
	</div>
	<?php } ?>
	
	<!-- ---------------------------- SUSTENTO  2 -->
	<?php if( $nominacion["motivo2"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Sustentación 2: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["motivo2"]; ?>
		</div>
	</div>
	<?php } ?>
	
	<?php if( $nominacion["sustento2"] != "" ) { ?>
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-8 text-left">
			<a href="<?php echo $nominacion["sustento2"]; ?>" target="_blank">
			<i class="fa fa-file-text-o"></i> Sustento 2 </a>
		</div>
	</div>
	<?php } ?>

	<!-- --------- OBSERVACIÓN DEL ADMIN (COMITE) -->
	<?php if( $nominacion["obs_comite"] != "" ) { ?>
	<div class="form-group">
		<label class="col-sm-4 text-right">Obs del comité: 
		</label>
		<div class="col-sm-8 text-left">
			<?php echo $nominacion["obs_comite"]; ?>
		</div>
	</div>
	<?php } ?>

</div>