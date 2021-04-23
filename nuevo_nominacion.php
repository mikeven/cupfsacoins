<?php
    /*
     * Cupfsa Coins - Nueva nominación
     * 
     */
    session_start();
    $pagina = "pg_nvo_nominacion";
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-atributos.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-acceso.php" );
    
    isAccesible( $pagina );
    $es_usr_vp = esRol( $dbh, 4, $_SESSION["user"]["idUSUARIO"] );
    
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Nominar :: Cupfsa Coins</title>
		<meta name="keywords" content="CUPFSA Coins" />
		<meta name="description" content="CUPFSA Coins registrar nominación">
		<meta name="author" content="mikeven@gmail.com">

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
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<!--<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />-->
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<style type="text/css">
			#persona_seleccion{
			}
		</style>

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<?php 
		$usuarios = obtenerUsuariosRegistrados( $dbh );
		$atributos = obtenerAtributosRegistrados( $dbh );
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
						<h2><i class="fa fa fa-bookmark" aria-hidden="true"></i> Nueva nominación</h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.html">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span><a href="usuarios.php">Nominaciones</a></span></li>
								<li><span>Nueva nominación</span></li>
							</ol>
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>

					<!-- start: page -->
						<div class="row">
							<div class="col-sm-8 col-xs-12">
								<section class="panel">
									<header class="panel-heading">
										<h2 class="panel-title">Nominación</h2>
									</header>
									<form id="frm_nnominacion" class="form-horizontal form-bordered" action="">
										<div class="panel-body">
											<div class="form-group">
												<label class="col-sm-3 control-label">Persona <span class="required">*</span></label>
												<input type="hidden" name="nva_nominacion" 
												value="<?php echo $_SESSION["user"]["idUSUARIO"] ?>">
												<input id="dpto_nominador" type="hidden" name="dpto_nominador" 
												value="<?php echo $_SESSION["user"]["idDepartamento"] ?>">
												<input id="ndor_vp" type="hidden" value="<?php echo $es_usr_vp; ?>">
												<div class="col-sm-9">
													<div class="input-group">
														<span class="input-group-btn">
															<a class="modal-with-form modal-with-move-anim" href="#modalForm">
															<button class="btn btn-primary" type="button">Seleccione</button></a>
														</span>
														<input type="text" class="form-control" id="persona_seleccion" required readonly>
														<input type="hidden" name="id_persona" id="idpersona">
													</div>
												</div>
												
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Atributo <span class="required">*</span></label>
												<div class="col-sm-9">
													<select id="atributo" class="form-control" name="atributo" required>
														<option value="">Seleccione</option>
											<?php foreach ( $atributos as $attr ){ ?>
													<option value="<?php echo $attr["idATRIBUTO"] ?>" data-v="<?php echo $attr["valor"] ?>"><?php echo $attr["nombre"] ?></option>
											<?php } ?>
													</select>
													<input type="hidden" name="valor_atributo" id="valattr">
												</div>
											</div>

											<div class="form-group">
												<label class="col-sm-3 control-label">Motivo <span class="required">*</span></label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="3" id="textareaAutosize" name="motivo" data-plugin-textarea-autosize="" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;" required></textarea>
												</div>
											</div>

											<div class="form-group">
												<label class="col-md-3 control-label">Sustento</label>
												<div class="col-md-9">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Cambiar</span>
																<span class="fileupload-new">Archivo</span>
																<input type="file" name="archivo"/>
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Quitar</a>
														</div>
													</div>
												</div>
											</div>

											<div id="tx_dedicatoria" class="form-group" style="display: none;">
												<label class="col-sm-3 control-label"> Dedícale unas palabras a tu nominado <span class="required">*</span></label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="3" id="textareaAutosize_dedicatoria" 
													name="dedicatoria" data-plugin-textarea-autosize="" 
													style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 74px; width: 100%;" required></textarea>
												</div>
											</div>

										</div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-sm-12" align="right">
													<button id="btn_nominar" class="btn btn-primary">Nominar</button>
													<div id="response"></div>
												</div>
											</div>
										</footer>
										<div id="divToUpdate"></div>
									</form>
								</section>
							</div>
						</div>
						
					<!-- end: page -->
				</section>
			</div>

			<div id="modalForm" class="zoom-anim-dialog modal-block modal-block-lg mfp-hide">
				<section class="panel">
					<header class="panel-heading">
						<h2 class="panel-title">Usuarios registrados</h2>
					</header>
					<div class="panel-body">
						<?php include( "sections/tablas/tabla-modal-usuarios.php" ); ?>	
					</div>
					<footer class="panel-footer">
						<div class="row">
							<div class="col-md-12 text-right">
								<button id="btn_cerrar_usuarios" class="btn btn-default modal-dismiss">Cancelar</button>
							</div>
						</div>
					</footer>
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div>
			
						</div>
					</div>
				</div>
			</aside>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-form/jquery.form.js"></script>
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
		<!--
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script> -->
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
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
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
		<script src="js/init-tables-default.js"></script>
		<script src="js/init.modals.js"></script>
		<script src="js/fn-nominaciones.js"></script>

	</body>
</html>