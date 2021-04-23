<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre atributos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	define( "RUTA_ATRIBUTO", "../upload/atributos/" );

	/* --------------------------------------------------------- */
	function obtenerAtributoPorId( $dbh, $ida ){
		//Devuelve el registro de un atributo dado su id
		$q = "select idATRIBUTO, nombre, valor, prioridad, definicion, imagen  
				from atributo where idATRIBUTO = $ida";
		
		return mysqli_fetch_array( mysqli_query( $dbh, $q ) );
	}
	/* --------------------------------------------------------- */
	function obtenerAtributosRegistrados( $dbh ){
		//Devuelve todos los registros de atributos
		$q = "select idATRIBUTO, nombre, valor, prioridad, definicion, imagen  
				from atributo order by valor asc";
		
		$data = mysqli_query( $dbh, $q );

		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function agregarAtributo( $dbh, $atributo ){
		// Agrega nuevo registro de atributo
		$q = "insert into atributo ( nombre, valor, prioridad, definicion, imagen, fecha_creacion ) 
				values ( '$atributo[nombre]', $atributo[valor], $atributo[prioridad], 
				'$atributo[definicion]', '$atributo[imagen]', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarDatosAtributo( $dbh, $atributo ){
		// Actualiza los datos de un atributo
		$imagen = trim( $atributo["imagen"] );
		
		$q = "update atributo set nombre = '$atributo[nombre]', valor = $atributo[valor], 
		prioridad = $atributo[prioridad], definicion = '$atributo[definicion]', imagen = '$imagen', 
		fecha_modificacion = NOW() where idATRIBUTO = $atributo[idatributo]";
		
		return mysqli_query( $dbh, $q );
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
	function limpiarArchivosAtributos( $dbh ){
		// Elimina archivos cargados al servidor que no estén asociados a regitros de productos
		include( "../fn/fn-misc.php" ); //"\n"
		
		$directorio = "../upload/atributos";
		$imgs = arr_claves( obtenerAtributosRegistrados( $dbh ), "imagen" );

		foreach ( $imgs as $i ) { 
			$imagenes[] = trim( str_replace( "upload/atributos/", "", $i ) ); 
		}
		//print_r($imagenes);
		$gestor_dir = opendir( $directorio );
		while ( false !== ( $nombre_fichero = readdir( $gestor_dir ) ) ) {
		    $ficheros[] = $nombre_fichero;		    
		}
		//print_r($ficheros);
		foreach ( $ficheros as $arc ) {
			$archivo = $directorio."/".$arc;
			if( $arc != "." && $arc != ".." ){
				if( !in_array( $arc, $imagenes ) )
					unlink( $archivo );
			}
		}
	}
	/* --------------------------------------------------------- */
	function nombrePrefijo(){
		// Devuelve un prefijo de nombre a un archivo basado en una marca de tiempo
		return date_timestamp_get( date_create() );
	}
	/* --------------------------------------------------------- */
	function eliminarArchivoImagenAtributo( $archivo ){
		// Elimina un archivo de imagen
		$pre = "../";
		if( file_exists( $pre.$archivo ) && is_dir( $pre.$archivo ) != 1 )
			return unlink( $pre.$archivo );
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
			$res["mje"] = "Error al agregar atributo";
		}
		
		limpiarArchivosAtributos( $dbh );
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["form_matrib"] ) ){
		// Solicitud para editar atributo

		include( "bd.php" );

		parse_str( $_POST["form_matrib"], $atributo );
		$atributo 	= escaparCampos( $dbh, $atributo );
		$rsp 		= editarDatosAtributo( $dbh, $atributo );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] 	= 1;
			$res["mje"] 	= "Atributo modificado con éxito";
		} else {
			$res["exito"] 	= 0;
			$res["mje"] 	= "Error al modificar atributo";
		}
		
		limpiarArchivosAtributos( $dbh );
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_atributo"] ) ){
		// Solicitud para eliminar atributo

		include( "bd.php" );
		$atributo = obtenerAtributoPorId( $dbh, $_POST["elim_atributo"] );
		eliminarArchivoImagenAtributo( $atributo["imagen"] );
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
	if ( !empty( $_FILES ) ) {
		// Recepción y carga de imagen de atributo
		include( "bd.php" );
		$url = "";

		$tempFile = $_FILES['file']['tmp_name'];     
    	$prefijo = nombrePrefijo();
    	$nombre = $_FILES['file']['name']; 
    	$targetFile =  RUTA_ATRIBUTO . $prefijo ."-". $nombre;
 
    	if( move_uploaded_file( $tempFile, $targetFile ) )
    		$url = substr( $targetFile, 3 );
    	
    	echo $url;
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nombre"] ) ){
		// Verificación de nombre disponible para atributo

		include ( "bd.php" );
		$disponible = true;
		$edicion 	= isset( $_POST["idatributo_edit"] );

		$regs = obtenerAtributosRegistrados( $dbh );
		foreach ( $regs as $r ) { 
			if( $_POST["nombre"] == $r["nombre"] ){
				if( $edicion && $_POST["idatributo_edit"] != $r["idATRIBUTO"] )
					$disponible = "Nombre de atributo ya registrado";
				if( !$edicion )
					$disponible = "Nombre de atributo ya registrado";
			} 
		}
	
		echo json_encode( $disponible );
	}
	/* --------------------------------------------------------- */
?>