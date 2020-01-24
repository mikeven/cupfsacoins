<?php 
	/* ----------------------------------------------------------- */
	/* Cupfsa Coins - Datos iniciales sobre registro de nominación */
	/* ----------------------------------------------------------- */
	/* ----------------------------------------------------------- */
	
	/* ----------------------------------------------------------- */
	isAccesible( $pagina );
    $idn = NULL;
    $nominacion = NULL;
    $idu = $_SESSION["user"]["idUSUARIO"];
    $es_usrvp = esRol( $dbh, 4, $idu );					//Rol 4: Vicepresidente ( VP )
    $es_usadm = esRol( $dbh, 1, $idu );					//Rol 1: Administrador ( Admin )
    /* ----------------------------------------------------------- */
    if( isset( $_GET["id"] ) )
    	$idn = $_GET["id"];

    if( $idn != NULL ){
		$nominacion = obtenerNominacionPorId( $dbh, $idn );
		
		if( $nominacion )
			$mismo_dpto = esNominacionMismoDepartamento( $nominacion );
    }
    /* ----------------------------------------------------------- */
    if( $nominacion != NULL ) {
		$p_sw = posicionSuiche( $nominacion["votable"] );
		$comite = obtenerCantidadUsuariosRol( $dbh, 3 );
		$votada = false;
		if( isV( 'en_votar' ) ) { //Evaluador
			$votada = esVotada( $dbh, $idu, $idn );
		}

		$es_aprob_vp = esAprobadaPorVP( $dbh, $idu, $nominacion );
		$es_valid_vp = esValidadaPorVP( $dbh, $idu, $nominacion );
		$es_vp_nominado = esVPNominado( $dbh, $idu, $nominacion );
	}
	/* ----------------------------------------------------------- */
?>