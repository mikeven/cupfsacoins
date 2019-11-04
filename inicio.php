<?php
    /*
     * Cupfsa Coins - Pagina de inicio
     * 
     */
    session_start();
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-nominaciones.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-acceso.php" );
    include( "fn/fn-nominaciones.php" );

    $idu = $_SESSION["user"]["idUSUARIO"];
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Inicio :: Cupfsa Coins</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
		<meta name="author" content="JSOFT.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<link rel="stylesheet" href="assets/vendor/owl-carousel/owl.carousel.css" />
		<link rel="stylesheet" href="assets/vendor/owl-carousel/owl.theme.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<?php 
		if( isV( 'mp_nom_pers' ) ) {
			$nominaciones_h = obtenerNominacionesAccion( $dbh, $idu, "hechas" );
			$nominaciones_r = obtenerNominacionesAccion( $dbh, $idu, "recibidas" );
		}
	?>
	<body>
		<section class="body">

			<?php include( "sections/header.php" ); ?>

			<div class="inner-wrapper">
				
				<!-- start: sidebar -->
				<?php include( "sections/left-sidebar.php" );?>
				<!-- end: sidebar -->

				<section role="main" class="content-body hidden_">
					<header class="page-header">
						<h2>Inicio</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="#!">
										<i class="fa fa-home"></i>
									</a>
								</li>
							</ol>
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<div class="row">
						<div class="col-sm-12 col-xs-12">
							<?php 
								//print_r( $accesos_usess["acciones"] );
							?>
							<section class="panel">
								<?php if( isV( 'mp_nom_pers' ) ) { ?>
									<header class="panel-heading">
										<h2 class="panel-title">CUPFSA COINS</h2>
										<p class="panel-subtitle"></p>
									</header>
									<div class="panel-body">
										<?php include( "sections/instrucciones.php" ); ?>
									</div>
								<?php } ?>
								<?php if( isV( '---' ) ) { ?>
									<header class="panel-heading">
										<h2 class="panel-title">Últimas nominaciones hechas</h2>
										<p class="panel-subtitle"></p>
									</header>
								
									<div class="panel-body">
										<div class="owl-carousel" data-plugin-carousel data-plugin-options='{ "autoPlay": 4000, "items": 3, "itemsDesktop": [1199,4], "itemsDesktopSmall": [979,3], "itemsTablet": [768,2], "itemsMobile": [479,1] }'>
											<?php 
												foreach ( $nominaciones_h as $nom ) {
												$cl = claseEstadoNominacion( $nom["estado"] ); 
											?>
											<div class="item spaced">
												<header class="panel-heading <?php echo $cl;?>">
													<h5><?php echo $nom["atributo"]?></h5>
												</header>
												<div class="panel-body p-lg" 
													style="border:1px solid #ccc">
													<p><?php echo $nom["fregistro"]?></p>
													<h4 class="text-semibold mt-sm">
														<?php echo $nom["nombre2"]?>
													</h4>

												<?php 

												echo iconoEstadoNominacion( $nom["estado"] );
												echo " ".estadoNominacion( $nom["estado"] ); ?> |

													<a href="nominacion.php?id=<?php echo $nom["idNOMINACION"]?>"><i class="fa fa-eye"></i> Ver
													</a>												
													<span id="enlaces_nominacion" class="accion-adj">

													<?php if ( $nom["estado"] == "aprobada" 
													    && $nom["idNOMINADOR"] == $idu ) { 
														// Nominación aprobada y usuario en sesión es el nominador
													?> 
														| <a href="#!" class="adjudicacion" href="#!" 
														data-idn="<?php echo $nom["idNOMINACION"]; ?>" 
														data-o="resumen">
															<i class='fa fa-gift'></i> Adjudicar
														</a> 
													<?php } ?>
													</span>
												</div>
											</div>
											<?php } ?>
									 	</div>	
									 	<hr class="solid short">
									 	<h2 class="panel-title">Últimas nominaciones recibidas</h2>
										<p class="panel-subtitle"></p>

										<div class="owl-carousel" data-plugin-carousel data-plugin-options='{ "autoPlay": 4000, "items": 3, "itemsDesktop": [1199,4], "itemsDesktopSmall": [979,3], "itemsTablet": [768,2], "itemsMobile": [479,1] }'>
											<?php foreach ( $nominaciones_r as $nom ) { ?>
											<div class="item spaced">
												<header class="panel-heading bg-primary">
													<h5><?php echo $nom["atributo"] ?></h5>
												</header>
												<div class="panel-body p-lg" style="border:1px solid #ccc">
													<p><?php echo $nom["fregistro"] ?></p>
													<h4 class="text-semibold mt-sm">
														<?php echo $nom["nombre2"] ?>
													</h4>
													<p>
														<a href="nominacion.php?id=<?php echo $nom["idNOMINACION"]?>"><i class="fa fa-eye"></i> Ver</a>
													</p>
												</div>
											</div>
											<?php } ?>
									 	</div>	
									</div>
								<?php } ?>	
							</section>
							
						</div>
					</div>
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
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/owl-carousel/owl.carousel.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>

		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>		
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="js/fn-ui.js"></script>
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/fn-nominaciones.js"></script>

		<!-- Examples -->
		<!--
		<script src="assets/javascripts/dashboard/examples.dashboard.js"></script>-->
	</body>
</html>