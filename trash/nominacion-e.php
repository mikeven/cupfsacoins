<?php
    /*
     * Cupfsa Coins - Nominaciones
     * 
     */
    session_start();
    $pagina = "pg_nominaciones";
    ini_set( 'display_errors', 1 );
    //include( "database/data-usuario.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-acceso.php" );
    isAccesible( $pagina );
?>
<!doctype html>
<html class="fixed">
	<head>
		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Nominación :: Cupfsa Coins</title>
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
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<style type="text/css">
			.seleccion_opcion{
				padding: 12px; 
			}

			.game_nows{
				-webkit-border-radius: 7px;
				-moz-border-radius: 7px;
				border-radius: 7px;
				-webkit-animation-name: gtoday;  /* Safari and Chrome */
				-webkit-animation-duration: 0.5s;  /* Safari and Chrome */
				-webkit-animation-iteration-count: infinite; /* Safari and Chrome */
		    	animation-iteration-count: infinite;
			}
			
			@-webkit-keyframes gtoday {
				from {
					padding: 0px 0px; 
				}
				to {
					padding: 12px 16px; 
				}
			}

			.game_now {
			 

			 -webkit-animation: zoom-in-out 1s linear 0s infinite normal ;
			 animation: zoom-in-out 1s linear 0s infinite normal ;
						}

						@-webkit-keyframes zoom-in-out {
			  0%{
				-webkit-transform: scale(1);
				transform: scale(1);
			  }
			  50%{
				-webkit-transform: scale(1.2);
				transform: scale(1.2);
			  }
			  100%{
				-webkit-transform: scale(1);
				transform: scale(1);
			  }
			}

			@keyframes zoom-in-out {
			  0%{
				-ms-transform: scale(1);
				transform: scale(1);
			  }
			  50%{
				-ms-transform: scale(1.2);
				transform: scale(1.2);
			  }
			  100%{
				-ms-transform: scale(1);
				transform: scale(1);
			  }
			}
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
				<?php include( "sections/left-sidebar-e.php" );?>
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
								<li><span><a href="usuarios.php">Nominaciones</a></span></li>
								<li><span>Nominación</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					<!-- start: page -->
					
					<div class="col-sm-6 col-xs-6">
						<section class="panel">
							<header class="panel-heading bg-primary">
								<div class="panel-heading-icon">
									<i class="fa fa-bookmark"></i>
								</div>
							</header>
							<div class="panel-body text-center">
								<h3 class="text-semibold mt-sm text-center">Nombre participante</h3>
								<p class="text-center">Atributo</p>
								<p class="text-center">(0000 pts)</p>
								<hr class="solid short">
								<div id="panel_voto">
									<button type="button" class="mb-xs mt-xs mr-xs btn btn-success btn-lg cnf-voto" data-valor="si"><i class="fa fa-thumbs-up"></i> </button>
									<button type="button" class="mb-xs mt-xs mr-xs btn btn-danger btn-lg cnf-voto" data-valor="no"><i class="fa fa-thumbs-down"></i> </button>
									<div id="confirmar_seleccion" style="display: none;">
										<hr class="solid short">
										<div>Haga clic en Votar para confirmar su selección</div>
										<input id="valor_voto" type="hidden" name="voto" value="">
										<button id="btn_votar" type="button" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-hand-o-down"></i> Votar</button>
									</div>
								</div>
								<div id="panel_resultado" style="display: none;">
									<i class="fa fa-3x fa-check-square-o"></i>
									Voto registrado
								</div>
							</div>
						</section>
					</div>
					<!-- end: page -->
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
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<!-- <script src="assets/javascripts/tables/examples.datatables.editable.js"></script> -->
		<script src="js/tabla-nominaciones.js"></script>
	</body>
</html>