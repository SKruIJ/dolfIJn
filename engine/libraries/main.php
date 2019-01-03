<?php

/****************************************
dolfIJn
SKruIJ 2018-05-18
/engine/libraries/main.php
main functions
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");


// 20170518_SKruIJ: integration of SMTP mail / depending on DLF_EMAIL_USE_SMTP the mail is send by SMTP or just as mail via the webserver
// function to send out an email 
function dlf_SendEmail($myID, $myEmailTemplate, $myInputPara = array()) {
// $myID > id of a data set
// $myInputPara > array expected as input for the email template, can be used to transfer several parameters to the email template
// $myEmailTemplate > string defining the path to the email template (from index.php) which should be used for sending the email, e.g. "modules/MODULENAME/emails/mailtemplate.php"
	
	global $dlf_modules;

	$sendemail_status = "";
	$devoutput = "<!DOCTYPE html><html><head><meta charset=\"utf-8\"><meta http-equiv=\"content-type\" content=\"txt/html; charset=utf-8\"></head><body>";
	
	
	// include the email template 
	if (file_exists("modules/" . $dlf_modules . "/emails/" . $myEmailTemplate . ".php")) {
		require("modules/" . $dlf_modules . "/emails/" . $myEmailTemplate . ".php");
	} else {
		exit('DLF-ERROR 05-01');
	}
	
	$mail = new PHPMailer();
	
	$mail -> CharSet = "UTF-8";
	
	if (DLF_EMAIL_USE_SMTP) {
		// Set mailer to use SMTP
        $mail->IsSMTP();
        
		//useful for debugging, shows full SMTP errors
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        // Enable SMTP authentication
        $mail->SMTPAuth = DLF_EMAIL_SMTP_AUTH;
        // Enable encryption, usually SSL/TLS
        if (defined(DLF_EMAIL_SMTP_ENCRYPTION)) {
			$mail->SMTPSecure = DLF_EMAIL_SMTP_ENCRYPTION;
        }
        // Specify host server
        $mail->Host = DLF_EMAIL_SMTP_HOST;
        $mail->Username = DLF_EMAIL_SMTP_USERNAME;
        $mail->Password = DLF_EMAIL_SMTP_PASSWORD;
        $mail->Port = DLF_EMAIL_SMTP_PORT;
    } else {
        $mail->IsSendmail();
    }

	if ($email_from) {
		$mail->From = $email_from;
	} else {
		$mail->From = DLF_EMAIL_FROM;
	}
	$devoutput .= "From: " . $mail->From . "<br>";
	
	
	if ($email_fromname) {
		$mail->FromName = $email_fromname;
		$devoutput .= "FromName: " . $email_fromname . "<br>";
	
	} else {
		$mail->FromName = DLF_EMAIL_FROMNAME;
		$devoutput .= "FromName: " . DLF_EMAIL_FROMNAME . "<br>";
	
	}

	$mail->AddAddress($email_address);
	$devoutput .= "To: " . $email_address . "<br>";
	
	$mail->Subject = $email_subject;
	$devoutput .= "Subject: " . $email_subject . "<br><br>";
	
	$mail->Body = $email_body;
	$devoutput .= "Body:<br> " . $email_body;
	
	$mail->WordWrap = $email_wordwrap;
	
	$mail->IsHTML(true);
	
	$devoutput .= "</html>";
	
	/*
	if ($email_attachment_type == "pdf") {
		$mail->AddStringAttachment($pdf->Output('','S'), $email_attachment_filename,"base64", 'application/pdf');
	} elseif ($email_attachment_type == "pdfcsv") {
		$mail->AddStringAttachment($pdf->Output('','S'), $email_attachment_filename,"base64", 'application/pdf');
		$mail->AddStringAttachment($f, $email_attachment_filename_csv,"base64", 'application/csv');	
	}
	*/

	if (APP_DEVELOP_FLAG == 1) {
		$testfile = fopen($myEmailTemplate . "_" . $myID . ".htm", "w");
		fwrite($testfile, $devoutput);
		fclose($testfile);
		$sendemail_status = "Dev mode: mail not sent but stored as temp file";
	} else {
		
	    if (!$mail->Send()) {
			$sendemail_status = "Message was not sent. " . "Mailer error: " . $mail->ErrorInfo;
		} else {
			$sendemail_status = "";
		}
	}
	
	return $sendemail_status;

}


