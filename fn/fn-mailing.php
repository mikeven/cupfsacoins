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

		if( in_array( $idm, array( 22 ) ) )
			$receptor = $datos["email"];					// usuario quien realiza canje
		
		return $receptor;
	}
	/* ----------------------------------------------------------------------------------- */
	function obtenerTokenReceptor( $idm, $datos ){
		// Devuelve el token de ingreso del receptor del mensaje de acuerdo al id del caso
		
		if( in_array( $idm, array( 1, 4, 5, 6, 8, 10, 12, 13, 18 ) ) )
			$token_r = $datos["token1"];							// nominador
		
		if( in_array( $idm, array( 2 ) ) )
			$token_r = $datos["token2"];							// nominado
		
		if( in_array( $idm, array( 3, 16 ) ) )
			$token_r = $datos["vp_dpto_ndo"]["token_ingreso"];		// vp del departamento del nominado
		
		if( in_array( $idm, array( 9, 11, 14, 17 ) ) )
			$token_r = $datos["admin"]["token_ingreso"];			// administrador

		if( in_array( $idm, array( 15 ) ) )
			$token_r = $datos["usuario"]["token_ingreso"];			// usuario quien realiza canje

		if( in_array( $idm, array( 22 ) ) )
			$token_r = $datos["token_a"];							// usuario registrado
		
		return $token_r;
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
	function mensajeTipoAT( $plantilla, $asunto, $mbase, $datos ){
		// Notificaciones sobre sustentación de nominaciones

		$mbase = str_replace( "{usuario}", $datos["nombre"], $mbase );
		
		$plantilla = str_replace( "{asunto}", $asunto, $plantilla );
		$plantilla = str_replace( "{mensaje}", $mbase, $plantilla );
		$plantilla = str_replace( "{email}", $datos["email"], $plantilla );
		$plantilla = str_replace( "{token}", $datos["token_a"], $plantilla );
		
		return $plantilla;
	}
	/* ----------------------------------------------------------------------------------- */
	function insertarTokenIngreso( $mensaje, $email, $token ){
		// Inserta el enlace con el token de ingreso en el mensaje enviado por email
		$mensaje = str_replace( "{email}", $email, $mensaje );
		$mensaje = str_replace( "{token}", $token, $mensaje );

		return $mensaje;
	}
	/* ----------------------------------------------------------------------------------- */
	function escribirMensaje( $idm, $mensaje, $plantilla, $datos ){
		// Sustitución de elementos de la plantilla con los datos del mensaje

		$sobre["asunto"] 		= $mensaje["asunto"];
		$sobre["receptor"] 		= obtenerReceptor( $idm, $datos );
		$token_ingreso 			= obtenerTokenReceptor( $idm, $datos );
		
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

		if( $idm == 22 ){
			// Envío de enlace de acceso a usuario
			$token_ingreso = $datos["token_a"];
			$plantilla = file_get_contents( "../fn/mailing/mailing_access_token.html" );
			$sobre["mensaje"] 	= mensajeTipoAT( $plantilla, $mensaje["asunto"], $mensaje["texto"], $datos );
		}

		$sobre["mensaje"] 	= insertarTokenIngreso( $sobre["mensaje"], $sobre["receptor"], $token_ingreso );
		
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