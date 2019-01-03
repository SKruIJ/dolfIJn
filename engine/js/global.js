
/****************************************
dolfIJn
SKruIJ 2016-05-13
/engine/js/global.js
global js library // mandatory as required in /engine/libraries/head_creator.php
ü
*****************************************/

$(function() {
	$.datepicker.setDefaults( $.datepicker.regional[ "de" ] );
	$( ".inputdate" ).datepicker({
		changeMonth: true,
		changeYear: true
	});
});