// function to put a value on the debug array for display (in debug mode) at the end of the page
function dlf_ShowDebugValue($myCategory, $myTitle, $myValue) {
// $myCategory > category for the debug value, just to sort/structure the display of debug values grouped by category (not realised yet)
// $myTitle > title for the display of the debug value
// $myValue > value of the debug value / that's what the developer is really interested in

	global $dlf_debug_array;
	
	array_push($dlf_debug_array, array("category"=>$myCategory, "title"=>$myTitle, "value"=>$myValue));
	return TRUE;
}

function dlf_SetLanguage($my_language) {
//zunächst prüfen ob user eingeloggt, falls ja user spracheinstellung verwenden
// falls kein user eingeloggt, oder keine user spracheinstellung die default spracheinstellung verwenden,
	
	global $login;
		
	if ($login->isUserLoggedIn() == true) {
    // the user is logged in
		if(isset($_SESSION[APP_ID.'_user_language'])) {
			$my_language = $_SESSION[APP_ID.'_user_language'];
		}
	}
	
	return $my_language;
}

// CHECKED / MANUAL
// function to check if current user is super admin
function dlf_isSuperAdmin() {

	global $login;

	$dlf_select_query = "SELECT * FROM " . APP_ID . "_core_users WHERE users_name = '" . $_SESSION[APP_ID.'_user_name'] . "'";

	$dlf_result_set = dlf_db_select_row_query($dlf_select_query);
	
	
	if ($dlf_result_set["users_admin"] == 1 && $dlf_result_set["users_tenants_id"] == 1) {
		return TRUE;
	} else {
		return FALSE;
	}
	
}

