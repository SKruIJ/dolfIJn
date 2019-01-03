<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-11-29
modules/xdummy/actions/action.php
module actions
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

/*

function mod_prereq($action) {
	global $login;
	global $dlf_fieldid;
	global $dlf_id;
		
	$mod_prereq_status = "";
	
	switch ($action) {
		
		default:
			
			break;
	}
	
	return $mod_prereq_status;
}

function mod_post_action($action, $lastid) {
	global $login;
	global $dlf_fieldid;
	global $dlf_id;
	
	$mod_post_action_status = "";

	switch ($action) {

		default:
			
			break;
	}
		return $mod_post_action_status;
}

$cre00_insert_list = array(
               array("field" => "name", "value" => $dlf_fieldid["name"], "type" => "text"),
               array("field" => "email", "value" => $dlf_fieldid["email"], "type" => "text"),
			  // array("field" => "active", "value" => $dlf_fieldid["active"], "type" => "number"),
			   array("field" => "tenants_id", "value" => $_SESSION[APP_ID.'user_tenants_id'], "type" => "text"));
               
$upd00_update_list = array(
               array("field" => "name", "value" => $dlf_fieldid["name"], "type" => "text"),
               array("field" => "email", "value" => $dlf_fieldid["email"], "type" => "text"),
			   array("field" => "active", "value" => $dlf_fieldid["active"], "type" => "number"));
               			
$dlf_sql_string["cre00"] = dlf_db_create("dummy",$cre00_insert_list);
//$dlf_sql_message["cre01"] = DISTRIBUTION_DEPARTMENTS_MESSAGE_ACTION_CREATE; 
//$dlf_sql_error["cre01"] = DISTRIBUTION_DEPARTMENTS_ERROR_ACTION_CREATE;

$dlf_sql_string["upd00"] = dlf_db_update("dummy",$upd00_update_list);
//$dlf_sql_message["upd01"] = DISTRIBUTION_DEPARTMENTS_MESSAGE_ACTION_UPDATE;
//$dlf_sql_error["upd01"] = DISTRIBUTION_DEPARTMENTS_ERROR_ACTION_UPDATE;

$dlf_sql_string["del00"] = dlf_db_delete("dummy");
//$dlf_sql_message["del01"] = DISTRIBUTION_DEPARTMENTS_MESSAGE_ACTION_DELETE;
//$dlf_sql_error["del01"] = DISTRIBUTION_DEPARTMENTS_ERROR_ACTION_DELETE;


*/



// prerequisite actions called here / if return value is not "" than further actions stopped here / further actions only when return value = ""
function mod_prereq($action) {
	
	$mod_prereq_status = "";

	return $mod_prereq_status;
}

function mod_post_action($myAction, $myLastId) {
	
	$mod_post_action_status = "";

	return $mod_post_action_status;
}


// preparation of the insert list for the dlf_db_create function
$cre01_insert_list = array(
               array("field" => "familyname", "value" => $dlf_form_values["familyname"]),
			   array("field" => "firstname", "value" => $dlf_form_values["firstname"])
			   );
$cre01_table = "xdefault";
			   
// define here insert string for creation (cre01)
$dlf_sql_string["cre01"] = dlf_mds_create($cre01_table, $cre01_insert_list);

// dlf_insert_list must be defined for preparation execution string
$dlf_insert_list = $cre01_insert_list;


?>
