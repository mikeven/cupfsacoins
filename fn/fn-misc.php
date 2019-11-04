<?php 
	/* Argyros - Funciones auxiliares */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	function sop( $val_list, $val_reg ){
		// Retorna el parámetro 'selected' para opciones de listas desplegables: marcar como seleccionada
		$sel = "";
		if( $val_list == $val_reg ) $sel = "selected";

		return $sel;
	}
	/* --------------------------------------------------------- */
	function arr_claves( $arreglo, $clave ){
		// Devuelve un arreglo con los valores de un campo de un registro contenido en un 
		// arreglo de varios registros
		$arr_claves = array();
		foreach ( $arreglo as $reg ) {
			$arr_claves[] = $reg[$clave];
		} 
		
		return $arr_claves;
	}
	/* --------------------------------------------------------- */
	function sop_a( $val_list, $valores_ref ){
		// Retorna 'selected' para opciones de listas desplegables múltiples
		// si un valor está incluido en un arreglo de varios valores 
		$sel = "";
		if( in_array( $val_list , $valores_ref ) ) $sel = "selected";

		return $sel; 
	}
	/* --------------------------------------------------------- */
	function sopl( $lval_reg, $clave ){
		//Retorna un arreglo con los valores correspondientes a las opciones seleccionadas de 
		//una lista desplegable múltiple
		$idarr = array();
		foreach ( $lval_reg as $l ){
			$idarr[] = $l[$clave];	
		}

		echo json_encode( $idarr );
	}
	/* --------------------------------------------------------- */
?>