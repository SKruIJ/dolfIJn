<?php

/****************************************
dolfIJn
Module xdefault
SKruIJ 2018-11-23
modules/xdefault/dataviews/new.php
dataview new as example
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

//just basic module with a create action

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_NEW_SUBHEADER));

// a function to generate an intro para
echo(dlf_intro(MOD_NEW_INTRO));

// a function to generate a vertical space between the paras
echo(dlf_vspace());


$inputpara = array("label"=>MOD_FIELD_LABEL_FAMILYNAME, "placeholder"=>MOD_FIELD_PLACEHOLDER_FAMILYNAME, "maxlength"=>100 , "required"=>"1");
echo dlf_input_text("familyname", $inputpara);

$inputpara = array("label"=>MOD_FIELD_LABEL_FIRSTNAME, "placeholder"=>MOD_FIELD_PLACEHOLDER_FIRSTNAME, "maxlength"=>100);
echo dlf_input_text("firstname", $inputpara);


echo(dlf_vspace());
echo(dlf_vspace());

$inputarray_home = array("access"=>"read");
$inputarray_create = array("action"=>"cre01");
$buttonarray = array(array("home", 1, $inputarray_home),array("create", 4, "item", $inputarray_create));
echo(dlf_buttonwell($buttonarray));



?>

