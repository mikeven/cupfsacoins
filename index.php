<?php
    /*
     * Cupfsa Coins - Ingreso
     * 
     */
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Cupfsa Coins</title>
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
		$usuarios = obtenerUsuariosRegistrados( $dbh );
	?>
	<body>
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo_cupsfa.png" height="35" alt="CUPFSA"/>
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Ingresar</h2>
					</div>
					<div class="panel-body">
						<form id="loginform">
							<div class="form-group mb-lg">
								<input name="login" type="hidden" value="1"/>
								<label>ROL</label>
								<select name="rol" class="form-control input-lg mb-md">
									<?php foreach ( $usuarios as $u ) { 
										$roles = rolesUsuario( 
													$dbh, $u["idUSUARIO"] );
										$ru = "";
										foreach ( $roles as $r ) {
											$ru .= $r["nombre"]." ";
										}
									?>
									<option value="<?php echo $u["idUSUARIO"]?>">
										<?php 
										echo $u["nombre"]." (".$ru.")" ?>
									</option>
									<?php } ?>
								</select>
							</div>

							<div class="row">
								<div class="col-sm-8">
									
								</div>
								<div class="col-sm-4 text-right">
									<button type="button" class="btn btn-primary hidden-xs" onClick="log_in()">Ingresar</button>
									<button type="button" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" onClick="log_in()">Ingresar</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">Cupfsa Coins 2019. <a href="#!">Cupfsa</a>.</p>
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

		<script src="js/fn-acceso.js"></script>
	</body>
</html>