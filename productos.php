<?php
    /*
     * Cupfsa Coins - Productos
     * 
     */
    session_start();
    $pagina = "pg_productos";
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-productos.php" );
    include( "fn/fn-productos.php" );
    include( "fn/fn-acceso.php" );

    isAccesible( $pagina );
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Productos :: Cupfsa Coins</title>
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
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

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
		$productos = obtenerProductosRegistrados( $dbh );
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
						<h2><i class="fa fa-cubes"></i> Productos</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Productos</span></li>
							</ol>
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<!-- start: page -->
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title">
									Productos registrados
								</h2>
							</header>
							<div class="panel-body">
								<?php if( isV( "pg_nvo_producto" ) ) { ?>
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-md">
											<a href="nuevo_producto.php">
											<button id="nproducto" class="btn btn-primary">Nuevo <i class="fa fa-plus"></i></button>
											</a>
										</div>
									</div>
								</div>
								<?php } ?>
								<table class="table table-bordered table-striped mb-none listado_productos_gral" id="datatable-default">
									<thead>
										<tr>
											<th><i class="fa fa-file-image-o"></i></th>
											<th>Nombre</th>
											<th>Descripción</th>
											<th>Valor</th>
											<?php 
											if( isV( "en_edit_prod" ) || isV( 'en_elim_prod' ) ) { ?>
											<th>Acciones</th>
											<?php } ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach ( $productos as $p ) { ?>
										<tr class="gradeX">
											<td align="center"> 
												<img src="<?php echo $p["imagen"]; ?>" width="60">
											</td>
											<td>
												<a href="producto.php?id=<?php echo $p["idPRODUCTO"]; ?>"><?php echo $p["nombre"]; ?>
												</a>
											</td>
											<td><?php echo $p["descripcion"]; ?></td>
											<td><?php echo $p["valor"]; ?></td>
											<?php 
											if( isV( "en_edit_prod" ) || isV( 'en_elim_prod' ) ) { ?>
											<td>
												<?php if( isV( "en_edit_prod" ) ) { ?>
													<a href="editar_producto.php?id=<?php 
													echo $p["idPRODUCTO"] ?>" 
													class="on-default edit-row">
														<i class="fa fa-pencil"></i>
													</a>
												<?php } ?>
												<?php if( esBorrable( $dbh, $p["idPRODUCTO"] ) ) { ?>
												<a href="#modalAnim" class="mb-xs mt-xs mr-xs eprod modal-with-move-anim" 
												data-idp="<?php echo $p["idPRODUCTO"]; ?>" 
												data-imgsrc="<?php echo $p["imagen"]; ?>" 
												style="margin-left: 10px;">
													<i class="fa fa-trash-o"></i>
												</a>
												<?php } ?>
											</td>
											<?php } ?>
										</tr>
										<?php } ?>
										
									</tbody>
								</table>
							</div>
						</section>
					<!-- end: page -->
				</section>
			</div>

		</section>

		<?php include( "sections/modals/confirmar-accion.html" ); ?>
		<input id="idproducto" type="hidden">
		<img id="img_producto" src="" class="hidden">
		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/init.modals.js"></script>

		<!-- Examples -->
		<script src="js/fn-ui.js"></script>	
		<script src="js/fn-productos.js"></script>
		<script src="js/init-tables-default.js"></script>

	</body>
</html>