<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Funciones auxiliares sobre nominaciones */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	
	/* --------------------------------------------------------- */
	function esVotable( $dbh, $idu, $nominacion ){
		// Devuelve verdadero/falso sobre si el usuario puede votar una nominación
		$vota = false;
		if( isV( 'en_votar' ) && !esVotada( $dbh, $idu, $nominacion["idNOMINACION"] ) 
			&& ( $nominacion["estado"] == "pendiente" 		|| 
				 $nominacion["estado"] == "pendiente_ss" 	|| 
				 $nominacion["estado"] == "sustento"  		|| 
				 $nominacion["estado"] == "validada" ) ){
			$vota = true;
		}
		return $vota;
	}
	/* --------------------------------------------------------- */
	function enlaceVerNominacion( $dbh, $idu, $nom ){
		// Devuelve el enlace correspondiente a una nominación segun rol/estado 
		// de votación
		if( isV( "en_votar" ) ){ 	// Acceso a votación
			if( esVotable( $dbh, $idu, $nom ) )
				$enl = '<i class="fa fa-hand-o-down"></i> Votar</a>';
			else
				$enl = '<i class="fa fa-eye"></i> Ver</a>';
		}
		if( isV( "en_ver_nom" ) ) 	// Acceso a ver nominaciones
			$enl = '<i class="fa fa-eye"></i> Ver</a>';
		
		return $enl;
	}
	/* --------------------------------------------------------- */
	function estadoNominacion( $estado ){
		// Devuelve la etiqueta de estado de nominación según valor
		$etiquetas = array(
			"pendiente" 		=> "Pendiente",
			"pendiente_ss" 		=> "Pendiente",
			"sustento"			=> "Espera por sustento",
			"sustento_vp"		=> "Espera por sustento",
			"aprobada"			=> "Aprobada",
			"validada"			=> "Validada",
			"rechazada"			=> "Rechazada",
			"adjudicada"		=> "Adjudicada"
		);

		return $etiquetas[$estado];
	}	
	/* --------------------------------------------------------- */
	function iconoEstadoNominacion( $estado ){
		// Devuelve el ícono de estado de nominación según valor
		$iconos = array(
			"pendiente" 		=> "<i class='fa fa-clock-o'></i>",
			"pendiente_ss" 		=> "<i class='fa fa-clock-o'></i>",
			"sustento"			=> "<i class='fa fa-file-o'></i>",
			"sustento_vp"		=> "<i class='fa fa-file-o'></i>",
			"validada"			=> "<i class='fa fa-check-circle'></i>",
			"aprobada"			=> "<i class='fa fa-check-square-o'></i>",
			"rechazada"			=> "<i class='fa fa-times'></i>",
			"adjudicada"		=> "<i class='fa fa-gift'></i>"
		);

		return $iconos[$estado];
	}
	/* --------------------------------------------------------- */
	function claseEstadoNominacion( $estado ){
		// Devuelve la clase para asignar fondo de nominaciones según estado
		$iconos = array(
			"pendiente" 		=> "bg-dark",
			"pendiente_ss" 		=> "bg-dark",
			"sustento"			=> "bg-warning",
			"sustento_vp"		=> "bg-warning",
			"aprobada"			=> "bg-success",
			"validada" 			=> "bg-tertiary",
			"rechazada"			=> "bg-secondary",
			"adjudicada"		=> "bg-quartenary"
		);

		return $iconos[$estado];
	}
	/* --------------------------------------------------------- */
	function nominacionVisible( $idu, $nominacion ){
		// Devuelve verdadero si el contenido de una nominación es visible según perfil y estado
		$visible = false;

		if( $nominacion == NULL ) return false;

		// Si es perfil colaborador siendo nominador o nominado con nominación aprobada
		if( isV( 'pan_nom_apoyo' ) && (( $nominacion["idNOMINADOR"] == $idu ) || 
										(	$nominacion["idNOMINADO"] == $idu && 
											($nominacion["estado"] == "aprobada" || $nominacion["estado"] == "adjudicada") ) ) )
			$visible = true;

		// Perfiles administrador o evaluador
		if( isV( 'en_aprob_nom' ) || isV( 'en_votar' ) ) $visible = true;

		return $visible;
	}
	/* --------------------------------------------------------- */
	function obtenerNombreTitulo( $p ){
		// Devuelve el texto complementario para mostrar en la página de nominaciones
		$titulo = "";
		if( $p == "hechas" || $p == "recibidas" )
			$titulo = $p;

		return $titulo;
	}
	/* --------------------------------------------------------- */
	function obtenerListadoNominaciones( $dbh, $idu ){
		// Devuelve los registros de nominaciones de acuerdo al perfil para mostrar en la página de nominaciones

		if( isV( 'mp_nom_pers' ) ){ 		// Acceso a nominaciones hechas/recibidas
			if( isset( $_GET["param"] ) ){
				$data["titulo"] = obtenerNombreTitulo( $_GET["param"] );
				$data["nominaciones"] = obtenerNominacionesAccion( $dbh, $idu, $_GET["param"] );
			}else{
				$data["titulo"] = obtenerNombreTitulo( "hechas" );
				$data["nominaciones"] = obtenerNominacionesAccion( $dbh, $idu, "hechas" );
			}
		}
		if( isV( 'ver_tnominac' ) && !isset( $_GET["param"] ) ){		
		// Acceso a ver todas las nominaciones sin parámetros: realizadas, recibidas
			$data["titulo"] = obtenerNombreTitulo( "" );
			$data["nominaciones"] = obtenerNominacionesRegistradas( $dbh );
		}

		return $data;
	}
	/* --------------------------------------------------------- */
	function esActivable( $nominacion ){
		// Devuelve verdadero si una nominación puede ser activada/desactivada para votación
		$activable = false;
		if( isV( 'en_activ_nom' ) && ( $nominacion["estado"] == "pendiente" || 
									   $nominacion["estado"] == "sustento" ) )
			$activable = true;

		return $activable;
	}
	/* --------------------------------------------------------- */
	function posicionSuiche( $votable ){
		// Devuelve checked si una nominación está abierta a votación
		$checked["p"] = ""; $checked["t"] = "Activar para votación";
		if( $votable ) {
			$checked["p"] = "checked"; 
			$checked["t"] = "Desactivar para votación";
		}
		
		return $checked;
	}
	/* --------------------------------------------------------- */
	function esRecibida(){
		// Determina si el listado de nominaciones son recibidas
		$recibidas = false;

		if( isset( $_GET["param"] ) &&  $_GET["param"] == 'recibidas' )
			$recibidas = true;

		return $recibidas;
	}
	/* --------------------------------------------------------- */
	function enviaSustento( $idu, $nominacion ){
		// Determina si el usuario actual puede enviar sustentos
		$envia = false;

		if ( ( $nominacion["estado"] == "sustento" || $nominacion["estado"] == "sustento_vp" ) 
				&& $nominacion["idNOMINADOR"] == $idu )
			$envia = true;

		return $envia;
	}
	/* --------------------------------------------------------- */
	function enlNominacion( $nominacion, $recibida ){
		// Devuelve el enlace a la ficha de nominación en función si es recibida o no
		$param = ( $recibida ) ? "&recibida" : "";
		$lnk = "nominacion.php?id=$nominacion[idNOMINACION]".$param;

		return $lnk;
	}
	/* --------------------------------------------------------- */
	function solicitableSustento( $dbh, $idu, $nominacion ){
		// Evalúa si puede mostrarse la opción para solicitar sustento a una nominación
		$solicitar_sustento = false;

		$es_admin = esRol( $dbh, 1, $idu );					//Rol 1: Administrador ( Admin )
		if( $nominacion["motivo2"] == "" && $nominacion["sustento2"] == "" && $es_admin ){
			if( $nominacion["estado"] == "pendiente" || $nominacion["estado"] == "validada" )
				$solicitar_sustento = true;
		}

		return $solicitar_sustento;
	}
	/* --------------------------------------------------------- */
	function solicitableSustentoVP( $nominacion ){
		// Evalúa si puede mostrarse la opción para solicitar sustento a una nominación
		$solicitar_sustento = false;

		if( $nominacion["sustento2"] == "" && $nominacion["motivo2"] == "" )
			$solicitar_sustento = true;

		return $solicitar_sustento;
	}
	/* --------------------------------------------------------- */
	function esNominacionMismoDepartamento( $nominacion ){
		// Evalúa si una nominación está hecha entre usuarios del mismo departamento
		return ( $nominacion["iddpto_nominador"] == $nominacion["iddpto_nominado"] );
	}
	/* --------------------------------------------------------- */
	function esAprobadaPorVP( $dbh, $idu, $nominacion ){
		// Evalúa si una nominación es aprobada directamente por el VP del departamento del nominado y nominador. Caso: el VP no es el nominador.
		$aprobable 	= false;
		$mismo_dpto = false;

		$es_vp = esRol( $dbh, 4, $idu );	//Rol 4: Vicepresidente ( VP )
		$id_dpto_usuario = obtenerIdDepartamentoUsuario( $dbh, $idu );
		if ( $id_dpto_usuario == $nominacion["iddpto_nominador"] && $id_dpto_usuario == $nominacion["iddpto_nominado"] ) 
			$mismo_dpto = true;
		
		if( $mismo_dpto && $es_vp ) 
			$aprobable = true;

		return $aprobable;
	}
	/* --------------------------------------------------------- */
	function esValidadaPorVP( $dbh, $idu, $nominacion ){
		// Evalúa si una nominación es validada inicialmente por el VP del departamento del nominado.
		// Caso: nominador y nominado son de departamentos diferentes.
		$validable = false;

		$es_vp = esRol( $dbh, 4, $idu );	//Rol 4: Vicepresidente ( VP )
		$id_dpto_usuario = obtenerIdDepartamentoUsuario( $dbh, $idu );
		$mismo_dpto = ( $id_dpto_usuario == $nominacion["iddpto_nominado"] );
		
		if( $es_vp && $mismo_dpto && 
			( $nominacion["estado"] == "pendiente" || $nominacion["estado"] == "pendiente_ss" ) ) 
			$validable = true;

		return $validable;
	}
	/* --------------------------------------------------------- */
?>