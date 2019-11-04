
(function( $ ) {

	'use strict';

	/*
	Sparkline: Pie
	*/
	$(".sparklinePie").sparkline(sparklinePieData, {
		type: 'pie',
		height: '20',
		barColor: '#47a447',
		sliceColors: ['#47a447','#d64742']
	});

	

}).apply( this, [ jQuery ]);