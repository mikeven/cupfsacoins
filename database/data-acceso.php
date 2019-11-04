<?php
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Accesos a roles de usuario */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function obtenerAccionesRol( $dbh, $idr ){
		//
		$q = "select a.idAccion, a.nombre, a.descripcion from accion a, permiso p 
		where a.idAccion = p.idAccion and p.idROL = $idr";
		
		$data = mysqli_query( $dbh, $q );

		return obtenerListaRegistros( $data );
	}
	/* --------------------------------------------------------- */
	function obtenerSeccionesAccion( $accion ){
		include( "../fn/accesos.php" );
		if( isset( $esq_secciones[ $accion["nombre"] ] ) )
			return $esq_secciones[ $accion["nombre"] ];
		else 
			return NULL;
	}
	/* --------------------------------------------------------- */
	function obtenerAccesosUsuario( $dbh, $acciones ){
		// Devuelve las secciones a las que puede acceder un usuarios según la lista de acciones que puede hacer
		
		$accesos = array();
		foreach ( $acciones as $accion ) {

			$secciones_accion = obtenerSeccionesAccion( $accion );
			if( $secciones_accion != NULL ){
				foreach ( $secciones_accion as $seccion ) {
					//echo $seccion."<br>";
					$accesos[] = $seccion["id"];
				}
			}
		}

		return $accesos;
	}
	/* --------------------------------------------------------- */
	function obtenerAccionesUsuario( $dbh, $roles ){
		// Devuelve la lista de acciones que puede realizar un usuario de acuero a los roles que posee

		$lista_acciones = array();
		foreach ( $roles as $rol ) {
			$acciones = obtenerAccionesRol( $dbh, $rol["idRol"] );
			foreach ( $acciones as $accion ) {
				$lista_acciones[] = $accion;
			}
		}

		return $lista_acciones;
	}
	/* --------------------------------------------------------- */
	function obtenerRolesUsuario( $dbh, $idu ){
		//
		$q = "select r.idRol, r.nombre from rol r, usuario_rol ur 
		where ur.idROL = r.idRol and ur.idUSUARIO = $idu";
		
		$data = mysqli_query( $dbh, $q );
		$lista = obtenerListaRegistros( $data );
		return $lista;
	}
	/* --------------------------------------------------------- */
	function iniciarSesion( $usuario, $dbh ){
		session_start();
		$idresult = 0; 
		$q = "select * from usuario where email = '$usuario[email]' and password = '$usuario[password]'";
		//echo $q;
		$data 	= mysqli_query ( $dbh, $q );
		$data_u = mysqli_fetch_array( $data );
		$nrows 	= mysqli_num_rows( $data );
		
		if( $nrows > 0 ){
			$_SESSION["login"] 	= 1;
			$data_u["roles"] 	= obtenerRolesUsuario( $dbh, $data_u["idUSUARIO"] );
			$data_u["acciones"] = obtenerAccionesUsuario( $dbh, $data_u["roles"] );
			$data_u["accesos"] 	= obtenerAccesosUsuario( $dbh, $data_u["acciones"] );
			$_SESSION["user"] 	= $data_u;
			$idresult 			= 1; 
		}
		
		return $idresult;
	}
	/* --------------------------------------------------------- */
	function checkSession(){
		// Redirecciona a la página de inicio de sesión en caso de no existir sesión de usuario
		if( isset( $_SESSION["user"] ) ){
			
		}else{
			echo "<script> window.location = 'index.php'</script>";		
		}
	}
	/* --------------------------------------------------------- */
	//Inicio de sesión (asinc)
	if( isset( $_POST["login"] ) ){ 
		// Invocación desde: js/fn-acceso.js
		include( "bd.php" );
		$usuario["email"] 		= $_POST["email"];
		$usuario["password"] 	= $_POST["password"];
		
		echo iniciarSesion( $usuario, $dbh );
	}
	/* --------------------------------------------------------- */
	//Cierre de sesión
	if( isset( $_GET["logout"] ) ){
		
		unset( $_SESSION["login"] );
		unset( $_SESSION["user"] );
		echo "<script> window.location = 'index.php'</script>";		
	}
	/* --------------------------------------------------------- */
	checkSession();
?>