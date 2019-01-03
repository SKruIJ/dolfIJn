<?php

/****************************************
dolfIJn
Module xdefault
SKruIJ 2018-11-16
modules/xdefault/actions/action.php
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
