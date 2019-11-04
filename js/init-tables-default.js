// Inicialización de tablas datatables
/*
 * init-tables-default.js
 *
 */

(function( $ ) {

	'use strict';

	var datatableInit = function() {

		$('#datatable-default').dataTable();

	};

	$(function() {
		datatableInit();
	});

}).apply( this, [ jQuery ]);