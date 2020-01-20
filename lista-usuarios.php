<?php
    /*
     * Cupfsa Coins - Listado de Usuarios
     * 
     */
    session_start();

    $pagina = "pg_usuarios";
    ini_set( 'display_errors', 1 );
    include( "database/bd.php" );
    include( "database/data-usuarios.php" );
    include( "database/data-acceso.php" );
    include( "fn/fn-usuarios.php" );
    include( "fn/fn-acceso.php" );

    isAccesible( $pagina );
?>
<html>
	<head>
		<title>Listado de Usuarios :: Cupfsa Coins</title>
		<!-- Web Fonts  -->
		<link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="assets/stylesheets/invoice-print.css" />
	</head>
	<?php 
		$usuarios = obtenerUsuariosRegistrados( $dbh );
	?>
	<body>
		<div class="invoice">
			<header class="clearfix">
				<div class="row" >
					<div class="col-sm-6 mt-md">
						<img src="assets/images/logo_cupsfa_dark.png" height="35" alt="CUPFSA COINS"/>
					</div>
					<div class="col-sm-6 text-right mt-md mb-md">
						<h3>LISTA DE USUARIOS CUPFSA COINS</h3>
					</div>
				</div>
			</header>
			
		
			<div class="table-responsive">
				<table class="table table-bordered table-striped mb-none 
								listado_usuarios_gral" id="datatable-default" style="font-size: 10px;">
					<thead>
						<tr>
							<th width="20%">Nombre y Apellido</th>
							<th width="80%">Enlace</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ( $usuarios as $u ) { 
								$lnk_login = "https://coins.cupfsa.com/index.php?email=$u[email]&token=$u[token_ingreso]";
						?>
						<tr class="gradeX">
							<td> <?php echo $u["nombre"]." ".$u["apellido"] ?> </td>
							<td> <?php echo $lnk_login ?> </td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		
			
		</div>

		<script>
			window.print();
		</script>
	</body>
</html>