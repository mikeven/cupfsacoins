<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Funciones sobre atributos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function esBorrable( $dbh, $ida ){
		// Devuelve verdadero si el atributo puede mostrar opción para ser eliminado
		$borrable = false;

		if( isV( 'en_elim_atrib' ) && ( !registrosAsociadosAtributo( $dbh, $ida ) ) ){
			// Acceso a eliminar atributo, no poseer vínculos con otros registros
			$borrable = true;
		}
		return $borrable;
	}
	/* --------------------------------------------------------- */
?>