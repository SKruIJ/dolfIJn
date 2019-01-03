<?php

/****************************************
dolfIJn
SKruIJ 2018-11-16
/actions/action.php
actions (create, update, delete)
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");


if ($login->isUserLoggedIn() == true) {
    // the user is logged in
	$dlf_access = dlf_CheckAccess(dlf_IDOfModule($dlf_modules));
	if ($dlf_access == "no") {
		echo DLF_ACCESS_DENIED;
		exit;
	}
} else {
	$dlf_access = "notlogged";
}

//POST values are taken over, new approach without mds file
foreach($_POST as $key => $value) {
	//the standard control values are not taken into account here, only the form values not starting with dlf  
	if(substr($key,0,3) != "dlf" && $key != "logged") {
		$dlf_form_values[$key] = $value;
	}

}

$_SESSION[APP_ID."_dlf_form_values"] = serialize($dlf_form_values);
						

//only in case of defined action (create, update, delete, 'special') the action is processed
if (isset($_SESSION[APP_ID."_dlf_action"])) {
	if ($_SESSION[APP_ID."_dlf_action"] != "") {
	
		if (substr($_SESSION[APP_ID."_dlf_action"],0,3) != "cre" && substr($_SESSION[APP_ID."_dlf_action"],0,3) != "upd" && substr($_SESSION[APP_ID."_dlf_action"],0,3) != "del") {
		// 'special' action, not create, update, delete / thsi action can be defined with any name but corresponding file must exist and must contain all action statements
			if (file_exists("modules/" . $dlf_modules . "/actions/" . $_SESSION[APP_ID."_dlf_action"] . ".php")) {
				require("modules/" . $dlf_modules . "/actions/" . $_SESSION[APP_ID."_dlf_action"] . ".php");
			} else {
				exit('MOD-ERROR 03-02');
			}
		
			$_SESSION[APP_ID."_dlf_message"] = serialize($dlf_message);
			$_SESSION[APP_ID."_dlf_error"] = serialize($dlf_error);

			$_SESSION[APP_ID."_dlf_action"] = "";
			session_write_close();
			header("Location: index.php");
			exit;

		} else {
		// normal create, update, delete actions
		 
		// action file must exists for the module
			switch ($dlf_modules) {
				case "home":
					break;
				case "modules":
					break;
				case "users":
					break;
				case "tenants":
					break;
				default:
					if (file_exists("modules/" . $dlf_modules . "/actions/action.php")) {
						require("modules/" . $dlf_modules . "/actions/action.php");
					} else {
						exit('MOD-ERROR 03-03');
					}
				
			}

			$dlf_action_message = "";
			$dlf_action_error = "";


			//default message and default error message defining depending on create, update or delete
			//or taking defined message/error from module
			if (isset($dlf_sql_message[$_SESSION[APP_ID."_dlf_action"]])) {
				$dlf_action_message = $dlf_sql_message[$_SESSION[APP_ID."_dlf_action"]];
			} else {
				switch (substr($_SESSION[APP_ID."_dlf_action"],0,3)) {
					case "cre":
						$dlf_action_message = DLF_MESSAGE_ACTION_CREATE;
						break;
					case "upd":
						$dlf_action_message = DLF_MESSAGE_ACTION_UPDATE;
						break;
					case "del":
						$dlf_action_message = DLF_MESSAGE_ACTION_DELETE;
						break;
				}
			}

			if (isset($dlf_sql_error[$_SESSION[APP_ID."_dlf_action"]])) {
				$dlf_action_error = $dlf_sql_error[$_SESSION[APP_ID."_dlf_action"]];
			} else {
				switch (substr($_SESSION[APP_ID."_dlf_action"],0,3)) {
					case "cre":
						$dlf_action_error = DLF_ERROR_ACTION_CREATE;
						break;
					case "upd":
						$dlf_action_error = DLF_ERROR_ACTION_UPDATE;
						break;
					case "del":
						$dlf_action_error = DLF_ERROR_ACTION_DELETE;
						break;
				}
			}

			// prerequisite actions called here / if return value is not "" than further actions stopped here / further actions only when return value = ""
			$dlf_prereq_return = mod_prereq($_SESSION[APP_ID."_dlf_action"]);
			if ($dlf_prereq_return != "") {
				array_push($dlf_error, $dlf_prereq_return);
				$_SESSION[APP_ID."_dlf_message"] = serialize($dlf_message);
				$_SESSION[APP_ID."_dlf_error"] = serialize($dlf_error);
				$_SESSION[APP_ID."_dlf_action"] = "";
				session_write_close();
				header("Location: index.php");
				exit;
			}	
			
			// required action (INSERT, UPDATE, DELETE)
			if ($login->databaseConnection()) {
			
			// to uncomment in case checking the SQL query for debugging
			//echo $dlf_sql_string[$_SESSION[APP_ID."_dlf_action"]];
			//exit;
			
				$stmt = $login->db_connection->prepare($dlf_sql_string[$_SESSION[APP_ID."_dlf_action"]]);
				foreach ($dlf_insert_list  as $parfield) {
					$stmt->bindParam(':' . $parfield["field"], $sqlparam[$parfield["field"]]);
					$sqlparam[$parfield["field"]] = $parfield["value"];
				}
				$dbreturn=$stmt->execute();
					
				if (!$dbreturn) {
					//failure
					array_push($dlf_error, $dlf_action_error);
					
				} else {
					// successful
					
					// in case create the id of the new dataset is taken
					if (substr($_SESSION[APP_ID."_dlf_action"],0,3) == "cre") {
						$dlf_last_id = $login->db_connection->lastInsertId();
					} else {
						$dlf_last_id = $dlf_id;
					}
								
					array_push($dlf_message, $dlf_action_message);
				
					// post actions called here
					$dlf_post_action_return = mod_post_action($_SESSION[APP_ID."_dlf_action"], $dlf_last_id);
					if ($dlf_post_action_return != "") {
						array_push($dlf_error, $dlf_post_action_return);
					}
				
				}
					
				
			} else {
				array_push($dlf_error, $dlf_action_error);
			}
			
			$_SESSION[APP_ID."_dlf_message"] = serialize($dlf_message);
			$_SESSION[APP_ID."_dlf_error"] = serialize($dlf_error);
			$_SESSION[APP_ID."_dlf_id"] = $dlf_last_id;

			$_SESSION[APP_ID."_dlf_action"] = "";
			session_write_close();
			header("Location: index.php");
			exit;

		}
	}
}

?>
