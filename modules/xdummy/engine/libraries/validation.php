<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-30
/modules/xform/libraries/validation.php
module validation functions / optional
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

/*****************************************
this file is not a real library with functions
it's a snippet which is integrated by require (optional) in the
dlf_form_field_validation function

it must follow the exact syntax
******************************************/


if (isset($myInputPara["isAlter"])) {
	if ($flag == 1) {
		$field_requirements .= " , ";
	}
	$flag = 1;
	$field_requirements .= " isAlter: true ";
}


?>
