<?php
    /*
     * Cupfsa Coins - Editar producto
     * 
     */
    session_start();
    $pagina = "pg_mod_producto";
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-productos.php" );
    include( "fn/fn-acceso.php" );
    
    isAccesible( $pagina );
    if( isset( $_GET["id"] ) && ( is_numeric( $_GET["id"] ) ) ){
    	$idp = $_GET["id"];
    	$producto = obtenerProductoPorId( $dbh, $idp );
    } else $producto = NULL;
    if( $producto == NULL ) header('Location: productos.php');
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Editar producto :: Cupfsa Coins</title>
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
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />

		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
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

		<style>
			.frm_imgupl .control-label{
				text-align: right;
			}

			.dropzone {
			    min-height: 250px;
			}

			.dz-message{
				border: 2px dotted #CCC;
			}

			.frm_imgact{
				background-image: url("<?php echo $producto["imagen"]?>");
				background-repeat: no-repeat;
			}

			#response{ float: right; }
		</style>
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
						<h2><i class="fa fa-cube" aria-hidden="true"></i> Editar producto</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="productos.php">Productos</a></span></li>
								<li><span>Editar producto</span></li>
							</ol>
					
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-sm-8">	
								<section class="panel">
									<header class="panel-heading">
										<h2 class="panel-title">Datos de producto</h2>
									</header>
									<div class="panel-body">
										
										<form id="frm_mproducto" class="form-horizontal form-bordered">
											<div class="form-group">
												<input type="hidden" name="idproducto" 
												value="<?php echo $producto["idPRODUCTO"]?>">
												<label class="col-sm-3 control-label">Nombre <span class="required">*</span></label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-tag"></i>
														</span>
														<input type="text" name="nombre" class="form-control" placeholder="Ej.: Crema de afeitar" required 
														value="<?php echo $producto["nombre"]?>"/>
													</div>
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Valor <span class="required">*</span></label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-shopping-cart"></i>
														</span>
														<input type="text" name="valor" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Ej.: 780" maxlength="3" required 
														value="<?php echo $producto["valor"]?>"/>
													</div>
												</div>
												
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Descripción</label>
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-list-alt"></i>
														</span>
														<input type="text" name="descripcion" class="form-control" placeholder="Ej.: Presentación de 80 ml." 
														value="<?php echo $producto["descripcion"]?>" />
													</div>
												</div>
											</div>
											<input id="url_img" type="hidden" name="imagen" 
											value="<?php echo $producto["imagen"]?>">
										</form>
										<hr class="solid short">
										<div class="form-group">
											<label class="col-sm-3 text-right">Imagen</label>
											<div class="frm_imgupl">
												<div class="col-sm-9 frm_imgact">
													<form action="database/data-productos.php" class="dropzone dz-square" 
														id="myAwesomeDropzone">
														<div class="dz-message" align="center">
															Haga clic o arrastre la imagen aquí
														</div>
													</form>
												</div>
											</div>
										</div>

									</div>
									<footer class="panel-footer">
										<div class="row">
											<div class="col-sm-12" align="right">
												<button id="btn_mod_prod" class="btn btn-primary" 
												type="button">Guardar</button>
												<div id="response"></div>
											</div>
										</div>
									</footer>
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
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
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
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
		<script src="js/fn-ui.js"></script>
		<script src="js/fn-productos.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				Dropzone.options.myAwesomeDropzone = {
				  maxFiles: 1,
				  accept: function(file, done) {
				    console.log(file);
				    done();
				  },
				  init: function() {
				    this.on("maxfilesexceeded", function( file ){
				        notificar( "Producto", "Solo una imagen es permitida", "error" );
				    });
				    this.on("success", function(){
				        var args = Array.prototype.slice.call(arguments);
						$("#url_img").val( args[1] );
				    });
				  }
				};
			});

		</script>

	</body>
</html>