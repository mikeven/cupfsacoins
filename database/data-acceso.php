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
	function enviarPasswordEmail( $e_mail, $token ){
		// Envía un mensaje por email con contraseña de usuario

		$asunto = "Reestablecimiento de contraseña";
		$oemail = "digital@cupfsa.com";
		
		$cabeceras = "Reply-To: CUPFSA COINS <$oemail>\r\n"; 
  		$cabeceras .= "Return-Path: CUPFSA COINS <$oemail>\r\n";
  		$cabeceras .= "From: CUPFSA COINS <$oemail>\r\n"; 
		$cabeceras .= "Organization: CUPFSA COINS\r\n";
	  	$cabeceras .= "X-Priority: 3\r\n";
	  	$cabeceras .= "X-Mailer: PHP". phpversion() ."\r\n"; 
		$cabeceras .= 'MIME-Version: 1.0' . "\r\n";
		$cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        
        $mensaje = "Se ha solicitado reestablecer su contraseña desde CUPFSA COINS <br>";
        $mensaje .= "=================================================================== <br>";
        $mensaje .= "<br><br>";
        $mensaje .= "<p>Para generar una nueva contraseña haga clic en el siguiente enlace: </p>";
        $mensaje .= "<br>";
        $mensaje .= "<a href='https://coins.cupfsa.com/reestablecer-password.php?token=$token'>Reestablecer contraseña</a>";

		return mail( $e_mail, $asunto, $mensaje, $cabeceras );
	}
	/* --------------------------------------------------------- */
	function actualizarTokenUsuario( $dbh, $idu, $token ){
		// Actualiza la fecha de último inicio de sesión de un usuario
		$q = "update usuario set token_ingreso = '$token' where idUSUARIO = $idu";
		
		$data = mysqli_query( $dbh, $q );
		return mysqli_affected_rows( $dbh );
	}
	/* --------------------------------------------------------- */
	function obtenerNuevoTokenUsuario( $valor ){
		//Genera un código provisional enviado por email para confirmar y verificar cuenta
		$fecha 	= date_create();
		$date 	= date_timestamp_get( $fecha );
		return sha1( md5( $date.$valor ) );
	}
	/* --------------------------------------------------------- */
	function checkEmailLogin( $dbh, $email ){
		// Devuelve válido si email está registrado

		$rsp["valido"] = false;
		$rsp["reg"] = NULL;

		$q = "select * from usuario where email = '$email'";		
		$data 	= mysqli_query ( $dbh, $q );
		$data_u = mysqli_fetch_array( $data );
		$nrows 	= mysqli_num_rows( $data );

		if( $nrows > 0 ) {

			$rsp["valido"] 	= true;
			$rsp["reg"] 	= $data_u;
			if( $rsp["reg"]["token_ingreso"] == NULL ){
				// Si no existe un token de ingreso previo, se genera y asigna uno nuevo
				$rsp["reg"]["token_ingreso"] = obtenerNuevoTokenUsuario( $data_u["password"] );
				actualizarTokenUsuario( $dbh,  $rsp["reg"]["idUSUARIO"], $rsp["reg"]["token"] );
			}
		}

		return $rsp;
	}
	/* --------------------------------------------------------- */
	function iniciarSesion( $dbh, $usuario ){
		// Inicia sesión con los datos de usuario

		session_start();
		$idresult = 0; 
		if( isset( $usuario["token"] ) )
			$q = "select * from usuario where email = '$usuario[email]' and token_ingreso = '$usuario[token]'";
		else
			$q = "select * from usuario where email = '$usuario[email]' and password = '$usuario[password]'";
		
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
		if( isset( $_POST["token"] ) )
			$usuario["token"] 	= $_POST["token"];
		
		echo iniciarSesion( $dbh, $usuario );
	}
	/* --------------------------------------------------------- */
	// Recuperar contraseña (asinc)
	if( isset( $_POST["usr_passwrecover"] ) ){ 
		// Invocación desde: js/fn-acceso.js
		include( "bd.php" );

		$rsp = checkEmailLogin( $dbh, $_POST["email"] );
		if( $rsp["valido"] ){
			$envio = enviarPasswordEmail( $_POST["email"], $rsp["reg"]["token_ingreso"] );
			$res["exito"] = 1;
			$res["mje"] = "Se ha enviado un mensaje a su email con instrucciones para reestablecer su contraseña";
		} else {
			$res["exito"] = 0;
			$res["mje"] = "No existe cuenta asociada a este correo electrónico";
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	if( isset( $_POST["resetpwd"] ) ){ 
		// Invocación desde: js/fn-acceso.js
		include( "bd.php" );
		include( "data-usuarios.php" );

		parse_str( $_POST["resetpwd"], $usuario );
		
		$token 	= obtenerNuevoTokenUsuario( $usuario["password"] );
		actualizarTokenUsuario( $dbh, $usuario["idusuario"], $token );
		
		$rsp 	= actualizarPassWordUsuario( $dbh, $usuario );
		
		if( ( $rsp != 0 ) && ( $rsp != "" ) ){
			$res["exito"] = 1;
			$res["mje"] = "Contraseña reestablecida con éxito. "."<a href='index.php'>Iniciar Sesión</a>";
			$res["reg"] = $usuario;
		} else {
			$res["exito"] = 0;
			$res["mje"] = "Error al reestablecer contraseña";
			$res["reg"] = NULL;
		}
		
		echo json_encode( $res );
	}
	/* --------------------------------------------------------- */
	//Cierre de sesión
	if( isset( $_GET["logout"] ) ){
		
		unset( $_SESSION["login"] );
		unset( $_SESSION["user"] );
		echo "<script> window.location = 'index.php'</script>";		
	}
	/* --------------------------------------------------------- */
	if( !isset( $_POST["usr_passwrecover"] ) && !isset( $_POST["resetpwd"] ) )
		checkSession();
?>