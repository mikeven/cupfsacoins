<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Datos sobre productos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */

	define( "RUTA_CATALOGO", "../upload/productos/" );

	/* --------------------------------------------------------- */
	function obtenerProductoPorId( $dbh, $idp ){
		//Devuelve el registro de una nominacion dado su id
		$q = "select idPRODUCTO, nombre, descripcion, valor, imagen,  
		date_format(fecha_creacion,'%d/%m/%Y') as fregistro from producto where 
		idPRODUCTO = $idp";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_fetch_array( $data );
	}
	/* --------------------------------------------------------- */
	function obtenerProductosRegistrados( $dbh ){
		//Devuelve todos los registros de productos
		$q = "select idPRODUCTO, nombre, descripcion, valor, imagen,  
		date_format(fecha_creacion,'%d/%m/%Y') as fregistro from producto 
		order by nombre asc";
		
		$data = mysqli_query( $dbh, $q );

		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function nombrePrefijo(){
		// Devuelve un prefijo de nombre a un archivo basado en una marca de tiempo
		return date_timestamp_get( date_create() );
	}
	/* --------------------------------------------------------- */
	function agregarProducto( $dbh, $producto ){
		// Guarda un nuevo registro de nominación
		$imagen = trim( $producto["imagen"] );
		$q = "insert into producto ( nombre, valor, descripcion, imagen, fecha_creacion ) 
		values ( '$producto[nombre]', $producto[valor], '$producto[descripcion]', 
		'$imagen', NOW() )";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function editarProducto( $dbh, $producto ){
		// Actualiza los datos de un producto
		$imagen = trim( $producto["imagen"] );
		$q = "update producto set nombre = '$producto[nombre]', valor = $producto[valor], 
		descripcion = '$producto[descripcion]', imagen = '$imagen', 
		fecha_modificado = NOW() where idPRODUCTO = $producto[idproducto]";
	
		$data = mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function eliminarProducto( $dbh, $idp ){
		// Elimina un registro de producto
		$q = "delete from producto where idPRODUCTO = $idp";
		return mysqli_query( $dbh, $q );
	}
	/* --------------------------------------------------------- */
	function agregarCanje( $dbh, $canje ){
		// Guarda el registro de un caje de producto
		$q = "insert into canje ( idUSUARIO, idPRODUCTO, valor, fecha_canje ) 
		values ( $canje[idusuario], $canje[idproducto], $canje[valor], NOW() )";

		$data = mysqli_query( $dbh, $q );
		return mysqli_insert_id( $dbh );
	}
	/* --------------------------------------------------------- */
	function limpiarArchivos( $dbh ){
		// Elimina archivos cargados al servidor que no estén asociados a regitros de productos
		include( "../fn/fn-misc.php" ); //"\n"
		
		$directorio = "../upload/productos";
		$imgs = arr_claves( obtenerProductosRegistrados( $dbh ), "imagen" );

		foreach ( $imgs as $i ) { 
			$imagenes[] = str_replace( "upload/productos/", "", $i ); 
		}
		
		$gestor_dir = opendir( $directorio );
		while ( false !== ( $nombre_fichero = readdir( $gestor_dir ) ) ) {
		    $ficheros[] = $nombre_fichero;		    
		}
		
		foreach ( $ficheros as $arc ) {
			$archivo = $directorio."/".$arc;
			if( $arc != "." && $arc != ".." ){
				if( !in_array( $arc, $imagenes ) )
					unlink( $archivo );
			}
		}
	}
	/* --------------------------------------------------------- */
	function eliminarArchivoImagen( $archivo ){
		// Elimina un archivo de imagen
		$pre = "../";
		if( file_exists( $pre.$archivo ) && is_dir( $pre.$archivo ) != 1 )
			return unlink( $pre.$archivo );
	}
	/* --------------------------------------------------------- */
	function obtenerCanjesRegistrados( $dbh, $idu ){
		// Devuelve los registros de canjes de un usuario. Si no se especifica id de usuario, retorna todos los registros.
		$sq = "";
		if( $idu != "" ) $sq = "and c.idUSUARIO = $idu";
		$q = "select c.idCANJE, c.idUSUARIO, c.idPRODUCTO, c.valor, 
		date_format(c.fecha_canje,'%d/%m/%Y') as fregistro, u.nombre, u.apellido, 
		p.nombre as producto from canje c, usuario u, producto p  
		where u.idUSUARIO = c.idUSUARIO and c.idPRODUCTO = p.idPRODUCTO $sq 
		order by c.fecha_canje desc";
		
		$data = mysqli_query( $dbh, $q );

		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function registrosAsociadosProducto( $dbh, $idp ){
		//Determina si existe un registro de alguna tabla asociada a un producto
		//Tablas relacionadas: canje

		return registroAsociadoTabla( $dbh, "canje", "idPRODUCTO", $idp );
	}
	/* --------------------------------------------------------- */
	// Solicitudes asíncronas
	/* --------------------------------------------------------- */
	if( isset( $_POST["form_np"] ) ){
		// Solicitud para registrar nuevo producto

		include( "bd.php" );	
		
		parse_str( $_POST["form_np"], $producto );
		$producto = escaparCampos( $dbh, $producto );
		$id = agregarProducto( $dbh, $producto );
		$producto["id"] = $id;
		
		if( ( $id != 0 ) && ( $id != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Registro de producto exitoso";
			$res["reg"] = $producto;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al registrar producto";
			$res["reg"] = NULL;
		}
		
		limpiarArchivos( $dbh );
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["form_mp"] ) ){
		// Solicitud para modificar producto

		include( "bd.php" );	
		
		parse_str( $_POST["form_mp"], $producto );
		$producto = escaparCampos( $dbh, $producto );
		$rsp = editarProducto( $dbh, $producto );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Datos de producto actualizados";
			$res["reg"] = $producto;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al actualizar producto";
			$res["reg"] = NULL;
		}

		limpiarArchivos( $dbh );
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["elim_prod"] ) ){
		// Solicitud para eliminar producto

		include( "bd.php" );
		
		$archivo_eliminado = eliminarArchivoImagen( $_POST["img"] );
		$rsp = eliminarProducto( $dbh, $_POST["elim_prod"] );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Producto eliminado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al eliminar producto";
			$res["reg"] = NULL;
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["form_ncje"] ) ){
		//Solicitud para registrar nuevo canje de producto

		include( "bd.php" );
		
		parse_str( $_POST["form_ncje"], $canje );
		$canje = escaparCampos( $dbh, $canje );
		$id = agregarCanje( $dbh, $canje );
		
		if( ( $id != 0 ) && ( $id != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Canje realizado con éxito";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al canjear producto";
		}

		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if ( !empty( $_FILES ) ) {
		include( "bd.php" );
		$url = "";

		$tempFile = $_FILES['file']['tmp_name'];     
    	$prefijo = nombrePrefijo();
    	$nombre = $_FILES['file']['name']; 
    	$targetFile =  RUTA_CATALOGO . $prefijo ."-". $nombre;
 
    	if( move_uploaded_file( $tempFile, $targetFile ) )
    		$url = substr( $targetFile, 3 );
    	
    	echo $url;
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["nombre"] ) ){
		// Validación de nombre ya registrado
		include ( "bd.php" );

		$regs = obtenerProductosRegistrados( $dbh );
		foreach ( $regs as $r ) { $nombres[] = $r["nombre"];  }
		
		if( !in_array( $_POST["nombre"], $nombres ) )  $respuesta = true;
		else $respuesta = "Nombre de producto ya registrado";

		echo json_encode( $respuesta );
	}
	/* --------------------------------------------------------- */
?>