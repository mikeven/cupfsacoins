// Nominaciones
/*
 * fn-nominaciones.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */

(function() {

	'use strict';

	// Form nueva nominación
	$("#frm_nnominacion").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},
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

	// Form agregar sustentos
	$("#frm_asustento").validate({
		highlight: function( label ) {
			$(label).closest('.form-group').removeClass('has-success').addClass('has-error');
		},
		success: function( label ) {
			$(label).closest('.form-group').removeClass('has-error');
			label.remove();
		},/*
		submitHandler: function(form) {
			if( $(form).valid() ){
            	var icono = "<img src='assets/images/loading.gif'>";
				$("#panel_sustento2").html( icono );
			}
        },*/
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

}).apply( this, [ jQuery ]);

$('.modal-with-move-anim').magnificPopup({
	type: 'inline',

	fixedContentPos: false,
	fixedBgPos: true,

	overflowY: 'auto',

	closeBtnInside: true,
	preloader: false,
	
	midClick: true,
	removalDelay: 300,
	mainClass: 'my-mfp-slide-bottom',
	modal: true
});
/* --------------------------------------------------------- */
function votar(){
	// Invoca al servidor para registrar el voto del usuario
	var fs = $('#nvoto').serialize();

	$.ajax({
        type:"POST",
        url:"database/data-nominaciones.php",
        data:{ votar: fs  },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				notificar( "Votación", res.mje, "success" );
				$("#panel_resultado").fadeIn( 1000 );
				recargarPag( 3000 );
			}
			else
				notificar( "Votación", res.mje, "error" );
			$("#panel_voto").fadeOut(360);
			
        }
    });	
}
/* --------------------------------------------------------- */
function evaluar(){
	// Invoca al servidor para registrar la evaluación de una nominación
	// Aprobación - Rechazo - Solicitud de sustento
	var fs = $('#frm_admineval').serialize();
	var espera = "<img src='assets/images/loading.gif'>";

	$.ajax({
        type:"POST",
        url:"database/data-nominaciones.php",
        data:{ evaluar: fs  },
        beforeSend: function() {
        	$("#panel_aprobacion").html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				$(".panel_comentario").fadeOut( 1000 );
				$("#panel_aprobacion").slideUp( 1000 );
				notificar( "Nominación", res.mje, "success" );
				recargarPag( 3000 );
			}
			else
				notificar( "Nominación", res.mje, "error" );
        }
    });	
}
/* --------------------------------------------------------- */
$("#atributo").on('change', function (e) {
	// Asigna el valor del atributo de la lista al campo oculto
	var valor = $( 'option:selected', $(this) ).attr("data-v");
	$("#valattr").val( valor );
});

$(".sel_persona").on('click', function (e) {
	// Asigna el valor del id de la persona seleccionada al campo oculto, 
	// muestra el nombre de la persona seleccionada y cierra la ventana emergente
	var idp = $(this).attr("data-idp");
	$("#idpersona").val( idp );
	$("#persona_seleccion").val( $(this).html() );
	$("#btn_cerrar_usuarios").click();
	$("#persona_seleccion").focus();
});

