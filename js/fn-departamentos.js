// Departamentos
/*
 * fn-departamentos.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */

(function() {

	'use strict';

	// basic
	$("#frm_ndpto").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    nombre: {
		        required: true,     
		        remote: {
		        	url: "database/data-departamentos.php",
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
		}
	});

	$("#frm_mdpto").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
		rules: {
		    nombre: {
		        required: true,     
		        remote: {
		        	data: { iddpto: $('#iddpto').val() },
		        	url: "database/data-departamentos.php",
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
		submitHandler: function(form) {
		    editarDatosDepartamento();
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
$("#frm_ndpto").on('submit', function(e) {
	// Evita el envío del formulario al ser validado
    if ( $("#frm_ndpto").valid() ) {
        e.preventDefault();
        agregarDatosDepartamento();
    }
});
/* --------------------------------------------------------- */
function agregarDatosDepartamento(){
	// Invocación asíncrona para agregar departamento nuevo/

	var frm = $('#frm_ndpto').serialize();
	var espera = "<img src='assets/images/loading.gif' width='35'>";

	$.ajax({
        type:"POST",
        url:"database/data-departamentos.php",
        data:{ nvo_dpto: frm },
        beforeSend: function() {
        	$( "#response" ).html( espera );
        	$( "#btn_nvo_dpto" ).prop( "disabled", "true" );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
    			enviarRespuesta( res, "redireccion", "departamentos.php" );
			else
				notificar( "Departamentos", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
function editarDatosDepartamento(){
	// Invocación asíncrona para editar departamento
	var fs = $("#frm_mdpto").serialize();
	var espera = "<img src='assets/images/loading.gif' width='35'>";	

	$.ajax({
        type:"POST",
        url:"database/data-departamentos.php",
        data:{ form_mdpto: fs },
        beforeSend: function() {
        	$("#response").html( espera );
        	$("#btn_mod_departamento").fadeOut( 200 );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				notificar( "Modificar departamento", res.mje, "success" );
				setTimeout( 
					function() { 
						enviarRespuesta( res, "redireccion", "departamentos.php" )
					}, 3000 );
			}
			else
				notificar( "Modificar departamento", res.mje, "error" );

			$("#response").html( "" );
        }
    });
}
/* --------------------------------------------------------- */
function eliminarDepartamento(){
	// Invocación asíncrona para eliminar departamento 	
	var idd = $("#iddepartamento").val();
	var espera = "<img src='assets/images/loading.gif' width='35'>";

	$.ajax({
        type:"POST",
        url:"database/data-departamentos.php",
        data:{ elim_dpto: idd },
        beforeSend: function() {
        	$( "#ed" + idd ).html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 )
    			enviarRespuesta( res, "redireccion", "departamentos.php" );
			else
				notificar( "Departamentos", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */
$(".listado_departamentos_gral").on( "click", ".edpto", function (e) {
	//Inicializa la ventana modal para confirmar la eliminación de un departamento
	
	$("#iddepartamento").val( $(this).attr( "data-idd" ) );
    
    iniciarVentanaModal( "btn_elim_departamento", "btn_canc", 
                         "Eliminar departamento", 
                         "¿Confirma que desea eliminar este departamento", 
                         "Confirmar acción" );

    $("#btn_elim_departamento").on('click', function (e) {
		// Invoca la eliminación de un departamento
		eliminarDepartamento();
	});
});