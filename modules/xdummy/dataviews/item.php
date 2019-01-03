<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-11-29
modules/xdummy/dataviews/item.php
dataview screen for single item display
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

/*

echo "<div class=\"page-header\"><h1> " . MOD_PARTICIPANTS . " <small> " . MOD_PARTICIPANTS_SINGLE_ITEM . " </small></h1></div>";

$db_datensatz = dlf_db_select_simple_item("dummy", $dlf_id);

echo "<div class=\"btn-group\" role=\"group\" aria-label=\"" . DLF_BUTTON_BACK . " " . DLF_BUTTON_LIST . "\">";
echo  dlf_button_back('list') . dlf_button_list('list');
echo "</div>";
echo "<div class=\"spacer\">&nbsp;</div>";
echo "<div class=\"panel panel-default\">";
echo "<div class=\"panel-body\">";
echo "<p><strong>Name: </strong>" . $db_datensatz["dummy_name"] . "</p>";
echo "<p><strong>Email: </strong>" . $db_datensatz["dummy_email"] . "</p>";
if ($db_datensatz["dummy_active"] == 0) {
	echo "<p><span class=\"glyphicon glyphicon-ban-circle\"\"></span><strong> " . DLF_WORDING_ITEM_DEACTIVATED . "</strong></p>";		
}
echo "</div>";
echo "<div class=\"panel-footer\">";
echo "<div>" . dlf_button_edit('edit', $db_datensatz["dummy_id"]) . " " . dlf_button_delete('list', $db_datensatz["dummy_id"]) . "</div>";
echo "</div>";
echo "</div>";

echo "<div>" . dlf_button_new('new') . "</div>";



*/


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