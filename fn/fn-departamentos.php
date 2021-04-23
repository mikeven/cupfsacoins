<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Funciones sobre departamentos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function esBorrable( $dbh, $idd ){
		// Devuelve verdadero si el departamento puede mostrar opción para ser eliminado
		$borrable = false;

		if( isV( 'en_elim_atrib' ) && ( !registrosAsociadosDepartamento( $dbh, $idd ) ) ){
			// Acceso a eliminar departamento, no poseer vínculos con otros registros
			$borrable = true;
		}
		return $borrable;
	}
	/* --------------------------------------------------------- */
?>