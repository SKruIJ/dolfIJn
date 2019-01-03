<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-22
modules/xform/dataviews/send.php
dataview send as example
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// a function to generate a banner in case of a public form
echo(dlf_public_banner("public_banner_1024.png"));

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_SEND_SUBHEADER));

if (!$dlf_error_flag) {
	// a function to generate an intro para
	echo(dlf_intro(MOD_SEND_INTRO));

	// preparation of the output string
	$output = "<div>" . MOD_SEND_TEXT . "</div>"; 
	$output .= "<div><b>";
	// output string is shown if at least public rights		
	echo(dlf_nonsec_htmlout($output)); 
	echo(dlf_htmlout($dlf_form_values["email"]));
	$output = "</b></div>";		
	echo(dlf_nonsec_htmlout($output)); 
} else {
	echo(dlf_intro(MOD_SEND_ERROR));
}

// a function to generate a vertical space between the paras
echo(dlf_vspace());

$inputarray_home = array("access"=>"read");
$buttonarray = array(array("home", 1, $inputarray_home));
echo(dlf_buttonwell($buttonarray));

?>