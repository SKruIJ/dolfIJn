<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/engine/libraries/validation.php
core validation functions
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

/*****************************************
this file is not a real library with functions
it's a snippet which is integrated by require in the
dlf_form_field_validation function

it must follow the exact syntax
******************************************/


if (isset($myInputPara["isChecked"])) {
	if ($flag == 1) {
		$field_requirements .= " , ";
	}
	$flag = 1;
	$field_requirements .= " isChecked: true ";
}

if (isset($myInputPara["isRadioSelected"])) {
	if ($flag == 1) {
		$field_requirements .= " , ";
	}
	$flag = 1;
	$field_requirements .= " isRadioSelected: true ";
}

if (isset($myInputPara["isEmail"])) {
	if ($flag == 1) {
		$field_requirements .= " , ";
	}
	$flag = 1;
	$field_requirements .= " isEmail: true ";
}


?>
