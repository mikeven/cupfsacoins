// Atributos
/*
 * fn-atributos.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */

(function() {

	'use strict';

	// basic
	$("#frm_natributo").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    valor: { digits: true },
		    prioridad: { digits: true },
		    nombre: {
		        required: true,     
		        remote: {
		        	url: "database/data-atributos.php",
		        	method: 'POST'       	
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
		submitHandler: function (form) {
            // form is valid - do stuff, ajax?
            agregarAtributo();
            return false; // block the default form action if using ajax
        }
	});

	$("#frm_matributo").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    valor: { digits: true, required: true },
		    prioridad: { digits: true },
		    nombre: {
		        required: true,     
		        remote: {
		        	data: { idatributo_edit: $('#idatributo').val() },
		        	url: "database/data-atributos.php",
		        	method: 'POST'       	
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
		submitHandler: function (form) {
            // form is valid - do stuff, ajax?
            editarAtributo();
            return false; // block the default form action if using ajax
        }
	});

	// validation summary
	var $summaryForm = $("#summary-form");
	$summaryForm.validate({
		errorContainer: $summaryForm.find( 'div.validation-message' ),
		errorLabelContainer: $summaryForm.find( 'div.validation-message ul' ),
		wrapper: "li"
	});


}).apply( this, [ jQuery ]);
/* --------------------------------------------------------- */
/*$("#frm_natributo").on('submit', function(e) {
	// Evita el envío del formulario al ser validado
    if ( $("#frm_natributo").valid() ) {
        e.preventDefault();
        agregarAtributo();
    }
});

$("#frm_matributo").on('submit', function(e) {
	// Evita el envío del formulario al ser validado
    if ( $("#frm_matributo").valid() ) {
        e.preventDefault();
        editarAtributo();
    }
});*/

$("#btn_nvo_atributo").on('click', function (e) {
	// Invoca el envío del formulario de nuevo producto
	$("#frm_natributo").submit();
	
});

$("#btn_mod_atributo").on('click', function (e) {
	// Invoca el envío del formulario de nuevo producto
	$("#frm_matributo").submit();
	
});
/* --------------------------------------------------------- */
function agregarAtributo(){
	// Invocación asíncrona para agregar atributo nuevo/

	var frm = $('#frm_natributo').serialize();
	var espera = "<img src='assets/images/loading.gif' width='35'>";

	$.ajax({
        type:"POST",
        url:"database/data-atributos.php",
        data:{ nvo_atributo: frm },
        beforeSend: function() {
        	$( "#response" ).html( espera );
        	$( "#btn_nvo_atributo" ).fadeOut( 200 );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
    			enviarRespuesta( res, "redireccion", "atributos.php" );
			else
				notificar( "Atributos", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarAtributo(){
	// Invocación asíncrona para modificar atributo
	var fs = $('#frm_matributo').serialize();
	var espera = "<img src='assets/images/loading.gif' width='35'>";
	
	$.ajax({
        type:"POST",
        url:"database/data-atributos.php",
        data:{ form_matrib: fs  },
        beforeSend: function() {
        	console.log("EJECUCION");
        	$("#response").html( espera );
        	$("#btn_mod_atributo").fadeOut( 200 );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				$("#response").fadeOut();
				notificar( "Atributo", res.mje, "success" );
				setTimeout( 
					function() { 
						enviarRespuesta( res, "redireccion", "atributos.php" ) 
					}, 3000 );
			}
			else
				notificar( "Atributo", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarAtributo(){
	// Invocación asíncrona para eliminar atributo 	
	var ida 			= $("#idatributo").val();
	var espera 			= "<img src='assets/images/loading.gif' width='35'>";

	$.ajax({
        type:"POST",
        url:"database/data-atributos.php",
        data:{ elim_atributo: ida },
        beforeSend: function() {
        	$( "#ea" + ida ).html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
    			enviarRespuesta( res, "redireccion", "atributos.php" );
			else
				notificar( "Atributos", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
$(".listado_atributos_gral").on( "click", ".eatributo", function (e) {
	//Inicializa la ventana modal para confirmar la eliminación de un atributo
	
	$("#idatributo").val( $(this).attr( "data-ida" ) );
    
    iniciarVentanaModal( "btn_elim_atributo", "btn_canc", 
                         "Eliminar atributo", 
                         "¿Confirma que desea eliminar este atributo", 
                         "Confirmar acción" );

    $("#btn_elim_atributo").on('click', function (e) {
		// Invoca la eliminación de un atributo
		eliminarAtributo();
	});
});