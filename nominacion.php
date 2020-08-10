<?php
    /*
     * Cupfsa Coins - Nominaciones
     * 
     */
    session_start();
    $pagina = "pg_nominacion";
    
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-nominaciones.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-acceso.php" );
    include( "fn/fn-nominaciones.php" );
    include( "fn/fn-nominacion.php" );
 
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Nominación :: Cupfsa Coins</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="assets/stylesheets/cupfsa-custom.css">

		<style type="text/css">
			.panel-heading-icon{
			    font-size: 35px;
			    font-size: 3.2rem;
			    width: 60px;
			    height: 60px;
			    line-height: 60px;
			    background: #FFF; 
			}
			.adminev{ display: none; }
		</style>

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<?php include( "sections/header.php" );?>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<?php include( "sections/left-sidebar.php" );?>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2><i class="fa fa-bookmark"></i> Nominación</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="nominaciones.php">Nominaciones</a></span></li>
								<li><span>Nominación</span></li>
							</ol>
					
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>
					<!-- start: page -->
					<?php 
						if( nominacionVisible( $dbh, $idu, $nominacion ) ) {
							$cl = claseEstadoNominacion( $nominacion["estado"] ); 
					?>

					<div class="col-sm-6 col-xs-12">
						<section class="panel">
							<header class="panel-heading <?php echo $cl;?> enc_nom">
								<div class="panel-heading-icon">
									<?php if ( $nominacion["estado"] == "aprobada" && $nominacion["idNOMINADOR"] == $idu ) { 
										// Nominación aprobada y el usuario en sesión es el nominador de la nominación actual
									?>
									<a class="adjudicacion icon_adj" href="#!" data-o="full"
									data-idn="<?php echo $nominacion["idNOMINACION"]; ?>">
										<i class="fa fa-gift"></i>
									</a>
									<?php } else { ?>
										<img src="<?php echo $nominacion["imagen"];?>" width="50">
									<?php } ?>
									<input id="idnominacion" type="hidden" 
									value="<?php echo $nominacion["idNOMINACION"]; ?>">
								</div>
							</header>
							<div class="panel-body text-center">
								<?php if ( esActivable( $nominacion ) ) { ?>
								<div class="switch switch-dark" data-toggle="tooltip" data-placement="right" title="<?php echo $p_sw["t"];?>"    style="display: none;">
									<input type="checkbox" name="switch" data-plugin-ios-switch <?php echo $p_sw["p"];?> 
									data-idn="<?php echo $nominacion["idNOMINACION"];?>" 
									class="chvotable"/>
								</div>
								<?php } ?>
								<h3 class="text-semibold mt-sm text-center">
									<?php echo $nominacion["atributo"]; ?>
								</h3>
								<p class="text-center">
									<i class="fa fa-circle" style="color: #ff9900;"></i>
									<?php echo $nominacion['valor']." coins"; ?>
								</p>
								<?php if ( !isset( $_GET["recibida"] ) ) { ?>
									<h4 class="text-semibold mt-sm text-center">
									<?php echo $nominacion["nombre2"]." ".$nominacion["apellido2"]; ?>
									</h4>
								<?php } ?>
								
								<!-- -------------------------------------------------------------------- -->
								
								<hr class="solid short">
								
								<!-- ------------------------------ SUSTENTO -->
								<div class="form-group">
									<label class="col-sm-4 text-right">Motivo: </label>
									<div class="col-sm-8 text-left">
										<?php echo $nominacion["motivo1"]; ?>
									</div>
								</div>
								<div class="form-group">
									<?php if( $nominacion["sustento1"] != "" ) { ?>
									<div class="col-sm-4"></div>
									<div class="col-sm-8 text-left">
										<a href="<?php echo $nominacion["sustento1"]; ?>" target="_blank">
										<i class="fa fa-file-text-o"></i> Sustento </a>
									</div>
									<?php } ?>
								</div>
								<div class="form-group">
									<?php if( $nominacion["dedicatoria"] != "" ) { ?>
									<label class="col-sm-4 text-right">Mensaje del nominador: </label>
									<div class="col-sm-8 text-left">
										<?php echo $nominacion["dedicatoria"]; ?>
									</div>
									<?php } ?>
								</div>

								<?php 
									if( soyNominado( $idu, $nominacion ) == false )
										include( "sections/panel_discusion_nominacion.php" ); 
								?>

								<!-- -------------------------------------------------------------------- -->
								
								<hr class="solid short">
								
								<!-- ------------------------------ NOMINADOR -->
								<div class="form-group">
									<label class="col-sm-4 text-right">Nominado por: </label>
									<div class="col-sm-8 text-left">
										<?php echo $nominacion["nombre1"]." ".$nominacion["apellido1"]; ?>
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-4 text-right">Estado: 
									</label>
									<div class="col-sm-8 text-left">
									<?php 
										echo iconoEstadoNominacion( $nominacion["estado"] ); 
									?>
									<?php 
										echo estadoNominacion( $nominacion["estado"] ); 
									?>
									</div>
								</div>

								<!-- --------------------- PANELES ACCIONES -->
								
								<?php
									include( "sections/panel_fechas_nominacion.php" );

									if( esVotable( $dbh, $idu, $nominacion ) ) { 		
										//Evaluador
										include( "sections/panel_votacion.php" );
									}
									if( isV( 'en_aprob_nom' ) ) { 	
										// Administrador - VP
										if( $nominacion["estado"] != "aprobada" 
											&& $nominacion["estado"] != "rechazada" 
											&& $nominacion["estado"] != "adjudicada" ){
											include( "sections/panel_aprobacion.php" );
										}
									}
									if( isV( 'pan_nom_apoyo' ) ) { 	
										//Colaborador 
										include( "sections/panel_soporte_nominacion.php" );
									}
								?>
							</div>
							<!-- ------------------------------------- PIE FORMULARIOS -->
							<?php if( isV( 'en_aprob_nom' ) ) { 	//Administrador ?>	
							<footer class="panel-footer panel_comentario" style="display: none;">
								<div class="row">
									<div class="col-sm-12" align="right">
										<button id="btn_evaladmin" onclick="evaluar()" 
										class="btn btn-primary">Enviar</button>
									</div>
								</div>
							</footer>
							<?php } ?>
							<!-- ------------------------------------ PIE FORMULARIOS -->
							<?php if( isV( 'pan_nom_apoyo' ) ) { 	//Colaborador  	
									if ( enviaSustento( $idu, $nominacion ) ) { 
								// Perfil colaborador, nominación pendiente por segundo sustento, 
								// Usuario en sesión = nominador de la actual nominación
							?>
								<footer class="panel-footer panel_sustento2">
									<div class="row">
										<div class="col-sm-12" align="right">
											<button id="btn_sustento2" onclick="sustento2()" 
											class="btn btn-primary">Enviar</button>
										</div>
									</div>
								</footer>
							<?php } } ?>
							<!-- ------------------------------------ #frm_adjudicacion -->
							<?php if ( $nominacion["estado"] == "aprobada" && $nominacion["idNOMINADOR"] == $idu ) { 
								// Nominación aprobada y el usuario en sesión es el nominador de la nominación actual
							?>
							<footer class="panel-footer panel_comentario_adj" style="display: none;">
								<div class="row">
									<div class="col-sm-12" align="right">
										<button id="btn_adjudicacion" class="btn btn-primary" data-o="full">Enviar</button>
									</div>
								</div>
							</footer>
							<?php } ?>
							<!-- ------------------------------------ PIE FORMULARIOS -->
						</section>
					</div>
					
					<?php if( mostrarResultadosNominacion( $es_usrvp, $es_usadm, $votada ) ) { ?>
						<div class="col-sm-6 col-xs-12">
							<section class="panel">
								<header class="panel-heading">
									<h2 class="panel-title">Resultados</h2>
									<p class="panel-subtitle">
										Votación final: <span id="rvotot"></span> votos
									</p>
									<p class="panel-subtitle">
										Comité: <?php echo $comite; ?> participantes
									</p>
								</header>
								<div class="panel-body text-center">
									<div class="chart chart-md" id="flotPie"></div>
									<div id="detalle_resuktados">
										<div class="col-sm-6" style="color: #47a447;">
											<i class="fa fa-thumbs-up"></i>
											Sí: <span id="rvotossi"></span>
										</div>
										<div class="col-sm-6" style="color: #d64742;">
											<i class="fa fa-thumbs-down"></i>
											No: <span id="rvotosno"></span>
										</div>
									</div>
										
									<a href="#!" onclick="actualizarVotos( true )">
										<i class="fa fa-refresh"></i> Actualizar </a>
								</div>
							</section>
						</div>
					<?php } ?>	
					<!-- end: page -->

					<?php } else { ?>

						<h4>No hay información disponible</h4>
						
					<?php } ?>

				</section>
			</div>

		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/jquery-form/jquery.form.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Func. particular -->
		<script src="js/fn-ui.js"></script>
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
		<script src="js/fn-nominaciones.js"></script>
		<script src="js/tabla-nominaciones.js"></script>

		<?php if( isV( "result_nom" ) || ( isV( "en_votar" ) && ( $votada ) ) ) { ?>
		<script>
			actualizarVotos( false );
		</script>
		<?php } ?>

	</body>
</html>