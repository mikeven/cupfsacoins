<?php
    /*
     * Cupfsa Coins - Producto
     * 
     */
    session_start();
    $pagina = "pg_producto";

    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-productos.php" );
    include( "fn/fn-productos.php" );
    include( "fn/fn-acceso.php" );

    isAccesible( $pagina );
    $idu = $_SESSION["user"]["idUSUARIO"];
    $idp = NULL;
    if( isset( $_GET["id"] ) && ( is_numeric( $_GET["id"] ) ) ){
    	$idp = $_GET["id"];
    	$producto = obtenerProductoPorId( $dbh, $idp );
    } else $producto = NULL;
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title><?php echo $producto["nombre"]; ?> :: Cupfsa Coins</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

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
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />

		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
		
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
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
						<h2><i class="fa fa-cube" aria-hidden="true"></i> Producto</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="productos.php">Productos</a></span></li>
								<li><span><?php echo $producto["nombre"]; ?></span></li>
							</ol>
					
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>
					
					<!-- start: page -->
						<div class="row">
							<div class="col-sm-8 col-xs-12">
							<?php if( $producto ){ ?>
							<section class="panel">
								
								<div class="panel-body">
									<div class="col-sm-6 col-xs-12">
										<div class="isotope-item ">
										<div class="thumbnail">
											<div class="thumb-preview">
												<?php $prod_img = trim( $producto["imagen"] ); ?>
												<a class="thumb-image" href="<?php echo $prod_img; ?>">
													<img id="img_producto" 
													src="<?php echo $prod_img; ?>" 
													class="img-responsive" alt="Producto" width="447">
												</a>
											</div>
										</div>
									</div>			
									</div>
									<div class="col-sm-6 col-xs-12">
										<div class="form-group">
											<input type="hidden" id="idproducto" 
											value="<?php echo $producto["idPRODUCTO"]; ?>">
											<h4><?php echo $producto["nombre"]; ?></h4>
										</div>
										<div class="form-group">
											<label class="control-label">
												<?php echo $producto["descripcion"]; ?>
											</label>
										</div>
										<section class="panel panel-featured-left panel-featured-primary">
											<div class="panel-body">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon bg-primary">
															<i class="fa fa-cube"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<span class="title">
															Valor de canje</span>
															<div class="info">
																<strong class="amount"><?php 
																echo $producto["valor"]; ?> coins</strong>
															</div>
														</div>
														<?php 
														if( isV( 'en_canj_prod' ) && $idp 
															&& solvente( $coins_usuario, $producto["valor"] ) 
														) { ?>
														<form id="frm_ncanje">
														<div class="summary-footer">
															<button id="btn_canje" type="button" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-exchange"></i> Canjear</button>
															<input type="hidden" name="idusuario" 
															value="<?php echo $idu;?>">
															<input type="hidden" name="idproducto" value="<?php echo $producto["idPRODUCTO"]; ?>">
															<input name="valor" type="hidden" value="<?php 
																echo $producto["valor"]; ?>">
														</div>
														</form>
														<?php } ?>
													</div>
												</div>
											</div>
										</section>
										
									</div>
								</div>
								<footer class="panel-footer">
									<div class="row">
										<?php if( $idp ) { ?>
										<div class="col-sm-12" align="right">
											<div id="panel_admin_producto">
												<?php if( isV( 'en_edit_prod' ) ) { ?>
												<a href="editar_producto.php?id=<?php echo $idp; ?>">
												<button id="btn_modificar" type="button" data-a="aprobada" class="mb-xs mt-xs mr-xs btn btn-primary adminev">
													<i class="fa fa-pencil"></i> Modificar</button>
												</a>
												<?php } ?>
												<?php if( esBorrable( $dbh, $idp ) ) { ?>
												<a id="btn_eliminar" href="#modalAnim" class="mb-xs mt-xs mr-xs btn btn-primary adminev modal-with-move-anim">
												<i class="fa fa-trash-o"></i> Eliminar </a>
												<?php } ?>
											</div>
										</div>
										<?php } ?>
									</div>
								</footer>
							</section>
							<?php } else { ?>
								<h4>No existe registro</h4>
							<?php } ?>	
							</div>	
						</div>
						
					<!-- end: page -->
				</section>
			</div>

		</section>

		<?php include( "sections/modals/confirmar-accion.html" ); ?>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
	
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
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
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="js/init.modals.js"></script>

		<!-- Custom scripts -->
		<script src="js/fn-ui.js"></script>		
		<script src="js/fn-productos.js"></script>

	</body>
</html>