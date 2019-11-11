<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Funciones sobre sesión de usuario y accesos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	
	/* --------------------------------------------------------- */
	function hrolesUsuario( $data_roles ){
		//
		$roles = "";
		
		foreach ( $data_roles as $r ) {
			$roles .= $r["nombre"]." ";
		}

		return $roles;
	}
	/* --------------------------------------------------------- */
	function obtenerEsquemaAccesosUsuario(){
	
		$usuario = $_SESSION["user"];

		return $usuario;
	}
	/* --------------------------------------------------------- */
	function obtenerListaAccesoSecciones( $data_accesos ){
		//Devuelve la lista de secciones accesibles por los permisos del usuario
		$lista = array();
		foreach ( $data_accesos as $a ) {
			$lista[] = $a["codigo"];
		}
		return $lista;
	}
	/* --------------------------------------------------------- */
	function isV( $seccion ){
		//Determina si una sección del sistema es visible para el usuario
		//if( isSU() ) return true;
		
		$visible = false;
		$permisos = $_SESSION["user"]["accesos"];
		if ( in_array( $seccion, $permisos ) ){
			$visible = true;
		}
		return $visible;
	}
	/* --------------------------------------------------------- */
	function isAccesible( $pagina ){
		//Determina si una página del sistema es accesible para el usuario
		if( !isV( $pagina ) ) header('Location: inicio.php');
	}
	/* --------------------------------------------------------- */
	function mostrarResultadosNominacion( $es_aprob_vp, $votada ){
		$mostrar = false;
		if( isV( "result_nom" ) && ( !$es_aprob_vp ) || ( isV( "en_votar" ) && $votada ) )
			$mostrar = true;

		return $mostrar;
	}
	/* --------------------------------------------------------- */

	$accesos_usess = obtenerEsquemaAccesosUsuario();
?>