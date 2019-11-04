// Usuarios
/*
 * fn-usuarios.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */
(function() {

	'use strict';
	/* -------------------------------- */
	$("#frm_nusuario").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    email: {
		        remote: {
		        	url: "database/data-usuarios.php",
		        	method: 'POST'
				}
			},
			multiselect: {
				required: true
			}
		},
		onkeyup: false,
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
		submitHandler: function(form) {
		    agregarUsuario();
		}
	});
	/* -------------------------------- */
	$("#frm_musuario").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    email: {
		        remote: {
		        	url: "database/data-usuarios.php",
		        	method: 'POST',
		        	data: {
		        		id_u: function() {
			            	return $('#idua').val();
			         	}
			     	}
				}
			}
		},
		onkeyup: false,
		errorPlacement: function( error, element ) {
			var placement = element.closest('.input-group');
			if (!placement.get(0)) {
				placement = element;
			}
			if (error.text() !== '') {
				placement.after(error);
			}
		},
		submitHandler: function(form) {
		    editarUsuario();
		}
	});

}).apply( this, [ jQuery ]);
/* --------------------------------------------------------- */
function agregarUsuario(){
	// Invocación asíncrona para agregar nuevo usuario
	var fs = $('#frm_nusuario').serialize();
	var bot_reset = $("#btn_res_fnu");
	var espera = "<img src='assets/images/loading.gif' width='35'>";	

	$.ajax({
        type:"POST",
        url:"database/data-usuarios.php",
        data:{ form_nu: fs },
        beforeSend: function() {
        	$("#response").html( espera );
        	$("#btn_nvo_usuario").hide( 200 );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				$( bot_reset ).click();
				notificar( "Nuevo usuario", res.mje, "success" );
				setTimeout( 
					function() { 
						enviarRespuesta( res, "redireccion", "usuarios.php" )
					}, 
				4000 );
			}
			else
				notificar( "Nuevo usuario", res.mje, "error" );

			$("#response").html( "" );
			$("#btn_nvo_usuario").fadeIn( 200 );
        }
    });
}
/* --------------------------------------------------------- */
function editarUsuario(){
	// Invocación asíncrona para editar usuario
	var fs = $('#frm_musuario').serialize();
	var espera = "<img src='assets/images/loading.gif' width='35'>";	

	$.ajax({
        type:"POST",
        url:"database/data-usuarios.php",
        data:{ form_mu: fs },
        beforeSend: function() {
        	$("#response").html( espera );
        	$("#btn_mod_usuario").fadeOut( 200 );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				notificar( "Modificar usuario", res.mje, "success" );
			}
			else
				notificar( "Modificar usuario", res.mje, "error" );

			$("#response").html( "" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarUsuario(){
	// Invocación asíncrona para eliminar usuario 	
	var idu = $("#idusuario").val();
	var espera = "<img src='assets/images/loading.gif' width='35'>";

	$.ajax({
        type:"POST",
        url:"database/data-usuarios.php",
        data:{ elim_usuario: idu },
        beforeSend: function() {
        	$( "#eu" + idu ).html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
    			enviarRespuesta( res, "redireccion", "usuarios.php" );
			else
				notificar( "Usuarios", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
$(".listado_usuarios_gral").on( "click", ".eusuario", function (e) {
	//Inicializa la ventana modal para confirmar la eliminación de un usuario
	//alert( $(this).attr( "data-idu" ) );
	$("#idusuario").val( $(this).attr( "data-idu" ) );
    
    iniciarVentanaModal( "btn_elim_usuario", "btn_canc", 
                         "Eliminar usuario", 
                         "¿Confirma que desea eliminar este usuario", 
                         "Confirmar acción" );

    $("#btn_elim_usuario").on('click', function (e) {
		// Invoca la eliminación de un usuario
		eliminarUsuario();
	});
});