<?php
    /*
     * Cupfsa Coins - Editar usuario
     * 
     */
    session_start();

    $pagina = "pg_mod_usuario";
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-acceso.php" );
    include( "fn/fn-misc.php" );

    isAccesible( $pagina );

    if( isset( $_GET["id"] ) && ( is_numeric( $_GET["id"] ) ) ){
    	$id_u = $_GET["id"];
    	$usuario = obtenerUsuarioPorId( $dbh, $id_u );
    	if( $usuario ){
	    	$roles_u = rolesUsuario( $dbh, $id_u );
	    	$ids_roles_u = arr_claves( $roles_u, "idROL" );
    	}else 
    		header( "Location: usuarios.php" );

    } else 
    	$usuario = NULL;

?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Editar usuario :: Cupfsa Coins</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<!--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">-->

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<!--<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />-->
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />

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
		$roles = obtenerRolesRegistrados( $dbh );
		$departamentos = obtenerDepartamentos( $dbh );
	?>
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
						<h2><i class="fa fa-user" aria-hidden="true"></i> Editar usuario</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="usuarios.php">Usuarios</a></span></li>
								<li><span>Editar usuario</span></li>
							</ol>
					
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-sm-8 col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<h2 class="panel-title">Datos de usuario</h2>
									</header>
									<form id="frm_musuario" class="form-horizontal form-bordered">
										<div class="panel-body">
										
											<div class="form-group">
												<input id="idua" type="hidden" name="idusuario" 
												value="<?php echo $usuario['idUSUARIO']?>">
												<label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input type="text" name="nombre" class="form-control" placeholder="Ej.: Miguel" required value="<?php echo $usuario["nombre"]?>" />
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Apellido <span class="required">*</span></label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-user"></i>
														</span>
														<input type="text" name="apellido" class="form-control" placeholder="Ej.: Rangel" required value="<?php echo $usuario["apellido"]?>" />
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Email <span class="required">*</span></label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
														</span>
														<input type="email" name="email" class="form-control" placeholder="Ej.: email@email.com" required value="<?php echo $usuario["email"]?>" />
													</div>
												</div>
												<div class="col-sm-9">

												</div>
											</div>

											<div class="form-group hidden">
												<label class="col-sm-3 control-label">Cargo </label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-sitemap"></i>
														</span>
														<input type="text" name="cargo" class="form-control" placeholder="Ej.: Ejecutivo de negocios" value="<?php echo $usuario["cargo"]?>" />
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Departamento <span class="required">*</span></label>
												<div class="col-sm-9">
													<select name="departamento" class="form-control">
														<?php foreach ( $departamentos as $d ) { ?>
														<option value="<?php echo $d["idDepartamento"] ?>" 
															<?php echo sop( $d["idDepartamento"], $usuario["idDepartamento"] ); ?>>
															<?php echo $d["nombre"] ?>
														</option>
														<?php } ?>
													</select>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Rol</label>
												<div class="col-md-9">
													<?php include( "fn/roles_edit_u.php" ); ?>
												</div>
											</div>
										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-sm-12" align="right">
													<button id="btn_mod_usuario" 
													class="btn btn-primary">Guardar</button>
													<div id="response"></div>
												</div>
											</div>
										</footer>

									</form>

								</section>
							</div>
						</div>
						
					<!-- end: page -->
				</section>
			</div>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<!--
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>-->
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Func. particular -->
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-usuarios.js"></script>

	</body>
</html>