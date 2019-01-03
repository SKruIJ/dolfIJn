<?php

/****************************************
dolfIJn
SKruIJ 2018-03-26
/engine/libraries/output.php
html output functions
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// CHECKED / MANUAL
// SKruIJ_20171124: new function
// function for secured html output of result set as list, taking into account the access rights
function dlf_listout($myResultSet, $myFieldsList, $myHeaders, $myAccessLevel = "public") {
// $myResultSet > full result set from database select
// $myFieldsList > array of fields which should be displayed
// $myHeaders > array of headers, must correspond in the order with the fields list / if empty table is displayed without headers
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default

	global $dlf_access;
	
	
	$myTextReturn = "";
	
	$myTextTemp = "";
	$myTextTemp .= "<div class=\"panel panel-default\">";
	$myTextTemp .= "<table class=\"table\">";
	
	if(isset($myHeaders)) {
		
		$myTextTemp .= "<tr>";
		foreach($myHeaders as $header) {
			$myTextTemp .= "<th>" . $header . "</th>";
		}
		$myTextTemp .= "</tr>";
	}
	
	foreach($myResultSet as $dataset) {
		
		$myTextTemp .= "<tr>";
		foreach($myFieldsList as $field) {
			$fieldcontent = "";
			$fieldcontent = $dataset[$field];
			$fieldcontent = trim($fieldcontent);
			$fieldcontent = stripslashes($fieldcontent);
			$fieldcontent = htmlspecialchars($fieldcontent, ENT_QUOTES);
			
			$myTextTemp .= "<td>" . $fieldcontent . "</td>";
		
		}
		$myTextTemp .= "</tr>";
		
	}

	$myTextTemp .= "</table>";
	$myTextTemp .= "</div>";

	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;

}


// CHECKED / MANUAL
// SKruIJ_20171101: new function
// function for secured html output, especially from db, taking into account the access rights
function dlf_htmlout($myText, $myAccessLevel = "public") {
// $myText > output text
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"

	global $dlf_access;
	
	$myTextTemp = $myText;
	
	$myTextTemp= trim($myTextTemp);
	$myTextTemp = stripslashes($myTextTemp);
	$myTextTemp = htmlspecialchars($myTextTemp, ENT_QUOTES);
	// SKruIJ_20180326: nl2br introduced
	$myTextTemp = nl2br($myTextTemp);
	

	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;
	
}


// CHECKED / MANUAL
// SKruIJ_20171101: new function
// function for (non-secured) html output, taking into account the access rights
function dlf_nonsec_htmlout($myText, $myAccessLevel = "public") {
// $myText > output text
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"

	global $dlf_access;
	
	$myTextTemp = $myText;
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;
	
}


// CHECKED / MANUAL
// function to return a vertical space in the page layout
function dlf_vspace($myAccessLevel = "public") {
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"
	
	global $dlf_access;
	
	$myTextTemp = "<div class=\"spacer\">&nbsp;</div>";
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;

}


// CHECKED / MANUAL
// function to return a title in the page layout
function dlf_title($myHeader, $mySubHeader, $myAccessLevel = "public") {
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"
	
	global $dlf_access;
	
	$myTextTemp = "<div class=\"page-header\"><h1> " . $myHeader . " <small> " . $mySubHeader . " </small></h1></div>";
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;
	
}


// CHECKED / MANUAL
// function to return an intro para in the page layout
function dlf_intro($myIntro, $myAccessLevel = "public") {
// $myIntro > the intro para to be displayed
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"
	
	global $dlf_access;
	
	$myTextTemp = "<div> " . $myIntro . " </div>";
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
	
	return $myTextReturn;
	
}


// CHECKED / MANUAL
// function to return a banner for a public form
function dlf_public_banner($myGraphics) {
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin" / default = "public"
	
	global $dlf_access;
	global $dlf_modules;
	
	$myTextTemp = "<div class=\"banner\"><img class=\"img-responsive\" src=\"modules/" . $dlf_modules . "/screens/graphics/" . $myGraphics . "\"></div>";
	
	if ($dlf_access == "public") { 
		$myTextReturn = $myTextTemp;
	} else {
		$myTextReturn = "";
	}
	
	return $myTextReturn;
	
}


?>