<?php
	/* ----------------------------------------------------------------------------------- */
	/* Argyros - Funciones mensajes emails */
	/* ----------------------------------------------------------------------------------- */
	/* ----------------------------------------------------------------------------------- */
	function obtenerCabecerasMensaje(){
		// Devuelve las cabeceras 
		$email = "info@cupfsa.com";
		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= "From: CUPFSA COINS <".$email.">"."\r\n";

        return $cabeceras;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPlantillaMensaje( $accion ){
		// Devuelve la plantilla html de acuerdo al mensaje a ser enviado
		$archivos = array(
			"cambio_estatus" => "estatus_nominacion.html",
			"adjudicacion" => "nominacion_adjudicada.html"
		);

		$archivo = $archivos[$accion];
		return file_get_contents( "../fn/mailing/".$archivo );
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeEstatus( $evaluacion ){
		// Devuelve la frase para el mensaje de cambio de estatus en nominación

		$etiquetas = array(
			"aprobada" => "fue aprobada",
			"rechazada" => "fue rechazada",
			"sustento" => "requiere de un segundo sustento"
		);

		return $etiquetas[$evaluacion];
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeEstatusNominacion( $plantilla, $datos ){
		// Llenado de mensaje para plantilla cambio de estatus en nominación
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
		
		if( $tmensaje == "cambio_estatus" ){
			$sobre["asunto"] = "Estatus de nominación";
			$sobre["mensaje"] = mensajeEstatusNominacion( $plantilla, $datos );
		}

		return $sobre; 
	}
	/* ----------------------------------------------------------------------------------- */
	function enviarMensajeEmail( $tipo_mensaje, $datos ){
		// Construcción del mensaje para enviar por email
		$plantilla = obtenerPlantillaMensaje( $tipo_mensaje );
		$sobre = escribirMensaje( $tipo_mensaje, $plantilla, $datos );
		$cabeceras = obtenerCabecerasMensaje();
		
		return mail( "mrangel@mgideas.net", $sobre["asunto"], $sobre["mensaje"], $cabeceras );
	}
	/* ----------------------------------------------------------------------------------- */
?>