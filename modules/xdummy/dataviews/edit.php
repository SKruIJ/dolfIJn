<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-11-29
modules/xdummy/dataviews/edit.php
dataview screen for editing a single item
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

/*

echo "<div class=\"page-header\"><h1> " . MOD_PARTICIPANTS . " <small> " . MOD_PARTICIPANTS_EDIT_SINGLE_ITEM . " </small></h1></div>";

$db_datensatz = dlf_db_select_simple_item("dummy", $dlf_id);

$inputpara = array("label"=>MOD_LAB_NAME, "value"=>$db_datensatz["dummy_name"] , "placeholder"=>MOD_LAB_NAME, "maxlength"=>100 , "required"=>"1");
dlf_input_text("name", $inputpara);
		
$inputpara = array("label"=>MOD_LAB_EMAIL, "value"=>$db_datensatz["dummy_email"] ,"placeholder"=>MOD_LAB_EMAIL, "maxlength"=>100);
dlf_input_text("email", $inputpara);

$inputpara = array("label"=>MOD_LAB_ACTIVE, "checked"=>$db_datensatz["dummy_active"]);
dlf_input_check_single("active", $inputpara);

echo "<div>" . dlf_button_update('item', $dlf_id) . " " . dlf_button_cancel('item', $dlf_id) . "</div>";


*/


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

