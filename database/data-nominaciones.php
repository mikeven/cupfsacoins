<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre nominaciones */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	define( "RUTA_SUSTENTOS", "../upload/" );

	function obtenerNominacionPorId( $dbh, $idn ){
		//Devuelve el registro de una nominacion dado su id
		$q = "select n.idNOMINACION, n.idNOMINADOR, n.idNOMINADO, n.idATRIBUTO, 
		u1.nombre as nombre1, u1.apellido as apellido1, u2.nombre as nombre2, 
		u2.apellido as apellido2, n.valor_atributo as valor, a.nombre as atributo, 
		a.imagen, n.estado, n.motivo1, n.sustento1, n.motivo2, n.sustento2, 
		n.motivo_vp, n.sustento_vp, n.votable, n.obs_comite, n.obs_vp, n.obs_sustento, n.obs_sustento_vp, 
		d1.idDepartamento as iddpto_nominador, d2.idDepartamento as iddpto_nominado, 
		date_format(n.fecha_nominacion,'%d/%m/%Y') as fregistro, 
		date_format(n.fecha_cierre,'%d/%m/%Y') as fcierre,
		date_format(n.fecha_adjudicacion,'%d/%m/%Y') as fadjudicada 
		from nominacion n, usuario u1, usuario u2, atributo a, departamento d1, departamento d2 
		where n.idNOMINADOR = u1.idUSUARIO and n.idNOMINADO = u2.idUSUARIO 
		and n.idATRIBUTO = a.idATRIBUTO and u1.idDepartamento = d1.idDepartamento and 
		u2.idDepartamento = d2.idDepartamento and n.idNOMINACION = $idn";
		
		$data = mysqli_query( $dbh, $q );
		$data ? $registro = mysqli_fetch_array( $data ) : $registro = NULL;
		return $registro;
	}
	/* --------------------------------------------------------- */
	function obtenerEstadoNominacionPorId( $dbh, $idn ){
		//Devuelve el estado de una nominacion dado su id
		$q = "select estado from nominacion where idNOMINACION = $idn";
		
		$data = mysqli_query( $dbh, $q );
		$data ? $registro = mysqli_fetch_array( $data ) : $registro = NULL;
		return $registro;
	}
	/* --------------------------------------------------------- */
	function obtenerNominacionesRegistradas( $dbh ){
		//Devuelve los registros de todas las nominaciones

		$q = "select n.idNOMINACION, n.idNOMINADOR, n.idNOMINADO, n.idATRIBUTO, 
		n.estado, u1.nombre as nombre1, u1.apellido as apellido1, u2.nombre as nombre2, 
		u2.apellido as apellido2, a.nombre as atributo, a.valor, a.imagen, n.votable, 
		n.sustento1, n.sustento2, d1.idDepartamento as iddpto_nominador, 
		d2.idDepartamento as iddpto_nominado, date_format(n.fecha_nominacion,'%d/%m/%Y') as fregistro 
		from nominacion n, usuario u1, usuario u2, atributo a, departamento d1, departamento d2 
		where n.idNOMINADO = u2.idUSUARIO and n.idNOMINADOR = u1.idUSUARIO 
		and n.idATRIBUTO = a.idATRIBUTO and u1.idDepartamento = d1.idDepartamento and 
		u2.idDepartamento = d2.idDepartamento order by n.fecha_nominacion desc";

		$data = mysqli_query( $dbh, $q );
		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function obtenerNominacionesPersonales( $dbh, $idu, $p, $p2 ){
		//Devuelve los registros de nominaciones hechas o recibidas por un usuario.

		$q = "select n.idNOMINACION, n.idNOMINADOR, n.idNOMINADO, n.idATRIBUTO, 
		u1.nombre as nombre1, u1.apellido as apellido1, d1.idDepartamento as iddpto_nominador, 
		d2.idDepartamento as iddpto_nominado, n.estado, u2.nombre as nombre2, u2.apellido as apellido2, 
		a.nombre as atributo, a.imagen, a.valor, n.votable, 
		date_format( n.fecha_nominacion,'%d/%m/%Y' ) as fregistro 
		from nominacion n, usuario u1, usuario u2, departamento d1, departamento d2, atributo a 
		where n.idNOMINADOR = u1.idUSUARIO and n.idNOMINADO = u2.idUSUARIO 
		and n.idATRIBUTO = a.idATRIBUTO and u1.idDepartamento = d1.idDepartamento and 
		u2.idDepartamento = d2.idDepartamento and $p = $idu $p2 order by n.fecha_nominacion desc";

		$data = mysqli_query( $dbh, $q );
		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function obtenerNominacionesPorVotar( $dbh, $idu ){
		//Devuelve los registros de nominaciones que no ha sido votada por un usuario dado su id.

		$q = "select n.idNOMINACION as id, n.idNOMINADOR, n.idNOMINADO, n.votable, 
		u2.nombre as nombre2, u2.apellido as apellido2, a.nombre as atributo,  
		a.valor, a.imagen, date_format(n.fecha_nominacion,'%d/%m/%Y') as fregistro 
		from nominacion n, usuario u2, atributo a where n.idNOMINADO = u2.idUSUARIO 
		and n.idATRIBUTO = a.idATRIBUTO and n.idNOMINACION not in 
		(select idNOMINACION from voto where idUSUARIO = $idu ) 
		order by n.fecha_nominacion desc";

		$data = mysqli_query( $dbh, $q );
		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function obtenerNominacionesAccion( $dbh, $idu, $accion ){
		//Invoca la obtención de nominaciones hechas/recibidas/no votadas por un usuario
		
		if( $accion == "hechas" ){ 		
			$p = "n.idNOMINADOR";
			$nominaciones = obtenerNominacionesPersonales( $dbh, $idu, $p, "" );
		}
		if( $accion == "recibidas" ){
			$p = "n.idNOMINADO";
			$p2 = "and estado = 'adjudicada'";
			$nominaciones = obtenerNominacionesPersonales( $dbh, $idu, $p, $p2 );
		}
		if( $accion == "votar" ){
			$nominaciones = obtenerNominacionesPorVotar( $dbh, $idu );
		}

		return $nominaciones;
	}
	/* --------------------------------------------------------- */
	function nombrePrefijo(){
		//Devuelve un prefijo de nombre a un archivo basado en una marca de tiempo
		return date_timestamp_get( date_create() );
	}
	/* --------------------------------------------------------- */
	function cargarArchivo( $archivo, $dir ){
		//Ubica el archivo subido en la ruta indicada

		$pref = nombrePrefijo( $archivo['name'] );
		$destino = $dir . $pref ."-". basename( $archivo['name'] );

		if ( move_uploaded_file( $archivo['tmp_name'], $destino  ) ) {
		    $carga["exito"] = 1;
		    $carga["ruta"] = substr( $destino, 3 );
		} else {
		    $carga["exito"] = 0;
		    $carga["ruta"] = "";
		}

		return $carga;
	}
	/* --------------------------------------------------------- */
	function agregarNominacion( $dbh, $nominacion ){
		//Guarda un nuevo registro de nominación

		$q = "insert into nominacion ( idNOMINADOR, idNOMINADO, idATRIBUTO, 
		valor_atributo, estado, motivo1, sustento1, fecha_nominacion ) values 
		( $nominacion[idnominador], $nominacion[idnominado], $nominacion[idatributo], 
		$nominacion[valor], '$nominacion[estado]', '$nominacion[motivo]', 
		'$nominacion[sustento]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function agregarSustentoVP( $dbh, $nominacion, $e_n ){
		// Actualiza una nominación con los datos del sustento adicional
		$q = "update nominacion set motivo_vp = '$nominacion[motivo2]', 
		sustento_vp = '$nominacion[sustento2]', estado = '$e_n' 
		where idNOMINACION = $nominacion[idnominacion]";
		
		$data = mysqli_query( $dbh, $q );

		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function agregarSustento( $dbh, $nominacion, $e_n ){
		// Actualiza una nominación con los datos del sustento adicional
		$q = "update nominacion set motivo2 = '$nominacion[motivo2]', 
		sustento2 = '$nominacion[sustento2]', estado = '$e_n' 
		where idNOMINACION = $nominacion[idnominacion]";
		
		$data = mysqli_query( $dbh, $q );

		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function registrarVoto( $dbh, $voto ){
		//Guarda un nuevo registro de voto

		$q = "insert into voto ( idUSUARIO, idNOMINACION, valor, fecha_voto ) 
		values ( $voto[idusuario], $voto[idnominacion], '$voto[voto]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );

		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function registrarEvaluacion( $dbh, $evaluacion, $cierre ){
		//Actualiza una nominación con los datos de su evaluación por un usuario admin
		$fc = "";
		if( $cierre ) $fc = ", fecha_cierre = NOW() ";
		if( $evaluacion["estado"] == "sustento" ) $campo_obs = "obs_sustento";
	    else
	    	$campo_obs = "obs_comite";
		
		$q = "update nominacion set idADMIN = $evaluacion[idusuario], 
		estado = '$evaluacion[estado]', $campo_obs = '$evaluacion[comentario]'$fc 
		where idNOMINACION = $evaluacion[idnominacion]";
		
		$data = mysqli_query( $dbh, $q );

		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function registrarEvaluacionVP( $dbh, $evaluacion, $cierre ){
		//Actualiza una nominación con los datos de su evaluación realizada por un usuario VP
		$fc = "";
		if( $cierre ) $fc = ", fecha_cierre = NOW() ";
		if( $evaluacion["estado"] == "validada" || $evaluacion["estado"] == "aprobada" ) $campo_obs = "obs_vp";
		if( $evaluacion["estado"] == "sustento_vp" ) $campo_obs = "obs_sustento_vp";

		$q = "update nominacion set idADMIN = $evaluacion[idusuario], 
		estado = '$evaluacion[estado]', $campo_obs = '$evaluacion[comentario]'$fc 
		where idNOMINACION = $evaluacion[idnominacion]";
		
		$data = mysqli_query( $dbh, $q );

		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function esVotada( $dbh, $idu, $idn ){
		//Devuelve si una nominación fue votada por un usuario (usuario en sesión)
		$votada = false;

		$q = "select idUSUARIO, idNOMINACION from voto where idUSUARIO = $idu and idNOMINACION = $idn";
		
		$nrows 	= mysqli_num_rows( mysqli_query ( $dbh, $q ) );
		if( $nrows > 0 ) 
			$votada = true;

		return $votada;
	}
	/* --------------------------------------------------------- */
	function obtenerVotosNominacion( $dbh, $idn, $cond ){
		//Devulve la cantidad de registros de votos de una nominación
		$c["todos"] = "";
		$c["si"] = "and valor = 'si'";
		$c["no"] = "and valor = 'no'";

		$q = "select count( idNOMINACION ) as votos from voto where idNOMINACION = $idn $c[$cond]";

		$data = mysqli_query( $dbh, $q );
		$cant = mysqli_fetch_array( $data );
		
		return $cant["votos"];
	}
	/* --------------------------------------------------------- */
	function contarVotos( $dbh, $idn ){
		//Devuelve la cantidad de votos totales, y votos por cada opción
		$votacion["votos"] 	= obtenerVotosNominacion( $dbh, $idn, 'todos' );
		$votacion["si"] 	= obtenerVotosNominacion( $dbh, $idn, 'si' );
		$votacion["no"] 	= obtenerVotosNominacion( $dbh, $idn, 'no' );
		$votacion["quorum"]	= quorumVotacion( $dbh, $votacion["votos"] );
		$votacion["estado"]	= obtenerEstadoNominacionPorId( $dbh, $idn )["estado"];

		return $votacion;
	}
	/* --------------------------------------------------------- */
	function adjudicarNominacion( $dbh, $idn ){
		// Adjudica una nominación al nominado: hace disponible los coins
		$q = "update nominacion set estado = 'adjudicada', fecha_adjudicacion = NOW() 
		where idNOMINACION = $idn";
		
		mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function aprobacionPorVP( $dbh, $nominacion ){
		// Procesa la aprobación y adjudicación de una nominación por parte de un VP
		$evaluacion["idusuario"] 		= $nominacion["idnominador"];
		$evaluacion["estado"] 			= "aprobada";
		$evaluacion["comentario"] 		= "";
		$evaluacion["idnominacion"] 	= $nominacion["id"];

		registrarEvaluacion( $dbh, $evaluacion, true );
		adjudicarNominacion( $dbh, $nominacion["id"] );
	}
	/* --------------------------------------------------------- */
	function nominacionMismoDepartamento( $dbh, $nominacion ){
		// Evalúa si una nominación está hecha entre usuarios del mismo departamento
		$mismo_departamento = false;

		$dpto_nominador = obtenerIdDepartamentoUsuario( $dbh, $nominacion["idnominador"] );
		$dpto_nominado = obtenerIdDepartamentoUsuario( $dbh, $nominacion["idnominado"] );
		
		if( $dpto_nominador == $dpto_nominado ) 
			$mismo_departamento = true;

		return $mismo_departamento;
	}
	/* --------------------------------------------------------- */
	function chequeoAprobacionVP( $dbh, $nominacion, $nominador_es_vp ){
		// Evalúa si una nominación registrada es aprobable de inmediato por usuario VP

		$departamental = nominacionMismoDepartamento( $dbh, $nominacion );

		if( $nominador_es_vp && $departamental ){
			// Si el nominador es VP y nominado y nominador son del mismo departamento
			aprobacionPorVP( $dbh, $nominacion );
		}
	}
	/* --------------------------------------------------------- */
	function abiertaVotacion( $dbh, $idn ){
		// Devuelve verdadero si una nominación está abierta a votación
		$q = "select votable from nominacion where idNOMINACION = $idn";
		
		$data = mysqli_fetch_array( mysqli_query( $dbh, $q ) );
		return $data["votable"];
	}
	/* --------------------------------------------------------- */
	function bloquearNominacion( $dbh, $valor, $idn ){
		// Asigna el valor votable de una nominación
		$q = "update nominacion set votable = $valor where idNOMINACION = $idn";
		
		mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function limpiarArchivos( $dbh ){
		// Elimina archivos cargados al servidor que no estén asociados a regitros de productos
		include( "../fn/fn-misc.php" );
		
		$directorio = "../upload";
		$ficheros = array();
		$nominaciones = obtenerNominacionesRegistradas( $dbh );

		$sustentos = array_merge( arr_claves( $nominaciones, "sustento1" ), 
									arr_claves( $nominaciones, "sustento2" ) );

		foreach ( $sustentos as $s ) { 
			$registros[] = str_replace( "upload/", "", $s ); 
		}
		
		$gestor_dir = opendir( $directorio );
		while ( false !== ( $nombre_fichero = readdir( $gestor_dir ) ) ) {
			if ( is_dir( $directorio."/".$nombre_fichero ) != 1 )
		    	$ficheros[] = $nombre_fichero;
		}
		
		foreach ( $ficheros as $arc ) {
			$archivo = $directorio."/".$arc;
			if( !in_array( $arc, $registros ) )
				unlink( $archivo );
		}
	}
	/* --------------------------------------------------------- */
	function mensajeMail( $dbh, $data ){
		include( "data-usuarios.php" );
		// Prepara los datos para enviar un mensaje por email
		
		$data_mail = obtenerNominacionPorId( $dbh, $data["idnominacion"] );
		$data_mail["evaluacion"] = $data["estado"];
		$data_us = obtenerUsuarioPorId( $dbh, $data_mail["idNOMINADOR"] );
		
		$data_mail["receptor"] = $data_us["email"];
		enviarMensajeEmail( "cambio_estatus", $data_mail );
	}
	/* --------------------------------------------------------- */
	function llevaFechaCierre( $evaluacion ){
		// Determina si una nominación incluirá fecha de cierre al registrar evaluación 
		$fecha_cierre = false;
		if( $evaluacion["estado"] == "aprobada" || $evaluacion["estado"] == "rechazada" )
			$fecha_cierre = true;

		return $fecha_cierre;
	}
	/* --------------------------------------------------------- */
	function postNominacion( $dbh, $nominacion, $vp_nominado ){
		// Acciones posteriores al registro de una nueva nominación
		// Acciones: chequeo de aprobación inmediata por VP; activar votación de nominación

		$nr_es_vp = esRol( $dbh, 4, $nominacion["idnominador"] );	//Rol 4: Vicepresidente ( VP )
		chequeoAprobacionVP( $dbh, $nominacion, $nr_es_vp );
		if( $vp_nominado )
			bloquearNominacion( $dbh, true, $nominacion["id"] );
	}
	/* --------------------------------------------------------- */
	// Solicitudes asíncronas
	/* --------------------------------------------------------- */
	if( isset( $_POST["nva_nominacion"] ) ){
		//Solicitud para registrar una nueva nominación

		include( "bd.php" );
		include( "data-usuarios.php" );

		$nominacion["idnominador"] 	= $_POST["nva_nominacion"];
		$nominacion["idnominado"] 	= $_POST["id_persona"];
		$nominacion["idatributo"] 	= $_POST["atributo"];
		$nominacion["valor"] 		= $_POST["valor_atributo"];
		$nominacion["motivo"] 		= $_POST["motivo"];
		$nominacion["sustento"]		= "";
		$nominacion["estado"] 		= "pendiente";
		$vp_nominado 				= false;

		if( isset( $_FILES["archivo"] ) ){
			$archivo = cargarArchivo( $_FILES["archivo"], RUTA_SUSTENTOS );
			if( $archivo["exito"] == 1 )
				$nominacion["sustento"] = $archivo["ruta"];
		}

		$nominacion = escaparCampos( $dbh, $nominacion );
		
		if( esRol( $dbh, 4, $nominacion["idnominado"] ) ){
			// El nominado es un usuario VP: nominación se registra como 'validada'
			$vp_nominado = true;
			$nominacion["estado"] = "validada";
		}

		$id = agregarNominacion( $dbh, $nominacion );
		$nominacion["id"] = $id;
		
		if( ( $id != 0 ) && ( $id != "" ) ){
			$res["exito"] = 1;
			postNominacion( $dbh, $nominacion, $vp_nominado );
			$res["mje"] = "Registro de nominación exitoso";
			$res["reg"] = $nominacion;
			limpiarArchivos( $dbh );
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar nominación";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["votar"] ) ){
		//Solicitud para registrar un voto sobre nominación
		include( "bd.php" );

		parse_str( $_POST["votar"], $voto );
		if( abiertaVotacion( $dbh, $voto["idnominacion"] ) ){
			$id = registrarVoto( $dbh, $voto );
			
			if( ( $id != 0 ) && ( $id != "" ) ){
				$res["exito"] = 1;
				$res["mje"] = "Voto registrado con éxito";
			} else {
				$res["exito"] = 0;
				$res["mje"] = "Error al registrar voto";
			}
		}else{
			$res["exito"] = 0;
			$res["mje"] = "Nominación cerrada para votación";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["act_votos"] ) ){
		//Solicitud para obtener los votos de una nominación
		include( "bd.php" );
		include( "data-usuarios.php" );

		$votos = contarVotos( $dbh, $_POST["act_votos"] );
		echo json_encode( $votos );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["evaluar"] ) ){
		//Solicitud para registrar una evaluación de admin o VP: solicitud de sustento o comentario para aprobar/rechazar
		include( "bd.php" );
		include( "../fn/fn-mailing.php" );

		parse_str( $_POST["evaluar"], $evaluacion );
		$cierre = llevaFechaCierre( $evaluacion );

		$evaluacion = escaparCampos( $dbh, $evaluacion );

		if( $evaluacion["es_vp"] == 1 ){
			// Evaluación proveniente de un usuario VP

			$rsp = registrarEvaluacionVP( $dbh, $evaluacion, $cierre );

			if( $evaluacion["estado"] == "validada" )	// Activa nominación para votación
				bloquearNominacion( $dbh, true, $evaluacion["idnominacion"] );

		}else{
			// Evaluación proveniente de un usuario Admin

			$rsp = registrarEvaluacion( $dbh, $evaluacion, $cierre );
		}

		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			mensajeMail( $dbh, $evaluacion );
			$res["mje"] = "Evaluación registrada con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar evaluación";
		}
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["seg_sustento"] ) ){
		//Solicitud para registrar sustento adicional sobre nominación

		include( "bd.php" );

		$nominacion["idnominacion"] = $_POST["seg_sustento"];
		$nominacion["motivo2"] 		= $_POST["motivo2"];
		$nominacion["edo_nom"]		= $_POST["edo_nom"];
		$nominacion["sustento2"]	= "";

		if( isset( $_FILES["archivo"] ) ){
			$archivo = cargarArchivo( $_FILES["archivo"], RUTA_SUSTENTOS );
			if( $archivo["exito"] == 1 )
				$nominacion["sustento2"] = $archivo["ruta"];
		}

		$nominacion = escaparCampos( $dbh, $nominacion );
		if( $nominacion["edo_nom"] == "sustento_vp" ){
			$rsp = agregarSustentoVP( $dbh, $nominacion, "pendiente_svp" );
		}
		else
			$rsp = agregarSustento( $dbh, $nominacion, "pendiente_ss" );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Registro de sustento exitoso";
			limpiarArchivos( $dbh );			
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar sustento";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["adjudicar"] ) ){
		//Solicitud para adjudicar una nominación
		include( "bd.php" );
		
		$rsp = adjudicarNominacion( $dbh, $_POST["adjudicar"] );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Nominación adjudicada";			
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al adjudicar nominación";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["bloquear"] ) ){
		//Solicitud para bloquear/desbloquear la votación sobre una nominación
		include( "bd.php" );
		
		$rsp = bloquearNominacion( $dbh, $_POST["bloquear"], $_POST["idn"] );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			if( $_POST["bloquear"] == 'false' )
				$res["mje"] = "Nominación ha sido cerrada para votación";
			else 	
				$res["mje"] = "Nominación ha sido abierta para votación";		
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar nominación";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
?>