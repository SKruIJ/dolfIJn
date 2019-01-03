<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-10-22
modules/xform/actions/action.php
module actions
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// prerequisite actions called here / if return value is not "" than further actions stopped here / further actions only when return value = ""
function mod_prereq($action) {
	
	$mod_prereq_status = "";

	return $mod_prereq_status;
}

function mod_post_action($myAction, $myLastId) {
	
	$mod_post_action_status = "";

	//dlf_SendEmail($myLastId, "sendconfirmation");
	$mod_post_action_status = dlf_SendEmail($myLastId, "sendconfirmation");
		
	return $mod_post_action_status;
}


// preparation of the insert list for the dlf_db_create function
$cre00_insert_list = array(
               array("field" => "kategorie", "value" => $dlf_form_values["kategorie"]),
			   array("field" => "anrede", "value" => $dlf_form_values["anrede"]),
			   array("field" => "name", "value" => $dlf_form_values["name"]),
			   array("field" => "vorname", "value" => $dlf_form_values["vorname"]),
			   array("field" => "strasse", "value" => $dlf_form_values["strasse"]),
			   array("field" => "hausnr", "value" => $dlf_form_values["hausnr"]),
			   array("field" => "plz", "value" => $dlf_form_values["plz"]),
			   array("field" => "ort", "value" => $dlf_form_values["ort"]),
			   array("field" => "email", "value" => $dlf_form_values["email"]),
			   array("field" => "alter", "value" => intval($dlf_form_values["alter"], 10)),
			   array("field" => "kommentar", "value" => $dlf_form_values["kommentar"]),
			   array("field" => "tac", "value" => intval($dlf_form_values["tac"], 10)),
			   array("field" => "newsletter1", "value" => intval($dlf_form_values["newsletter1"], 10)),
			   array("field" => "newsletter2", "value" => intval($dlf_form_values["newsletter2"], 10))
			   );
$cre00_table = "xform";
			   
// define here insert string for creation (cre00)
$dlf_sql_string["cre00"] = dlf_mds_create($cre00_table, $cre00_insert_list);

// dlf_insert_list must be defined for preparation execution string
$dlf_insert_list = $cre00_insert_list;

// define here the messaage for successful creation or the error message in case of failure
// otherwise standard message/error are taken
$dlf_sql_message["cre00"] = MOD_MESSAGE_CREATE; 
$dlf_sql_error["cre00"] = MOD_ERROR_CREATE;


?>
