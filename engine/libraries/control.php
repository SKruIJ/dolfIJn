<?php

/****************************************
dolfIJn
SKruIJ 2018-10-12
/engine/libraries/control.php
main crud control
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// Variable initialisation area

$dlf_form_validation_jquery = ""; // used in \engine\libraries\input.php to build form validation jquery for the start part of the jquery
//SKruIJ_20181012: $dlf_form_validation_msg added for individual error messages in the validation process
$dlf_form_validation_msg = ""; // used in \engine\libraries\input.php to build messages for form validation jquery for the start part of the jquery
$dlf_form_validation_jquery_final = ""; // used in \engine\libraries\input.php to build form validation jquery / jquery finally integrated in page.php
$dlf_edit_number_fields = 0; // used in \engine\libraries\input.php to count the number of input fields

//SKruIJ_20160824: initialisation of array for debug mode, collecting all values which should be shown if debug / array will be shown at the end of the html output
$dlf_debug_array = array();
// additional category/title/value pairs have to be added via the following function:
// dlf_ShowDebugValue($myCategory, $myTitle, $myValue)

// $dlf_modules gibt das verwendete module an
if(isset($_POST["dlf_modules"])) {
	$dlf_modules = $_POST["dlf_modules"];
	$_SESSION[APP_ID."_dlf_modules"] = $_POST["dlf_modules"];
} elseif (isset($_SESSION[APP_ID."_dlf_modules"])) {
	$dlf_modules = $_SESSION[APP_ID."_dlf_modules"];
} else { // nichts übergeben > start situation
	$dlf_modules = APP_START_MODULE;
}

// $dlf_language gibt die verwendete Sprache an (falls kein definierter User mit Sprachwahl)
if(isset($_POST["dlf_language"])) {
	$dlf_language = $_POST["dlf_language"];
	$_SESSION[APP_ID."_dlf_language"] = $_POST["dlf_language"];
} elseif (isset($_SESSION[APP_ID."_dlf_language"])) {
	$dlf_language = $_SESSION[APP_ID."_dlf_language"];
} else {
	if(null !== APP_START_LANGUAGE) {
		$dlf_language = APP_START_LANGUAGE;
	} else {
		$dlf_language = DLF_DEFAULT_LANGUAGE;
	}
}


// $dlf_dataview gibt den Datenview an
if(isset($_POST["dlf_dataview"])) {
	$dlf_dataview = $_POST["dlf_dataview"];
	$_SESSION[APP_ID."_dlf_dataview"] = $_POST["dlf_dataview"];
} elseif (isset($_SESSION[APP_ID."_dlf_dataview"])) {
	$dlf_dataview = $_SESSION[APP_ID."_dlf_dataview"];
} else {
	$dlf_dataview = "default";
} // list, item, new, edit

// $dlf_id gibt die id im Fall dataview item
if(isset($_POST["dlf_id"])) {
	$dlf_id = $_POST["dlf_id"];
	$_SESSION[APP_ID."_dlf_id"] = $_POST["dlf_id"];
} elseif (isset($_SESSION[APP_ID."_dlf_id"])) {
	$dlf_id = $_SESSION[APP_ID."_dlf_id"];
} else {
	$dlf_id = 0;
}

// $dlf_action gibt an ob und welche db action aufgerufen wird
if(isset($_POST["dlf_action"])) {
	$dlf_action = $_POST["dlf_action"];
	$_SESSION[APP_ID."_dlf_action"] = $_POST["dlf_action"];
} elseif (isset($_SESSION[APP_ID."_dlf_action"])) {
	$dlf_action = $_SESSION[APP_ID."_dlf_action"];	
} else {
	$dlf_action = "";
} // create, update, delete

// dlf_message
if (isset($_SESSION[APP_ID."_dlf_message"])) {
	unset($dlf_message);
	$dlf_message = unserialize($_SESSION[APP_ID."_dlf_message"]);
} else {
	$dlf_message = array();
}

// dlf_error
if (isset($_SESSION[APP_ID."_dlf_error"])) {
	unset($dlf_error);
	$dlf_error = unserialize($_SESSION[APP_ID."_dlf_error"]);
} else {
	$dlf_error = array();
}

// SKruIJ_20171206: new dlf_form_values array
// dlf_form_values
if (isset($_SESSION[APP_ID."_dlf_form_values"])) {
	unset($dlf_form_values);
	$dlf_form_values = unserialize($_SESSION[APP_ID."_dlf_form_values"]);
} else {
	$dlf_form_values = array();
}


// $dlf_search gibt den searchquery an
if(isset($_POST["dlf_search"])) {$dlf_search = $_POST["dlf_search"];} else {$dlf_search = "";} 

// $dlf_orderby gibt die Sortierreihenfolge an
if(isset($_POST["dlf_orderby"])) {$dlf_orderby = $_POST["dlf_orderby"];} else {$dlf_orderby = "";} 

// $dlf_screen gibt den anzuzeigenden Screen an // Standard ist default
// wird noch nicht verwendet
// if(isset($_POST["dlf_screen"])) {$dlf_screen = $_POST["dlf_screen"];} else {$dlf_screen = APP_SCREEN;} 

// $dlf_pagination_limit und $dlf_pagination_offset geben offset und limit für pagination an // limit = 0 > keine pagination
if(isset($_POST["dlf_pagination_limit"])) {$dlf_pagination_limit = $_POST["dlf_pagination_limit"];} else {$dlf_pagination_limit = DLF_PAGINATION_LIMIT;}
if(isset($_POST["dlf_pagination_offset"])) {$dlf_pagination_offset = $_POST["dlf_pagination_offset"];} else {$dlf_pagination_offset = 0;}

// steuer_form zur Einbindung in jede Seite
//SKruIJ_20160824: the debug part has been replaced by pushing value pairs to the debug array
$dlf_steuer_form = "";
// Form soll ganze Seite abdecken, da nicht alle Browser die Einbindung von Feldern außerhalb der Form erlauben, daher in page.php integriert
// $dlf_steuer_form .= "<form id=\"dlf_form\" method=\"post\" action=\"index.php\" name=\"steuerform\">";
$dlf_steuer_form .= "<input id=\"dlf_modules\" type=\"hidden\" name=\"dlf_modules\" value=\"" . $dlf_modules . "\">";
$dlf_steuer_form .= "<input id=\"dlf_language\" type=\"hidden\" name=\"dlf_language\" value=\"" . $dlf_language . "\">";
$dlf_steuer_form .= "<input id=\"dlf_dataview\" type=\"hidden\" name=\"dlf_dataview\" value=\"" . $dlf_dataview . "\">";
$dlf_steuer_form .= "<input id=\"dlf_id\" type=\"hidden\" name=\"dlf_id\" value=\"" . $dlf_id . "\">";
$dlf_steuer_form .= "<input id=\"dlf_action\" type=\"hidden\" name=\"dlf_action\" value=\"" . $dlf_action . "\">";
$dlf_steuer_form .= "<input id=\"dlf_orderby\" type=\"hidden\" name=\"dlf_orderby\" value=\"" . $dlf_orderby . "\">";
$dlf_steuer_form .= "<input id=\"dlf_edit_mode\" type=\"hidden\" name=\"dlf_edit_mode\" value=\"unchanged\" onchange=\"dlf_if_changed_mode()\">";
//$dlf_steuer_form .= "<input id=\"dlf_screen\" type=\"hidden\" name=\"dlf_screen\" value=\"" . $dlf_screen . "\">";
$dlf_steuer_form .= "<input id=\"dlf_pagination_limit\" type=\"hidden\" name=\"dlf_pagination_limit\" value=\"" . $dlf_pagination_limit . "\">";
$dlf_steuer_form .= "<input id=\"dlf_pagination_offset\" type=\"hidden\" name=\"dlf_pagination_offset\" value=\"" . $dlf_pagination_offset . "\">";
$dlf_steuer_form .= "<input id=\"logout\" type=\"hidden\" name=\"logged\" value=\"" . "1" . "\">";
// Form soll ganze Seite abdecken, da nicht alle Browser die Einbindung von Feldern außerhalb der Form erlauben, daher in page.php integriert
// $dlf_steuer_form .= "</form>";

//SKruIJ_20160824: pushing value pairs to the debug array to display values in case of debug at the end of page
dlf_ShowDebugValue("control", "dlf_modules", $dlf_modules);
dlf_ShowDebugValue("control", "dlf_language", $dlf_language);
dlf_ShowDebugValue("control", "dlf_dataview", $dlf_dataview);
dlf_ShowDebugValue("control", "dlf_id", $dlf_id);
dlf_ShowDebugValue("control", "dlf_action", $dlf_action);
dlf_ShowDebugValue("control", "dlf_orderby", $dlf_orderby);
dlf_ShowDebugValue("control", "dlf_pagination_limit", $dlf_pagination_limit);
dlf_ShowDebugValue("control", "dlf_pagination_offset", $dlf_pagination_offset);

// steuer_funct zur Einbindung in jede Seite
$dlf_control = "<script type=\"text/javascript\">";
//SKruIJ_20150507: call of FormCheck() added; action only in case of correct filled form fields
$dlf_control .= 
	"function logout() {
        document.getElementById('logout').name = 'logout';
		document.getElementById('dlf_modules').value = 'home';
		document.getElementById('dlf_dataview').value = 'default';
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
		document.getElementById('dlf_form').submit();
    }";
$dlf_control .= 
	"function dlf_control(dataview, id, action) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = action;
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
/*
$dlf_control .= 
	"function dlf_control_new(dataview) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_item(dataview, id) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_edit(dataview, id) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_delete(dataview, id) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = 'del00';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_list(dataview) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_update(dataview, id) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = 'upd00';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
$dlf_control .= 
	"function dlf_control_create(dataview) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = 'cre00';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";

$dlf_control .= 
	"function dlf_control_back(dataview) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";

$dlf_control .= 
	"function dlf_control_cancel(dataview, id) {
	    document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = id;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
	}";
*/
$dlf_control .= 
	"function dlf_switch(modulestitle, dataview) {
		document.getElementById('dlf_modules').value = modulestitle;
		document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_pagination_offset').value = 0;
		document.getElementById('dlf_form').submit();
    }";

