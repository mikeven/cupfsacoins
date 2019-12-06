<?php
	/* ----------------------------------------------------------------------------------- */
	/* Cupfsa Coins - Funciones mensajes email */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerCabecerasMensaje(){
		// Devuelve las cabeceras 
		$email_from = "digital@cupfsa.com";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= "From: CUPFSA COINS <".$email.">"."\r\n";

        return $cabeceras;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPlantillaMensaje(){
		// Devuelve la plantilla html de acuerdo al mensaje a ser enviado

		return file_get_contents( "../fn/mailing/mailing_message.html" );
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeEstatus( $dbh, $idm ){
		// Devuelve la frase para el mensaje de cambio de estatus en nominación

		

		return $etiquetas[$evaluacion];
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeNvaNominacion( $plantilla, $mbase, $datos ){
		// Llenado de mensaje con plantilla y mensaje base: 
		
		$nominado = $datos["nombre2"]." ".$datos["apellido2"];
		$estado = mensajeEstatus( $datos["evaluacion"] );

		$plantilla = str_replace( "{nominado}", $nominado, $plantilla );
		$plantilla = str_replace( "{atributo}", $datos["atributo"], $plantilla );
		$plantilla = str_replace( "{estado}", $estado, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirMensaje( $tmensaje, $plantilla, $datos ){
		// Sustitución de elementos de la plantilla con los datos del mensaje

		include( "data-mailing.php" );
		$mje_evt = obtenerMensajeEvento( $dbh, $idm );
		$mbase = $mje_evt["texto"];
		
		if( $tmensaje == "nva_nom" ){
			// Usuario no VP registra nueva nominación 
			$sobre["asunto"] = $mje_evt["asunto"];
			$sobre["mensaje"] = mensajeNvaNominacion( $plantilla, $mbase, $datos );
		}

		return $sobre; 
	}
	/* ----------------------------------------------------------------------------------- */
	function enviarMensajeEmail( $tipo_mensaje, $datos ){
		// Construcción del mensaje para enviar por email
		$plantilla = obtenerPlantillaMensaje();
		$sobre = escribirMensaje( $tipo_mensaje, $plantilla, $datos );
		$cabeceras = obtenerCabecerasMensaje();
		
		return mail( "mrangel@mgideas.net", $sobre["asunto"], $sobre["mensaje"], $cabeceras );
	}
	/* ----------------------------------------------------------------------------------- */
?>