<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre atributos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerAtributosRegistrados( $dbh ){
		//Devuelve todos los registros de atributos
		$q = "select idATRIBUTO, nombre, valor, prioridad, definicion, imagen  
		from atributo order by nombre asc";
		
		$data = mysqli_query( $dbh, $q );

		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function agregarAtributo( $dbh, $atributo ){
		// Agrega nuevo registro de atributo
		$q = "insert into atributo ( nombre, valor, prioridad, definicion, fecha_creacion ) 
		values ( '$atributo[nombre]', $atributo[valor], $atributo[prioridad], 
		'$atributo[definicion]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function registrosAsociadosAtributo( $dbh, $ida ){
		// Determina si existe un registro de tabla asociada a un atributo
		// Tablas relacionadas: nominacion

		return registroAsociadoTabla( $dbh, "nominacion", "idATRIBUTO", $ida );
	}
	/* --------------------------------------------------------- */
	function eliminarAtributo( $dbh, $idu ){
		// Elimina un registro de atributo
		$q = "delete from atributo where idATRIBUTO = $idu";
		
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nvo_atributo"] ) ){
		// Solicitud para agregar nuevo atributo

		include( "bd.php" );
		parse_str( $_POST["nvo_atributo"], $atributo );
		$atributo = escaparCampos( $dbh, $atributo );
		$id = agregarAtributo( $dbh, $atributo );
		
		if( ( $id != 0 ) && ( $id != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Atributo agregado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al agregado atributo";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_atributo"] ) ){
		// Solicitud para eliminar atributo

		include( "bd.php" );
		$rsp = eliminarAtributo( $dbh, $_POST["elim_atributo"] );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Atributo eliminado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al eliminar atributo";
			$res["reg"] = NULL;
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nombre"] ) ){
		
		include ( "bd.php" );

		$regs = obtenerAtributosRegistrados( $dbh );
		foreach ( $regs as $r ) { $nombres[] = $r["nombre"]; }
		
		if( !in_array( $_POST["nombre"], $nombres ) ) $respuesta = true;
		else $respuesta = "Nombre de atributo ya registrado";

		echo json_encode( $respuesta );
	}
	/* --------------------------------------------------------- */
?>