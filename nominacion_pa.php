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
		<meta name="keywords" content="CUPFSA Coins" />
		<meta name="description" content="CUPFSA Coins Ficha de nominación">
		<meta name="author" content="mikeven@gmail.com">

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
					

					<div class="col-sm-6 col-xs-12">
						<section class="panel">
							
							<div class="panel-body text-center">
								
								<h3 class="text-semibold mt-sm text-center">
									<?php echo $nominacion["atributo"]; ?>
								</h3>
								
								<form id="frm_sustento2s" class="form-horizontal form-bordered" action="">
										<div class="panel-body">
											<div class="form-group">
												<label class="col-sm-3 control-label">Persona <span class="required">*</span></label>
												<input type="hidden" name="nva_nominacion" value="<?php echo $_SESSION["user"]["idUSUARIO"] ?>">
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
								
							</div>
							
						</section>
					</div>
					
				</section>
			</div>

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