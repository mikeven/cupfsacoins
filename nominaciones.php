<?php
    /*
     * Cupfsa Coins - Nominaciones
     * 
     */
    session_start();
    $pagina = "pg_nominaciones";
    ini_set( 'display_errors', 1 );
    
    include( "database/bd.php" );
    include( "database/data-acceso.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-nominaciones.php" );
    include( "fn/fn-acceso.php" );
    include( "fn/fn-nominaciones.php" );

    $idu = $_SESSION["user"]["idUSUARIO"];
    isAccesible( $pagina );
    //$param_busq = obtenerParametro
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Nominaciones :: Cupfsa Coins</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<!-- <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css"> -->

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<link rel="stylesheet" href="assets/stylesheets/cupfsa-custom.css">

		<style>
			.panel-heading-icon{
				background-color: #ecedf0;
			}

			.sw-f{ 
				margin-left: 15%;
			    position: absolute;
			    bottom: 5px; 
			}

			#nom_paneles{ max-height: 68vh; overflow-y: scroll; }

		</style>

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
	</head>
	<?php 
		$data_nominaciones = obtenerListadoNominaciones( $dbh, $idu );
		$nominaciones = $data_nominaciones["nominaciones"];
		$titulo = $data_nominaciones["titulo"];
		$mis_noms = esRecibida();
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
						<h2><i class="fa fa-bookmark"></i> Nominaciones <?php echo $titulo; ?></h2>
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="inicio.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Nominaciones</span></li>
							</ol>
							<a class="sidebar-right-null" data-open=""></a>
						</div>
					</header>
					<!-- start: page -->
					<div id="nom_paneles">
						<h5>
							<a href="#!" class="sel_panel_nom" data-i="#nom_paneles" 
							data-d="#nom_tabla">
							<i class="fa fa-table"></i> Ver tabla</a>
						</h5>
						
						<?php foreach ( $nominaciones as $nom ) { 
							$enl = enlaceVerNominacion( $dbh, $idu, $nom );
							$cl = claseEstadoNominacion( $nom["estado"] );
							$p_sw = posicionSuiche( $nom["votable"] );

							if( esVisibleEnLista( $dbh, $idu, $nom ) ){
						?>
							<div class="col-sm-6 col-xs-12">
								<section class="panel panel-horizontal">
									<header class="panel-heading <?php echo $cl;?>" 
										style="width: 30%;">
										<div class="panel-heading-icon">
											<img src="<?php echo $nom["imagen"]?>" width="60">
										</div>
										<?php if ( esActivable( $nom ) ) { ?>
											<div class="switch switch-sm switch-dark sw-f 
											sw<?php echo $nom["idNOMINACION"];?>" data-toggle="tooltip" data-placement="top" 
											title="<?php echo $p_sw["t"];?>" style="display: none;">
												<input type="checkbox" name="switch" data-plugin-ios-switch 
												<?php echo $p_sw["p"];?>
												data-idn="<?php echo $nom["idNOMINACION"];?>" class="chvotable"/>
											</div>
										<?php } ?>
									</header>
									<div class="panel-body p-lg" style="width: 70%;">
										<?php if ( !$mis_noms ) { ?>
										<h4 class="text-semibold mt-sm">
											<?php echo $nom["nombre2"]." ".
														$nom["apellido2"]; ?>
										</h4>
										<?php } else {?>
											<?php mostrarNominador( $nom ); ?>
										<?php } ?>
										<h5 class=""><?php echo $nom["atributo"]?></h5>
										<p>
											<span id="enlaces_nominacion" class="accion-adj">
											<?php 
											echo iconoEstadoNominacion( $nom["estado"] );
											echo " ".estadoNominacion( $nom["estado"] ); ?> |

											<a href="<?php echo enlNominacion( $nom, $mis_noms ) ?>">
											<?php echo $enl; ?></a>
											
											<?php if ( $nom["estado"] == "aprobada" 
												    && $nom["idNOMINADOR"] == $idu && false ) { 
												// Nominación aprobada y usuario en sesión es el nominador
											?>
												| <a href="#!" class="adjudicacion" href="#!" 
												data-idn="<?php echo $nom["idNOMINACION"]; ?>" 
												data-o="resumen">
													<i class='fa fa-gift'></i> Adjudicar
												</a> 
												
											<?php } ?>
											</span>
										</p>
										
									</div>
								</section>
							</div>
						<?php } } ?>
					</div>
					<div id="nom_tabla" style="display: none;">
						<h5>
							<a href="#!" class="sel_panel_nom" data-i="#nom_tabla" 
							data-d="#nom_paneles">
							<i class="fa fa-th-large"></i> Ver fichas</a>
						</h5>
						<table class="table table-bordered table-striped mb-none" 
						id="datatable-nominaciones">
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Participante</th>
									<th>Atributo</th>
									<th>Valor</th>
									<th>Estado</th>
									<?php if( isV( "en_votar" ) ){ ?>
										<th>Votación</th>
									<?php } ?>
									<?php if ( isV( 'en_activ_nom' ) ){ ?>
										<th>Activación</th>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach ( $nominaciones as $nom ) { 
									$p_sw = posicionSuiche( $nom["votable"] );
									if( esVisibleEnLista( $dbh, $idu, $nom ) ){
								?>
								<tr class="gradeX">
									<td><?php echo $nom["fregistro"]; ?></td>
									<td>
										<a href="<?php echo enlNominacion( $nom, $mis_noms ) ?>">
											<?php echo $nom["nombre2"]." ".$nom["apellido2"]; ?>
										</a>
									</td>
									<td><?php echo $nom["atributo"]?></td>
									<td class="actions">
										<i class="fa fa-circle" 
										style="color:#eccd28"></i>
										<?php echo $nom["valor"]?>	
									</td>
									<td>
										<?php 
										echo iconoEstadoNominacion( $nom["estado"] ); 
										?>
										<?php 
										echo estadoNominacion( $nom["estado"] ); 
										?>
									</td>
									<?php if( isV( "en_votar" ) ){ ?>
									<td>
										<?php if( esVotable( $dbh, $idu, $nom ) ) { ?>
											<a href="nominacion.php?id=<?php echo $nom['idNOMINACION'];?>">
												<i class="fa fa-hand-o-down"></i> Votar 
											</a>
										<?php } ?>
									</td>
									<?php } ?>
									<?php if ( isV( 'en_activ_nom' ) ){ ?>
									<td>
										<?php if ( esActivable( $nom ) ) { ?>
										<div class="switch switch-sm switch-dark sw-t" data-toggle="tooltip" data-placement="left" 
										title="<?php echo $p_sw["t"];?>"    style="display: none;">
											<input type="checkbox" name="switch" data-plugin-ios-switch 
											<?php echo $p_sw["p"];?>
											data-idn="<?php echo $nom["idNOMINACION"];?>" class="chvotable"/>
										</div>
										<?php } ?>
									</td>
									<?php } ?>
								</tr>
								
								<?php } } ?>
								
							</tbody>
						</table>
					</div>
					<!-- end: page -->
				</section>
			</div>
		</section>

		<div id="dialog" class="modal-block mfp-hide">
			<section class="panel">
				<header class="panel-heading">
					<h2 class="panel-title">Are you sure?</h2>
				</header>
				<div class="panel-body">
					<div class="modal-wrapper">
						<div class="modal-text">
							<p>Are you sure that you want to delete this row?</p>
						</div>
					</div>
				</div>
				<footer class="panel-footer">
					<div class="row">
						<div class="col-md-12 text-right">
							<button id="dialogConfirm" class="btn btn-primary">Confirm</button>
							<button id="dialogCancel" class="btn btn-default">Cancel</button>
						</div>
					</div>
				</footer>
			</section>
		</div>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/jquery-form/jquery.form.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<script src="js/fn-ui.js"></script>
		
		<script src="js/fn-nominaciones.js"></script>
		<script type="text/javascript">
			(function( $ ) {

				'use strict';

				var datatableInit = function() {

					$('#datatable-nominaciones').DataTable( {
				        "order": [[ 0, "desc" ]]
				    } );

				};

				$(function() {
					datatableInit();
				});

			}).apply( this, [ jQuery ]);
		</script>
	</body>
</html>