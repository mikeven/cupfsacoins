<?php
    /*
     * Cupfsa Coins - Departamentos
     * 
     */
    session_start();
    $pagina = "pg_departamentos";
    ini_set( 'display_errors', 1 );

    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-departamentos.php" );
    include( "database/data-usuarios.php" );
    include( "fn/fn-departamentos.php" );
    include( "fn/fn-acceso.php" );

    isAccesible( $pagina );
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Departamentos :: Cupfsa Coins</title>
		<meta name="keywords" content="CUPFSA Coins" />
		<meta name="description" content="CUPFSA Coins lista de departamentos">
		<meta name="author" content="mikeven@gmail.com">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<style> 
			#response{ float: right; }
		</style>

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<?php 
		$departamentos = obtenerDepartamentosRegistrados( $dbh );
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
						<h2><i class="fa fa-sitemap"></i> Departamentos</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Departamentos</span></li>
							</ol>
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<!-- start: page -->
					<div class="col-sm-5">
						<section class="panel">
							<form id="frm_ndpto" class="form-horizontal">
								<header class="panel-heading">
									<h2 class="panel-title">Nuevo departamento</h2>
								</header>
								<div class="panel-body">
									<div class="panel-body">
										<div class="form-group">
											<input type="hidden" name="idusesion" value="<?php echo $accesos_usess['idUSUARIO']?>">
											<label class="col-sm-4 control-label">Nombre <span class="required">*</span></label>
											<div class="col-sm-8">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="fa fa-tag"></i>
													</span>
													<input type="text" name="nombre" 
													class="form-control" placeholder="Ej.: Finanzas" required/>
												</div>
											</div>
										</div>

									</div>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<div class="col-sm-12" align="right">
											<button id="btn_nvo_dpto" 
											class="btn btn-primary">Guardar</button>
											<div id="response"></div>
										</div>
									</div>
								</footer>
							</form>
						</section>
					</div>
					<div class="col-sm-7">
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title">
									Departamentos registrados
								</h2>
							</header>
							<div class="panel-body">
								<table class="table table-bordered table-striped mb-none 
								listado_departamentos_gral" id="datatable-default">
									<thead>
										<tr>
											<th>Nombre</th>
											<th>Acciones</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ( $departamentos as $d ) { ?>
										<tr class="gradeX">
											<td><?php echo $d["nombre"]; ?></td>
											<td class="actions">
												<a href="editar_departamento.php?id=<?php echo $d['idDepartamento'] ?>" 
													class="on-default edit-row">
													<i class="fa fa-pencil"></i>
												</a>
											<?php 
												if( esBorrable( $dbh, $d["idDepartamento"] ) ) { ?>
													<a href="#modalAnim" class="mb-xs mt-xs mr-xs edpto modal-with-move-anim" 
													data-idd="<?php echo $d['idDepartamento'] ?>" 
													style="margin-left: 10px;" id="ed<?php echo $d['idDepartamento'] ?>" title="Eliminar">
														<i class="fa fa-trash-o"></i>
													</a>
											<?php } ?>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</section>
					</div>
					<!-- end: page -->
				</section>
			</div>

		</section>

		<?php include( "sections/modals/confirmar-accion.html" ); ?>
		<input id="iddepartamento" type="hidden">

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/init.modals.js"></script>

		<!-- Custom scripts -->
		<script src="js/init-tables-default.js"></script>
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-departamentos.js"></script>
		
	</body>
</html>