/* --------------------------------------------------------- */ 
$('#frm_nnominacion').ajaxForm({ 
	// Invocación asíncrona del registro de una nominación nueva a través del formulario
	// parámetro de invocación: nva_nominacion

    type: 		"POST",
    url:        'database/data-nominaciones.php', 
    success:    function(response) { 
    	console.log(response);
    	res = jQuery.parseJSON( response );
    	if( res.exito == 1 ){
    		var idr = res.reg.id;
    		enviarRespuesta( res, "redireccion", "nominacion.php?id=" + idr );
    	}
    }
});
/* --------------------------------------------------------- */ 
$("#frm_nnominacion").on('submit', function(e) {
	// Evita el envío del formulario para revisar su validez
	var espera = "<img src='assets/images/loading.gif' width='35'>";

    if ( $("#frm_nnominacion").valid() ) {
        e.preventDefault();
        $("#response").html( espera );
    	$("#btn_nominar").fadeOut( 120 );
    }
});
/* --------------------------------------------------------- */ 
$(".sel_panel_nom").on('click', function (e) {
	// Cambio de vista tabla-fichas para mostrar las nominaciones 
	var orig = $(this).attr("data-i");
	var dest = $(this).attr("data-d");
	$(orig).fadeOut( 300 );
	$(dest).fadeIn( 300 );
});
/* --------------------------------------------------------- */ 
$(".cnf-voto").on('click', function (e) {
	// Asigna el valor del voto seleccionado y destaca la opción seleccionada
	$(".cnf-voto").removeClass( "game_now" );
	$(this).addClass( "game_now" );
	var valor = $(this).attr( "data-valor" );
	$("#valor_voto").val( valor );
	$("#confirmar_seleccion").fadeIn( 300 );

});
/* --------------------------------------------------------- */
$("#btn_votar").on('click', function (e) {
	votar();
});
/* --------------------------------------------------------- */
$('#frm_asustento').ajaxForm({ 
	// Invocación asíncrona para enviar segundo sustento sobre una nominación
	// dato de invocacion: "seg_sustento"
    type: 		"POST",
    url:        'database/data-nominaciones.php',
    beforeSubmit : function(){
    	$("#panel_sustento2").html( "<img src='assets/images/loading.gif'>" );
    },
    success:    function(response) { 
    	console.log(response);
    	res = jQuery.parseJSON( response );
    	if( res.exito == 1 ){
			$(".panel_sustento2").fadeOut( 1000 );
			notificar( "Nominación", res.mje, "success" );
		}
		else
			notificar( "Nominación", res.mje, "error" );
    }
});
/* --------------------------------------------------------- */ 
$("#frm_asustento_").on('submit', function(e) {
	// Evita el envío del formulario al ser validado
	var icono = "<img src='assets/images/loading.gif'>";
	$("#panel_sustento2").html( icono );
    if ( $("#frm_asustento").valid() ) {
        e.preventDefault();
    }
});
/* --------------------------------------------------------- */
function sustento2(){
	$("#frm_asustento").submit();
}
/* --------------------------------------------------------- */
function actualizarVisualAdjudicacion( origen ){
	// Actualiza los elementos visuales después de adjudicar una nominación

	if( origen == "full" ){
		/*$(".enc_nom").addClass( "bg-quartenary" );*/
		$(".adjudicacion").removeClass( "adjudicacion" );
		$(".accion-adj").html("<i class='fa fa-gift'></i> Adjudicada");
		$(".panel-heading-icon").html("<i class='fa fa-gift' style='color:#734ba9'></i>");
	}
	if( origen == "resumen" )
		$(".accion-adj").html("| <i class='fa fa-gift'></i> Adjudicada");
}
/* --------------------------------------------------------- */
function adjudicarNominacion( origen, idn ){
	// Invocación asíncrona para adjudicar una nominación
	
	var espera = "<img src='../assets/images/loading.gif' width='30'>";
	$.ajax({
        type:"POST",
        url:"database/data-nominaciones.php",
        data:{ adjudicar: idn  },
        beforeSend: function() {
        	$(".accion-adj").html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				actualizarVisualAdjudicacion( origen );
				notificar( "Nominación", res.mje, "success" );
			}
			else
				notificar( "Nominación", res.mje, "error" );
        }
    });
}
/* --------------------------------------------------------- */ 
$(".adminev, .adminev_s, .vp_ev").on('click', function (e) {
	// Muestra el panel de comentario de administrador, asigna valor de evaluación a campo oculto
	$(".panel_comentario").fadeIn(300);
	$("#estado_nom").val( $(this).attr( "data-a" ) );
	$(".adminev").prop( "disabled", false );
	$(this).prop( "disabled", true );
});
/* --------------------------------------------------------- */ 
$(".adjudicacion").on('click', function (e) {
	// Inicia la invocación para adjudicar una nominación
	var origen = $(this).attr( "data-o" );
	var idn = $(this).attr( "data-idn" );
	adjudicarNominacion( origen, idn );
});
/* --------------------------------------------------------- */
function tooltipSuiche( valor, suiche ){
	// Actualiza el texto tooltip del suiche después de ser usado
	console.log( $( suiche ).attr( "data-original-title" ) );
	if( valor == false )
		$( suiche ).attr( "data-original-title", "Activar para votación" ); 
	else
		$( suiche ).attr( "data-original-title", "Desactivar para votación" );
} 
/* --------------------------------------------------------- */
$(".chvotable").on('change', function (e) {
	// Inicia la invocación para blockear/desbloquear nominación
	var valor = $(this).is( ":checked" );
	var idnom = $(this).attr( "data-idn" );
	var suiche = $(this).closest( ".switch" );
	//var espera = "<img src='../assets/images/loading.gif' width='30'>";

	$.ajax({
        type:"POST",
        url:"database/data-nominaciones.php",
        data:{ bloquear: valor, idn: idnom },
        beforeSend: function() {
        	//$(".accion-adj").html( espera );
        },
        success: function( response ){
        	console.log( response );
			res = jQuery.parseJSON( response );
			if( res.exito == 1 ){
				notificar( "Nominación", res.mje, "success" );
				tooltipSuiche( valor, suiche );
			}
			else
				notificar( "Nominación", res.mje, "error" );
        }
    });
});
/* --------------------------------------------------------- */
function actualizarElementosVotacion( votos ){
	// Actualiza datos sobre la votación actual
	$("#rvotossi").html( votos.si );
	$("#rvotosno").html( votos.no );
	$("#rvotot").html( votos.votos );
	console.log(votos);
	if( votos.quorum == true ){
		$("#btn_sustento").hide();
		if( votos.si > votos.no ){
			$("#btn_aprobar").show();
			/*if( votos.estado == "rechazada" )
				$("#btn_rechazar").hide();
			else 
				$("#btn_rechazar").show();*/
		}
		else{
			$("#btn_rechazar").show();
			//$("#btn_aprobar").hide();
		}
	}
}
/* --------------------------------------------------------- */
function actualizarVisualVotacion( data , votos, animacion ){
	// Dibuja el gráfico con los datos actualizados
	
	if( animacion == true )
		$( "#flotPie" ).fadeOut(500);
	
	setTimeout( function(){ 
		iniciarGrafico( data );
		actualizarElementosVotacion( votos );
		$( "#flotPie" ).fadeIn(500);
	}, 500 );
	
}
/* --------------------------------------------------------- */
function iniciarGrafico( flotPieData ){
	// Inicializa los datos para generar el gráfico con datos y configuraciones

	var options = {
	    series: {
			pie: {
				show: true,
				combine: {
					color: '#999',
					threshold: 0.05
				}
			}
		},
		legend: {
			show: false
		},
		grid: {
			hoverable: true,
			clickable: true
		}
	};
	
	return $.plot('#flotPie', flotPieData, options );
}
/* --------------------------------------------------------- */
function dataGrafico( votos ){
	// Devuelve los datos de la votación formateados para el gráfico

	var flotPieData = [{
		label: "Sí",
		data: [ [1, votos.si ] ],
		color: '#47a447'
	}, {
		label: "No",
		data: [ [1, votos.no ] ],
		color: '#d64742'
	}];

	return flotPieData;
}
/* --------------------------------------------------------- */
function actualizarVotos( p ){
	// Invoca la solicitud para obtener los datos de votación de una nominación

	var idn = $('#idnominacion').val();

	$.ajax({
        type:"POST",
        url:"database/data-nominaciones.php",
        data:{ act_votos: idn  },
        success: function( response ){
        	console.log( response );
			votos = jQuery.parseJSON( response );
			flot_pie_data = dataGrafico( votos );
			actualizarVisualVotacion( flot_pie_data, votos, p );
        }
    });
}
/* --------------------------------------------------------- */