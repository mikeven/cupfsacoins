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
?>