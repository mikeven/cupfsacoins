<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre mensajes por email */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */

	function obtenerMensajeEvento( $dbh, $idm ){
		//Devuelve el mensaje base para enviar por email de acuerdo a un evento

		$q = "select asunto, texto from mailing where id = $idm";
		
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}	
	/* --------------------------------------------------------- */
?>