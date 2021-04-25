// Acceso
/*
 * fn-acceso.js
 *
 */
/* --------------------------------------------------------- */	
/* --------------------------------------------------------- */

(function() {
	
	'use strict';

    jQuery.fn.exists = function(){ return ($(this).length > 0); }

    if ( $("#recover_password").exists() ) {

        $("#recover_password").validate({
            highlight: function( label ) {
                $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function( label ) {
                $(label).closest('.form-group').removeClass('has-error');
                label.remove();
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
            rules : {
                email : {
                    required: true,
                    email: true
                }
            },
            submitHandler: function(form) {
                recuperarPassword();
            }
        });
    }
    
    /* ........................................................................ */
    
    if ( $('#frm_reset_password').exists() ) {
        
        $.validator.addMethod( "regex", function(value, element, regexpr) {          
            return regexpr.test( value );
        }, "La contraseña debe cumplir el formato requerido" ); 

        $("#frm_reset_password").validate({
            highlight: function( label ) {
                $(label).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            success: function( label ) {
                $(label).closest('.form-group').removeClass('has-error');
                label.remove();
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
            rules : {
                password: {
                    required: true,
                    minlength: 8,
                    regex: /^.*(?=.{8,})(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%&*]).*$/ 
                    /* Exp reg.: mínimo 8 caract, al menos una MAYUSC, al menos una MINUSC, 
                    al menos un caract numérico, al menos 1 caract especial  */
                },
                password_conf : {
                    equalTo : "#password1"
                }
            },
            submitHandler: function(form) {
                reestablecerPassword();
            }
        });
    }

	/* Inits */
	/* --------------------------------------------------------- */

	$("[data-hide]").on("click", function(){
        $(this).closest("." + $(this).attr("data-hide")).fadeOut(200);
    });

	$("#logout").on("click", function(){
        log_out();
    });

	/* --------------------------------------------------------- */

}).apply( this, [ jQuery ]);

/* --------------------------------------------------------- */

function recuperarPassword(){
    //Invoca al servidor para iniciar la recuperación de contraseña (envío de instrucciones al email)
    var form = $('#recover_password');
    $.ajax({
        type:"POST",
        url:"database/data-acceso.php",
        data:form.serialize(), //data invocación: usr_passwrecover (index.php)
        beforeSend: function() {
            $(".alert").removeClass("alert-danger");
            $(".alert").removeClass("alert-success");
            $(".alert").hide();
            $("#btn_emailpwd").prop( "disabled", true );
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            alertaMensaje( res.exito, res.mje );
        }
    });
}
/* --------------------------------------------------------- */
function reestablecerPassword(){
    //Invoca al servidor para reestablecer contraseña (asignación de nueva contraseña)
    var form = $('#frm_reset_password');
    $.ajax({
        type:"POST",
        url:"database/data-acceso.php",
        data:{ resetpwd: form.serialize() }, //data invocación: token_reset_pass (reestablecer-password.php)
        beforeSend: function() {
            $(".alert").removeClass("alert-danger");
            $(".alert").removeClass("alert-success");
            $(".alert").hide();
        },
        success: function( response ){
            console.log( response );
            res = jQuery.parseJSON( response );
            alertaMensaje( res.exito, res.mje );
        }
    });
}
/* --------------------------------------------------------- */
function log_in(){
	
	var form = $('#loginform');
	$.ajax({
        type:"POST",
        url:"database/data-acceso.php",
        data:form.serialize(),
        success: function( response ){
        	console.log( response );
			if( response == 1 ){
				window.location = "inicio.php";
			}
			else {
				alert("Usuario o contraseña incorrecta");
			}
        }
    });
}
/* --------------------------------------------------------- */