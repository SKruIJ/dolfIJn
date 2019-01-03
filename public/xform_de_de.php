<?php

/****************************************
dolfIJn
Module xform_de_de
SKruIJ 2018-05-17
/public/xform.php
public access to xform with de-de as user setting
ü
****************************************/

// set #key for secured identification of other php scripts (to avoid a stand alone request of php scripts)
define("DLF_SECURE_KEY", "dolfIJn2015");

// configuration files required
require("../engine/config/config.php");
require("../app/engine/config/config.php");
require("../engine/libraries/main.php");

session_start();

// 20180517_SKruIJ: session_unset and session_destroy replaced by dlf_session_unset 
dlf_session_unset();

session_start();

$_SESSION[APP_ID . '_user_id'] = 0;
$_SESSION[APP_ID . '_user_name'] = "public";
$_SESSION[APP_ID . '_user_tenants_id'] = 0;
$_SESSION[APP_ID . '_user_admin'] = 0;
$_SESSION[APP_ID . '_user_email'] = "";
$_SESSION[APP_ID . '_user_logged_in'] = 1;
$_SESSION[APP_ID.'_user_language'] = "de-de";
if(null !== APP_START_LANGUAGE) {
	$_SESSION[APP_ID."_dlf_language"] = APP_START_LANGUAGE;
} else {
	$_SESSION[APP_ID."_dlf_language"] = DLF_DEFAULT_LANGUAGE;
}
$_SESSION[APP_ID . '_dlf_modules'] = "xform";
$_SESSION[APP_ID . '_dlf_dataview'] = "form";
$_SESSION[APP_ID."_dlf_action"] = "";
$_SESSION[APP_ID."_dlf_id"] = 0;
// $_SESSION[APP_ID."_dlf_message"] = array();
// $_SESSION[APP_ID."_dlf_error"] = array();

// example for pre-filling of form fields
// post values if any
if(isset($_GET["name"])) {
	$dlf_form_values[name] = $_GET["name"];
} else {
	$dlf_form_values[name] = "Testname";
}
$_SESSION[APP_ID."_dlf_form_values"] = serialize($dlf_form_values);


session_write_close();
header("Location: ../index.php");
exit;
?>
