<?php

/****************************************
dolfIJn
SKruIJ 2017-07-09
/screens/default/elements/breadcrumb.php
screen building the breadcrumb area in a default page
****************************************/

// ü check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$breadcrumbelement = "<div class=\"breadcrumb\">";

if (file_exists("app/screens/default/elements/breadcrumb.php")) {
	// taking breadcrumb configuration of the app
	require("app/screens/default/elements/breadcrumb.php");
} else {
	// taking the dolfIJn standard breadcrumb
	$breadcrumbelement .= "<a class=\"breadcrumb_link\" href=\"#\" onclick=\"dlf_control('home','default',0,'')\">" . DLF_WORDING_HOME . "</a>";
	switch ($dlf_dataview) {
		case "list":
			break;
		case "item":
			$breadcrumbelement .= " &gt; <a class=\"breadcrumb_link\" href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default',0,'')\">" . MODULE_BREADCRUMP_OVERVIEWLIST . "</a>";
			break;
		case "edit":
			$breadcrumbelement .= " &gt; <a class=\"breadcrumb_link\" href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default',0,'')\">" . MODULE_BREADCRUMP_OVERVIEWLIST . "</a>";
			break;
		case "new":
			$breadcrumbelement .= " &gt; <a class=\"breadcrumb_link\" href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default',0,'')\">" . MODULE_BREADCRUMP_OVERVIEWLIST . "</a>";
			break;
		default:
		
	}

}

$breadcrumbelement .= "</div>";

		
if (APP_BREADCRUMB_DISPLAY_FLAG == 1) {
	if ($_SESSION[APP_ID.'_user_name'] != "public") {
		echo $breadcrumbelement;
	} else {
		if (APP_BREADCRUMB_PUBLIC_DISPLAY_FLAG == 1) {
			echo $breadcrumbelement;
		}
	}
}

?>