// CHECKED / MANUAL
// function to check if current user is admin for the actual tenant
function dlf_isTenAdmin() {

	global $login;

	$dlf_select_query = "SELECT * FROM " . APP_ID . "_core_users WHERE users_name = '" . $_SESSION[APP_ID.'_user_name'] . "'";

	$dlf_result_set = dlf_db_select_query($dlf_select_query);
	
	foreach ($dlf_result_set as $datensatz) {
		if ($datensatz["users_admin"] == 1 && $datensatz["users_tenants_id"] > 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

// CHECKED / MANUAL
// function to check if current user is a public user (user_name == public)
function dlf_isPublic() {

	if ($_SESSION[APP_ID.'_user_name'] == "public") {
		return TRUE;
	} else {
		return FALSE;
	}
	
}

// CHECKED / MANUAL
// function to check if current tenant (and therefore the current user) has access rights on a certain module
function dlf_TenModRights($my_ModuleID) {
// $my_ModuleID > ID of the module for which the access rights should be checked

	global $login;
	
	$select_query = "SELECT * FROM " . APP_ID . "_core_users INNER JOIN " . APP_ID . "_core_tenants_modules ON " . APP_ID . "_core_users.users_tenants_id = ". APP_ID . "_core_tenants_modules.tenants_modules_tenants_id WHERE " . APP_ID . "_core_tenants_modules.tenants_modules_modules_id = " . $my_ModuleID . " AND " . APP_ID . "_core_tenants_modules.tenants_modules_access = 1 AND " . APP_ID . "_core_tenants_modules.tenants_modules_active = 1 AND " . APP_ID . "_core_tenants_modules.tenants_modules_delete = 0 AND " . APP_ID . "_core_users.users_name = '" . $_SESSION[APP_ID.'_user_name'] . "'";

	$result = dlf_db_select_count_query($select_query);
	
	if ($result > 0) {
		return TRUE;
	} else {
		return FALSE;
	}
	
}

// CHECKED / MANUAL
// function to check access rights for the logged user on a certain module (just module rights without public or admin rights)
function dlf_UserModRights($my_ModuleID) {
// $my_ModuleID > ID of the module for which the access rights should be checked

	global $login;

	$select_query = "SELECT * FROM " . APP_ID . "_core_users INNER JOIN " . APP_ID . "_core_users_modules ON " . APP_ID . "_core_users.users_id = " . APP_ID . "_core_users_modules.users_modules_users_id WHERE " . APP_ID . "_core_users_modules.users_modules_modules_id = " . $my_ModuleID . " AND " . APP_ID . "_core_users_modules.users_modules_access > 0 AND " . APP_ID . "_core_users_modules.users_modules_active = 1 AND " . APP_ID . "_core_users_modules.users_modules_delete = 0 AND " . APP_ID . "_core_users.users_name = '" . $_SESSION[APP_ID.'_user_name'] . "'";
	
	$result_set = dlf_db_select_row_query($select_query);
	$result_count = dlf_db_select_count_query($select_query);
	
	
	if ($result_count > 0) {
		return $result_set["users_modules_access"];
	} else {
		return 0;
	}
	
}

// CHECKED / MANUAL
// function to check the access rights for the logged user on a certain module 
function dlf_CheckAccess($my_ModuleID) {
// $my_ModuleID > ID of the module for which the access rights should be checked
	
	
	$accessright = "no";
	
	if ($my_ModuleID == -1) {
		$accessright = "read";
	}

	if (dlf_isPublic() && MOD_PUBLIC_ALLOWED == 1) {
		$accessright = "public";
	}

	if (dlf_UserModRights($my_ModuleID) == 1) {
		$accessright = "read";
	}
	
	if (dlf_UserModRights($my_ModuleID) == 2) {
		$accessright = "write";
	}
	
	if (dlf_UserModRights($my_ModuleID) == 3) {
		$accessright = "admin";
	}
	
	if (dlf_isTenAdmin()) {
		$accessright = "admin";
	}

	if (dlf_isSuperAdmin()) {
		$accessright = "admin";
	}

	return $accessright;
}


function dlf_pagination($dlf_plimit, $dlf_poffset, $dlf_pmax) {
	if ($dlf_plimit == 0) {
		// no pagination
	} else {
		$dlf_pless = $dlf_poffset - $dlf_plimit;
			if ($dlf_pless <= 0) $dlf_pless = 0;
			if ($dlf_poffset > 0) {
				echo "<div><a href=\"#\" onclick=\"dlf_control_pagination(" . $dlf_plimit . "," . $dlf_pless . ")\">ZURÜCK</a></div>";
			} else {
				echo "<div>ZURÜCK</div>";
			}
		$dlf_pmore = $dlf_poffset + $dlf_plimit;
			if ($dlf_pmore >= $dlf_pmax) $dlf_pmore = $dlf_pmax;
			if ($dlf_poffset < $dlf_pmax - $dlf_plimit) {
				echo "<div><a href=\"#\" onclick=\"dlf_control_pagination(" . $dlf_plimit . "," . $dlf_pmore . ")\">WEITER</a></div>";
			} else {
				echo "<div>WEITER</div>";
			}
		}
}

// CHECKED / MANUAL
// function to return the ID for a certain module
function dlf_IDOfModule($myModule) {
// $myModule > name of the module for which the ID should be received
// 20171027_SKruIJ: extended for the core module cases 'home', 'modules', 'users', 'tenants' 

	global $login;

	switch ($myModule) {
		case "home":
			return -1;
			exit;
			break;
		case "modules":
			return -2;
			exit;
			break;
		case "users":
			return -3;
			exit;
			break;
		case "tenants":
			return -4;
			exit;
			break;
	}
	
	
	$select_query = "SELECT * FROM " . APP_ID . "_core_modules WHERE modules_title = '" . $myModule . "'";
	
	$result_set = dlf_db_select_row_query($select_query);
	$result_count = dlf_db_select_count_query($select_query);
	
	
	if ($result_count > 0) {
		return $result_set["modules_id"];
	} else {
		return 0;
	}
	
}


// CHECKED / MANUAL
// 20171128_SKruIJ: new function
// function to return the input text if sufficient access level
function dlf_CheckOutputByAccessLevel($myTextInput, $myAccessLevel) { 
// $myTextInput > input text
// $myAccessLevel > access level for which output is foreseen, can be "public", "read", "write", "admin"

	global $dlf_access;
	
	$myTextReturn = "";
	
	switch ($myAccessLevel) {
		case "admin":
			if ($dlf_access == "admin") {
				$myTextReturn = $myTextInput;
			} else {
				$myTextReturn = "";
			}
			break;
		case "write":
			if ($dlf_access == "admin" || $dlf_access == "write") {
				$myTextReturn = $myTextInput;
			} else {
				$myTextReturn = "";
			}
			break;
		case "read":
			if ($dlf_access == "admin" || $dlf_access == "write" || $dlf_access == "read") {
				$myTextReturn = $myTextInput;
			} else {
				$myTextReturn = "";
			}
			break;
		case "public":
			if ($dlf_access == "admin" || $dlf_access == "write" || $dlf_access == "read" || $dlf_access == "public") {
				$myTextReturn = $myTextInput;
			} else {
				$myTextReturn = "";
			}
			break;
		default:
			$myTextReturn = "";
	}
	
	return $myTextReturn;
	
}


// function to unset session variables only belonging to the active APP_ID / replacing session_unset
function dlf_session_unset() {

	foreach ($_SESSION as $key => $value) {
		if (substr($key,0,3) == APP_ID) {
				unset($_SESSION[$key]);
		}
	}
	
}

?>
