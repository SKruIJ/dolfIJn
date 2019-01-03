<?php

/****************************************
dolfIJn
Module xdefault
SKruIJ 2018-11-22
modules/xdefault/dataviews/item.php
dataview item as example
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_ITEM_SUBHEADER));

// a function to generate an intro para
echo(dlf_intro(MOD_ITEM_INTRO));

// a function to generate a vertical space between the paras
echo(dlf_vspace());

if (!$dlf_error_flag) {
	
	$db_resultset = dlf_db_item_onetable("xdefault", $dlf_id);

	echo "<div class=\"panel panel-default\">";
	echo "<table class=\"table\">";
	echo "<tr><td>" . MOD_FIELD_LABEL_FAMILYNAME . "</td><td><strong>" . dlf_htmlout($db_resultset["xdefault_familyname"]) . "</strong></td></tr>";
	echo "<tr><td>" . MOD_FIELD_LABEL_FIRSTNAME . "</td><td><strong>" . dlf_htmlout($db_resultset["xdefault_firstname"]) . "</strong></td></tr>";
	echo "</table></div>";

} else {
	
	echo(dlf_intro(MOD_ITEM_ERROR));
	
}

echo(dlf_vspace());

$inputpara = array("icon"=>"retweet", "text"=>MOD_BUTTON_DEFAULT);
$buttonarray = array(array("home", 1), array("default", 4, $inputpara));
echo(dlf_buttonwell($buttonarray));



?>