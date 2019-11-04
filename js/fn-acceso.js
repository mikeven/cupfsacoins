// Acceso
/*
 * fn-acceso.js
 *
 */
/* --------------------------------------------------------- */	
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
				alert("ERROR");
			}
        }
    });
}
/* --------------------------------------------------------- */