<?php 
	/* --------------------------------------------------------- */
	/* Cupfsa Coins - Esquema de acciones y accesos */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */

	//Rol: ADMINISTRADOR - ACCIONES:
	$esq_secciones["agregar_usuario"] = array(
		array('id' => 'mp_titm_us', 'desc' => 'Menu ppal Usuarios'),
		array('id' => 'pg_usuarios', 'desc' => 'Página consulta de usuarios'),
		array('id' => 'pg_nvo_usuario', 'desc' => 'Página nuevo usuario')
	);

	$esq_secciones["modificar_usuario"] = array(
		array('id' => 'pg_mod_usuario', 'desc' => 'Página nuevo usuario')
	);

	$esq_secciones["eliminar_usuario"] = array(
		array('id' => 'en_elim_usuario', 'desc' => 'Enlace para eliminar usuario')
	);

	$esq_secciones["agregar_atributo"] = array(
		array('id' => 'mp_ver_atrib', 'desc' => 'Menu ppal Atributos'),
		array('id' => 'pg_nvo_atributo', 'desc' => 'Página nuevo atributo'),
		array('id' => 'pg_atributos', 'desc' => 'Menu ppal Atributos')
	);

	$esq_secciones["editar_atributo"] = array(
		array('id' => 'pg_atributos', 'desc' => 'Página de atributos'),
		array('id' => 'pg_edit_atributo', 'desc' => 'Menu ppal Atributos'),
		array('id' => 'en_edit_atrib', 'desc' => 'Enlace para editar atributo')
	);

	$esq_secciones["eliminar_atributo"] = array(
		array('id' => 'pg_atributos', 'desc' => 'Menu ppal Atributos'),
		array('id' => 'en_elim_atrib', 'desc' => 'Enlace para eliminar atributo')
	);

	$esq_secciones["agregar_producto"] = array(
		array('id' => 'mp_titm_pro', 'desc' => 'Menu ppal Productos'),
		array('id' => 'mp_ag_pro', 'desc' => 'Menu ppal Nuevo producto'),
		array('id' => 'pg_nvo_producto', 'desc' => 'Página nuevo producto') 	
	);

	$esq_secciones["consultar_producto"] = array(
		array('id' => 'mp_titm_pro', 'desc' => 'Menu ppal Productos'),
		array('id' => 'mp_ver_pro', 'desc' => 'Menu ppal Ver productos'),
		array('id' => 'pg_productos', 'desc' => 'Página consulta de productos'),
		array('id' => 'pg_producto', 'desc' => 'Página ficha producto')
	);

	$esq_secciones["modificar_producto"] = array(
		array('id' => 'en_edit_prod', 'desc' => 'Enlace para editar producto'),
		array('id' => 'pg_mod_producto', 'desc' => 'Página de edición de producto')
	);

	$esq_secciones["eliminar_producto"] = array(
		array('id' => 'en_elim_prod', 'desc' => 'Enlace para eliminar producto')
	);

	$esq_secciones["consultar_todos_canjes"] = array(
		array('id' => 'mp_ver_canj', 'desc' => 'Menu ppal Consultar canjes'),
		array('id' => 'pg_canjes', 'desc' => 'Página consulta de canjes')
	);

	$esq_secciones["ver_todas_nominaciones"] = array(
		array('id' => 'mp_ver_nom', 'desc' => 'Menu ppal Ver nominaciones'),
		array('id' => 'ver_tnominac', 'desc' => 'Menu ppal Ver nominaciones'),
		array('id' => 'pg_nominaciones', 'desc' => 'Página consulta nominaciones')
	);

	$esq_secciones["aprobar_nominacion"] = array(
		array('id' => 'pg_nominacion', 'desc' => 'Página ficha nominación'),
		array('id' => 'en_ver_nom', 'desc' => 'Enlace para ver nominación'),
		array('id' => 'en_aprob_nom', 'desc' => 'Enlace para aprobar nominación'),
		array('id' => 'result_nom', 'desc' => 'Resultados de nominaciones')
	);

	$esq_secciones["activar_nominacion"] = array(
		array('id' => 'pg_nominacion', 'desc' => 'Página ficha nominación'),
		array('id' => 'en_activ_nom', 'desc' => 'Enlace para activar/desactivar nominación')
	);
	
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */

	//Rol: COLABORADOR - ACCIONES:
	$esq_secciones["agregar_nominacion"] = array(
		array('id' => 'mp_nom_pers', 'desc' => 'Menu ppal Nueva nominación'),
		array('id' => 'pg_nvo_nominacion', 'desc' => 'Página nueva nominación')
	);

	$esq_secciones["ver_nominaciones_hechas"] = array(
		array('id' => 'mp_nom_pers', 'desc' => 'Menu ppal Ver nom. hechas/recibidas'),
		array('id' => 'pg_nominaciones', 'desc' => 'Página consulta nominaciones'),
		array('id' => 'en_ver_nom', 'desc' => 'Enlace para ver nominación'),
		array('id' => 'pan_nom_apoyo', 'desc' => 'Opciones para sustentar y adjudicar nominaciones'),
		array('id' => 'pg_nominacion', 'desc' => 'Página ficha nominación')
	);

	$esq_secciones["ver_nominaciones_recibidas"] = array(
		array('id' => 'mp_nom_pers', 'desc' => 'Menu ppal Ver nom. hechas/recibidas'),
		array('id' => 'pg_nominaciones', 'desc' => 'Página consulta nominaciones'),
		array('id' => 'pg_nominacion', 'desc' => 'Página ficha nominación')
	);

	$esq_secciones["canjear_producto"] = array(
		array('id' => 'en_canj_prod', 'desc' => 'Enlace para canjear producto')
	);

	$esq_secciones["consultar_canjes_propios"] = array(
		array('id' => 'mp_ver_miscanj', 'desc' => 'Menu ppal Ver mis canjes'),
		array('id' => 'pg_mis_canjes', 'desc' => 'Página consulta canjes de usuario')
	);

	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */
	/* --------------------------------------------------------- */

	//Rol: EVALUADOR - ACCIONES:
	$esq_secciones["votar_nominacion"] = array(
		array('id' => 'en_votar', 'desc' => 'Enlace para votar nominación'),
		array('id' => 'pg_nominacion', 'desc' => 'Página ficha nominación')
	);
?>