/*
$dlf_control .= 
	"function dlf_switch_module(modulestitle) {
		document.getElementById('dlf_modules').value = modulestitle;
		document.getElementById('dlf_dataview').value = 'default';
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_form').submit();
    }";
$dlf_control .= 
	"function dlf_switch_dataview(dataview) {
		document.getElementById('dlf_dataview').value = dataview;
		document.getElementById('dlf_id').value = 0;
		document.getElementById('dlf_action').value = '';
		document.getElementById('dlf_form').submit();
    }";
$dlf_control .= 
	"function dlf_control_orderby(orderby) {
        document.getElementById('dlf_orderby').value = orderby;
		document.getElementById('dlf_form').submit();
    }";
$dlf_control .= 
	"function dlf_control_pagination(limit,offset) {
        document.getElementById('dlf_pagination_limit').value = limit;
		document.getElementById('dlf_pagination_offset').value = offset;
		document.getElementById('dlf_form').submit();
    }";
*/
$dlf_control .= 
	"function dlf_change_mode() {
		if (document.getElementById('dlf_edit_mode').value == 'unchanged') {
			document.getElementById('dlf_edit_mode').value = 'changed';
			$(\"#dlf_edit_mode\").trigger('change');
		}
	}";
$dlf_control .= 
	"function dlf_if_changed_mode() {
		$(\".btn-update\").removeClass(\"disabled\");
		$(\".btn-create\").removeClass(\"disabled\");
	}";
/*
$dlf_control .= 
	"function dlf_control_language(language) {
        document.getElementById('dlf_language').value = language;
		document.getElementById('dlf_form').submit();
    }";
*/
$dlf_control .= "</script>";

?>
