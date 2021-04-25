<?php
    /*
     * Cupfsa Coins - Recuperar contraseña
     * 
     */
    ini_set( 'display_errors', 1 );
?>
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<style type="text/css">
			.alert{ display: none; margin-top: 20px; }
		</style>
	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo_cupsfa.png" height="60" alt="CUPFSA"/>
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Recuperar Contraseña</h2>
					</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<p class="text-semibold h6">Ingrese su dirección de email y le enviaremos instrucciones para recuperar su contraseña</p>
						</div>

						<form id="recover_password">
							<input type="hidden" name="usr_passwrecover" value="1">
							<div class="form-group mb-none">
								<div class="input-group">
									<input name="email" type="email" placeholder="E-mail" class="form-control input-lg" />
									<span class="input-group-btn">
										<button id="btn_emailpwd" class="btn btn-primary btn-lg" type="submit">Enviar</button>
									</span>
								</div>
							</div>
							<!-- ALERTS -->
							<?php include( "sections/notificaciones/alert.html" ); ?>

							<p class="text-center mt-lg">Si recuerda su contraseña puede <a href="index.php">Ingresar</a>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">Cupfsa Coins 2021</p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>

		<script src="js/fn-ui.js"></script>
		<script src="js/fn-acceso.js"></script>
	</body>
</html>