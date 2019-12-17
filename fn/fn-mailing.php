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
		
		if( in_array( $idm, array( 1, 4, 5, 6, 8, 10, 12, 13, 18 ) ) )
			$receptor = $datos["email1"];					// nominador
		
		if( in_array( $idm, array( 2 ) ) )
			$receptor = $datos["email2"];					// nominado
		
		if( in_array( $idm, array( 3, 16 ) ) )
			$receptor = $datos["vp_dpto_ndo"]["email"];		// vp del departamento del nominado
		
		if( in_array( $idm, array( 9, 11, 14, 17 ) ) )
			$receptor = $datos["admin"]["email"];			// administrador

		if( in_array( $idm, array( 15 ) ) )
			$receptor = $datos["usuario"]["email"];			// usuario quien realiza canje
		
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
	function mensajeTipo2( $plantilla, $asunto, $mbase, $datos ){ 
		// Nueva nominación hecha entre usuarios mismo departamento, notificación al VP

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		$mbase = str_replace( "{nominado}", $datos["nombre2"], $mbase );
		$mbase = str_replace( "{atributo}", $datos["atributo"], $mbase );
		$mbase = str_replace( "{vp}", $datos["vp_dpto_ndo"]["nombre"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo3( $plantilla, $asunto, $mbase, $datos ){
		// VP solicita sustento, rechaza o valida nominación: recibe el nominador
		// Nominación entre departamentos diferentes: recibe el admin

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo4( $plantilla, $asunto, $mbase, $datos ){
		// Administrador recibe notificación de la aprobación de una nominación

		$mbase = str_replace( "{nominador}", $datos["nombre1"], $mbase );
		$mbase = str_replace( "{nominado}", $datos["nombre2"], $mbase );
		$mbase = str_replace( "{atributo}", $datos["atributo"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo5( $plantilla, $asunto, $mbase, $datos ){
		// Notificaciones sobre canjes de productos

		$mbase = str_replace( "{nominado}", $datos["usuario"]["nombre"], $mbase );
		$mbase = str_replace( "{producto}", $datos["producto"]["nombre"], $mbase );
		$mbase = str_replace( "{coins}", $datos["valor"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function mensajeTipo6( $plantilla, $asunto, $mbase, $datos ){
		// Notificaciones sobre sustentación de nominaciones

		$mbase = str_replace( "{vp}", $datos["vp_dpto_ndo"]["nombre"], $mbase );
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
		
		if( $idm == 1 || $idm == 18 ){
			//  1: Usuario no VP registra nueva nominación, notificación al nominador 
			// 18: Usuario no VP nomina a VP de su dpto, notifica aprobación al nominador 
			$sobre["mensaje"] 	= mensajeTipo1( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos, false );
		}
		if( $idm == 2 ){
			// Usuario VP registra nueva nominación, adjudicación inmediata al nominado
			$sobre["mensaje"] 	= mensajeTipo1( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos, true );
		}
		if( $idm == 3 ){
			// Nominación entre mismo departamento, VP recibe notificación
			$sobre["mensaje"] 	= mensajeTipo2( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
		}
		
		if( in_array( $idm, array( 4, 5, 6, 8, 9, 12, 13, 17 ) ) ){
			// Notificaciones al nominador sobre nominación hecha por él
			// 9: Notificación al administrador
			// 12: Admin solicita sustento al nominador
			$sobre["mensaje"] 	= mensajeTipo3( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
		}
		
		if( $idm == 10 || $idm == 11 ){
			// Nominador recibe mensaje de aprobación de nominación
			$sobre["mensaje"] 	= mensajeTipo4( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
		}
		
		if( $idm == 14 || $idm == 15 ){
			// Usuario realiza canje
			$sobre["mensaje"] 	= mensajeTipo5( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
		}

		if( $idm == 16 ){
			// Nominador envía sustento a VP solicitante
			$sobre["mensaje"] 	= mensajeTipo6( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
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