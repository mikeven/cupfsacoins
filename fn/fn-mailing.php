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
        $cabeceras .= "From: CUPFSA COINS <".$email_from.">"."\r\n";

        return $cabeceras;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerPlantillaMensaje(){
		// Devuelve la plantilla html de acuerdo al mensaje a ser enviado

		return file_get_contents( "../fn/mailing/mailing_message.html" );
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerReceptor( $idm, $datos ){
		// Devuelve el email del receptor del mensaje de acuerdo al id del caso
		
		if( in_array( $idm, array( 1, 4, 5, 6, 8, 12 ) ) )
			$receptor = $datos["email1"];					// nominador
		if( in_array( $idm, array( 2 ) ) )
			$receptor = $datos["email2"];					// nominado
		if( in_array( $idm, array( 3 ) ) )
			$receptor = $datos["vp_dpto_ndo"]["email"];		// vp del departamento del nominado
		if( in_array( $idm, array( 9 ) ) )
			$receptor = $datos["admin"]["email"];			// administrador
		
		return $receptor;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo1( $plantilla, $asunto, $mbase, $datos, $vp_nominador ){
		// Adjudicación de nominaciones, recibe nominado 

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		if( $vp_nominador )
			$mbase = str_replace( "{nominado}", $datos["nombre2"], $mbase );

		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo2( $plantilla, $asunto, $mbase, $datos, $vp_nominador ){ 
		// Nueva nominación hecha entre usuarios mismo departamento, notificación al VP

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		$mbase = str_replace( "{nominado}", $datos["nombre2"], $mbase );
		$mbase = str_replace( "{vp}", $datos["vp_dpto_ndo"]["nombre"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo3( $plantilla, $asunto, $mbase, $datos, $vp_nominador ){
		// VP solicita sustento, rechaza o valida nominación: recibe el nominador
		// Nominación entre departamentos diferentes: recibe el admin

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirMensaje( $idm, $mensaje, $plantilla, $datos ){
		// Sustitución de elementos de la plantilla con los datos del mensaje

		$sobre["asunto"] 		= $mensaje["asunto"];
		$sobre["receptor"] 		= obtenerReceptor( $idm, $datos );
		
		if( $idm == 1 ){
			// Usuario no VP registra nueva nominación, notificación al nominador 
			$sobre["mensaje"] 	= mensajeTipo1( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos, false );
		}
		if( $idm == 2 ){
			// Usuario VP registra nueva nominación, adjudicación inmediata al nominado
			$sobre["mensaje"] 	= mensajeTipo1( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos ,true );
		}
		if( $idm == 3 ){
			// Nominación entre mismo departamento, VP recibe notificación
			$sobre["mensaje"] 	= mensajeTipo2( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos ,true );
		}
		if( $idm == 4 || $idm == 5 || $idm == 6 || $idm == 8 ){
			// Notificaciones al nominador sobre nominación hecha por él
			$sobre["mensaje"] 	= mensajeTipo3( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos ,true );
		}
		if( $idm == 9 ){
			// Notificación al administrador
			$sobre["mensaje"] 	= mensajeTipo3( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos ,true );
		}
		
		return $sobre; 
	}
	/* ----------------------------------------------------------------------------------- */
	function enviarMensajeEmail( $id_mensaje, $mensaje, $datos ){
		// Construcción del mensaje para enviar por email
		$plantilla 	= obtenerPlantillaMensaje();
		$sobre 		= escribirMensaje( $id_mensaje, $mensaje, $plantilla, $datos );
		$cabeceras 	= obtenerCabecerasMensaje();
		
		return mail( $sobre["receptor"], $sobre["asunto"], $sobre["mensaje"], $cabeceras );
	}
	/* ----------------------------------------------------------------------------------- */
?>