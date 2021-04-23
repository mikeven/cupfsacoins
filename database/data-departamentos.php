<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre departamentos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerDepartamentosRegistrados( $dbh ){
		//Devuelve todos los registros de departamentos
		$q = "select idDepartamento, nombre from departamento order by nombre asc";
		
		return obtenerListaRegistros( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerDepartamentoPorId( $dbh, $idd ){
		//Devuelve todos los registros de departamentos
		$q = "select idDepartamento, nombre from departamento where idDepartamento = $idd";
		
		return mysqli_fetch_array( mysqli_query ( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function agregarDepartamento( $dbh, $dpto ){
		// Agrega nuevo registro de departamento
		$q = "insert into departamento ( nombre, fecha_creacion ) values ( '$dpto[nombre]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarDepartamento( $dbh, $departamento ){
		// Actualiza los datos de un departamento
		$q = "update departamento set nombre = '$departamento[nombre]' where idDepartamento = ".$departamento["id_departamento"];
		
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function registrosAsociadosDepartamento( $dbh, $idd ){
		// Determina si existe un registro de tabla asociada a un departamento
		// Tablas relacionadas: usuarios

		return registroAsociadoTabla( $dbh, "usuario", "idDepartamento", $idd );
	}
	/* --------------------------------------------------------- */
	function eliminarDepartamento( $dbh, $idd ){
		// Elimina un registro de departamento
		$q = "delete from departamento where idDepartamento = $idd";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nvo_dpto"] ) ){
		// Solicitud para agregar nuevo departamento

		include( "bd.php" );
		parse_str( $_POST["nvo_dpto"], $departamento );
		$departamento = escaparCampos( $dbh, $departamento );
		$id = agregarDepartamento( $dbh, $departamento );
		
		if( ( $id != 0 ) && ( $id != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Departamento agregado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al agregar departamento";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["form_mdpto"] ) ){
		// Solicitud para modificar departamento

		include( "bd.php" );	
		
		parse_str( $_POST["form_mdpto"], $departamento );
		
		$departamento 	= escaparCampos( $dbh, $departamento );
		$rsp 			= editarDepartamento( $dbh, $departamento );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Datos de departamento actualizados";
			$res["reg"] = $departamento;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al modificar departamento";
			$res["reg"] = NULL;
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_dpto"] ) ){
		// Solicitud para eliminar departamento

		include( "bd.php" );
		$rsp = eliminarDepartamento( $dbh, $_POST["elim_dpto"] );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Departamento eliminado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al eliminar departamento";
			$res["reg"] = NULL;
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nombre"] ) ){
		// Verificación de nombre disponible para departamento

		include ( "bd.php" );
		$disponible = true;
		$edicion 	= isset( $_POST["iddpto"] );

		$regs = obtenerDepartamentosRegistrados( $dbh );
		foreach ( $regs as $r ) { 
			if( $_POST["nombre"] == $r["nombre"] ){
				if( $edicion && $_POST["iddpto"] != $r["idDepartamento"] )
					$disponible = "Nombre de departamento ya registrado";
				if( !$edicion )
					$disponible = "Nombre de departamento ya registrado";
			} 
		}
	
		echo json_encode( $disponible );
	}
	/* --------------------------------------------------------- */
?>