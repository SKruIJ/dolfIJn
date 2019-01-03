<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-30
modules/xform/dataviews/form.php
dataview form as example
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

//just some example what a form could do

// a function to generate a banner in case of a public form
echo(dlf_public_banner("public_banner_1024.png"));

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_FORM_SUBHEADER));

// a function to generate an intro para
echo(dlf_intro(MOD_FORM_INTRO));


// a function to generate a vertical space between the paras
echo(dlf_vspace());


$inputpara = array("label"=>MOD_FIELD_LABEL_CATEGORY, "isRadioSelected"=>"1", "inline"=>"1", "error_msg"=>MOD_FIELD_ERR_CATEGORY);
$inputlist = array(array("value"=>MOD_FIELD_VALUE1_CATEGORY, "title"=>MOD_FIELD_VALUE1_CATEGORY), array("value"=>MOD_FIELD_VALUE2_CATEGORY, "title"=>MOD_FIELD_VALUE2_CATEGORY), array("value"=>MOD_FIELD_VALUE3_CATEGORY, "title"=>MOD_FIELD_VALUE3_CATEGORY));
echo dlf_input_radio("kategorie", $inputlist, $inputpara);
echo(dlf_vspace());


$inputpara = array("label"=>MOD_FIELD_LABEL_ADDRESS, "placeholder"=>MOD_FIELD_PLACEHOLDER_ADDRESS, "required"=>"1", "error_msg"=>MOD_FIELD_ERR_ADDRESS);
$inputlist = array(array("value"=>MOD_FIELD_VALUE1_ADDRESS, "title"=>MOD_FIELD_VALUE1_ADDRESS), array("value"=>MOD_FIELD_VALUE2_ADDRESS, "title"=>MOD_FIELD_VALUE2_ADDRESS));
echo dlf_input_select("anrede", $inputlist, $inputpara);
echo(dlf_vspace());

$inputpara = array("label"=>MOD_FIELD_LABEL_NAME, "placeholder"=>MOD_FIELD_PLACEHOLDER_NAME, "maxlength"=>100 , "required"=>"1", "error_msg"=>MOD_FIELD_ERR_NAME);
echo dlf_input_text("name", $inputpara);

$inputpara = array("label"=>MOD_FIELD_LABEL_FIRSTNAME, "placeholder"=>MOD_FIELD_PLACEHOLDER_FIRSTNAME, "maxlength"=>100);
echo dlf_input_text("vorname", $inputpara);

echo "<div class=\"row\">";
echo "<div class=\"col-sm-10\">";

$inputpara = array("label"=>MOD_FIELD_LABEL_STREET, "placeholder"=>MOD_FIELD_PLACEHOLDER_STREET, "maxlength"=>100);
echo dlf_input_text("strasse", $inputpara);

echo "</div>";
echo "<div class=\"col-sm-2\">";

$inputpara = array("label"=>MOD_FIELD_LABEL_STREETNUMBER, "placeholder"=>MOD_FIELD_PLACEHOLDER_STREETNUMBER, "maxlength"=>10);
echo dlf_input_text("hausnr", $inputpara);

echo "</div>";
echo "</div>";

echo "<div class=\"row\">";
echo "<div class=\"col-sm-3\">";

$inputpara = array("label"=>MOD_FIELD_LABEL_POSTCODE, "placeholder"=>MOD_FIELD_PLACEHOLDER_POSTCODE, "maxlength"=>10);
echo dlf_input_text("plz", $inputpara);

echo "</div>";
echo "<div class=\"col-sm-9\">";

$inputpara = array("label"=>MOD_FIELD_LABEL_CITY, "placeholder"=>MOD_FIELD_PLACEHOLDER_CITY, "maxlength"=>100);
echo dlf_input_text("ort", $inputpara);

echo "</div>";
echo "</div>";

$inputpara = array("label"=>MOD_FIELD_LABEL_EMAIL, "placeholder"=>MOD_FIELD_PLACEHOLDER_EMAIL, "maxlength"=>100 , "required"=>"1", "isEmail"=>"1");
echo dlf_input_text("email", $inputpara);

$inputpara = array("label"=>MOD_FIELD_LABEL_ALTER, "placeholder"=>MOD_FIELD_PLACEHOLDER_ALTER, "maxlength"=>3, "isAlter"=>"1");
echo dlf_input_text("alter", $inputpara);

$inputpara = array("label"=>MOD_FIELD_LABEL_KOMMENTAR, "placeholder"=>MOD_FIELD_PLACEHOLDER_KOMMENTAR, "maxlength"=>1000, "rows"=>20, "required"=>"1", "error_msg"=>MOD_FIELD_ERR_KOMMENTAR);
echo dlf_input_textarea("kommentar", $inputpara);

$inputpara = array("label"=>MOD_FIELD_LABEL_TAC, "title"=>MOD_FIELD_TITLE_TAC, "isChecked"=>"1", "error_msg"=>MOD_FIELD_ERR_TAC);
echo dlf_input_check_single("tac", $inputpara);

echo "<div class=\"row\">";
echo "<div class=\"col-sm-6\">";

// additional mandatory parameter required as isCheckedNews is not creating asterix
//$inputpara = array("label"=>MOD_FIELD_LABEL_NEWSLETTER1, "isCheckedNews1"=>"1", "mandatory"=>"1");
$inputpara = array("label"=>MOD_FIELD_LABEL_NEWSLETTER1);
echo dlf_input_check_single("newsletter1", $inputpara);

echo "</div>";
echo "<div class=\"col-sm-6\">";

$inputpara = array("label"=>MOD_FIELD_LABEL_NEWSLETTER2, "isChecked"=>"1");
//$inputpara = array("label"=>MOD_FIELD_LABEL_NEWSLETTER2);
echo dlf_input_check_single("newsletter2", $inputpara);

echo "</div>";
echo "</div>";

echo(dlf_vspace());
echo(dlf_vspace());

$inputarray_home = array("access"=>"read");
$buttonarray = array(array("home", 1, $inputarray_home),array("next", 4, "confirm"));
echo(dlf_buttonwell($buttonarray));



?>

