<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Funciones sobre usuarios */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function esBorrable( $dbh, $idu ){
		// Devuelve verdadero si el usuario puede mostrar opción para ser eliminado
		$borrable = false;

		if( isV( 'en_elim_usuario' ) && ( $idu != $_SESSION["user"]["idUSUARIO"] )
			&& ( !registrosAsociadosUsuario( $dbh, $idu ) ) ){
			// Acceso a eliminar usuarios, no ser el mismo usuario de sesión, 
			// no poseer vínculos con otros registros
			$borrable = true;
		}
		return $borrable;
	}
	/* --------------------------------------------------------- */
	/*if( isset( $_GET["email"], $_GET["token"] ) ){
		// Recibe los datos provenientes del enlace de acceso para iniciar sesión

		include( "database/data-acceso.php" );

		$usuario["email"] = $_GET["email"];
		$usuario["token"] = $_GET["token"];

		$sesion = iniciarSesion( $usuario, $dbh, "enlace" );
		echo $sesion;
	}*/
	/* --------------------------------------------------------- */
?>