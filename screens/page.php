<?php

/****************************************
dolfIJn
SKruIJ 2018-04-10
/screens/page.php
main page screen building the page by integration of different screens
ü
****************************************/

// check if key is set, otherwise the script is stopped here
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

echo "<!DOCTYPE html>";

// SKruIJ_20180302: language setting moved to start.php

echo "<html lang=\"" . substr($dlf_language,-2,2) . "\"><head>";

// take head constructed with engine start
echo $dlf_head;

echo "</head>";

if (APP_IFRAME_FLAG == 1) {
	echo "<body onload=\"parent.scrollTo(0,0);\">";
} else {
	echo "<body>";
}


// ... ask if we are logged in here:
if ($login->isUserLoggedIn() == true) {
    // the user is logged in
	
	// menu display
	if (file_exists("screens/default/elements/menu.php")) {
		require("screens/default/elements/menu.php");
	} else {
		exit('DLF-ERROR 04-04');
	}

	// output of error or message
	$dlf_error_flag = 0;
	echo "<div class=\"container\">";
	if (count($dlf_error) > 0) {
		$dlf_error_flag = 1;
		echo "<div class=\"alert alert-danger\" role=\"alert\">";
		foreach ($dlf_error as $output) {
			if ($output != "") {
				echo "<div>" . $output . "</div>";
			} 
		}
		echo "</div>";
	}
	
	if (count($dlf_message) > 0) {
		echo "<div class=\"alert alert-success\" role=\"alert\">";
		foreach ($dlf_message as $output) {
			if ($output != "") {
				echo "<div>" . $output . "</div>";
			}
		}
		echo "</div>";
	}
	echo "</div>";

	// session variables for error and message reset
	$dlf_error = array();
	$dlf_message = array();
	$_SESSION[APP_ID."_dlf_message"] = serialize($dlf_message);
	$_SESSION[APP_ID."_dlf_error"] = serialize($dlf_error);
	
	// breadcrump display
	// 20161125_SKruIJ: temp deactivated, lower priority
	/*
	if (file_exists("screens/default/elements/breadcrumb.php")) {
		require("screens/default/elements/breadcrumb.php");
	} else {
		exit('DLF-ERROR 04-05');
	}
	*/
	
	// validation builder has to be initialised with the main functionality before afterwards further validation rules are added via the input fields
	dlf_form_validation_builder("", array(), 0);
	
	//SKruIJ_20160507: added accept charset
	echo "<div class=\"container\">";
	echo "<form id=\"dlf_form\" method=\"post\" action=\"index.php\" name=\"steuerform\" accept-charset=\"UTF-8\">";
		
	// including all the form fields to control the application
	echo $dlf_steuer_form;

	echo "<div class=\"container\">";
	
	if ($dlf_modules == "home") {
		if (file_exists("screens/default/body.php")) {
			require("screens/default/body.php");
		} else {
			exit('DLF-ERROR 04-06');	
		}
	} elseif ($dlf_modules == "modules") {
		if (file_exists("core/modules/body.php")) {
			require("core/modules/body.php");
		} else {
			exit('DLF-ERROR 04-07');	
		}
	} else {
		if (MOD_METHOD != 'straight') {
		// in case non-straight using dataviews instead body.php
	
			// it's checked if selected dataview is matching with one of the in mds.php defined dataviews in the $dlf_viewset array
			// if selected dataview is "default" the first element from $dlf_viewset array will be chosen
			// if no match > error message and exit
			
			$selected_view = "";
			if($dlf_dataview == "default") {
				$selected_view = MOD_DEFAULT_DATAVIEW;
				//SKruIJ_20180222: in case default the dlf_form_values are reseted
				unset($dlf_form_values);
				$dlf_form_values = array();
				
				
			} else {
				$selected_view = $dlf_dataview;
			}
			
			
			if ($selected_view == "") {
				exit('MOD-ERROR 04-08');
			}

			if (file_exists("modules/" . $dlf_modules . "/dataviews/" . $selected_view . ".php")) {
				require("modules/" . $dlf_modules . "/dataviews/" . $selected_view . ".php");
			} else {
				exit('MOD-ERROR 04-09');
			}

		} else {
		// only in case 'straight' body.php exists
			if (file_exists("modules/" . $dlf_modules . "/body.php")) {
				require("modules/" . $dlf_modules . "/body.php");
			} else {
				exit('MOD-ERROR 04-10');	
			}
		}
	}
	
	echo "<div class=\"spacer\">&nbsp;</div>";
	echo "<div class=\"spacer\">&nbsp;</div>";
	echo "<div class=\"spacer\">&nbsp;</div>";
	echo "<div class=\"spacer\">&nbsp;</div>";
	
	echo "</div>";

	//end of the form
	echo "</form></div>";

} else {

	// the user is not logged in
	if (file_exists("screens/default/login.php")) {
		require("screens/default/login.php");
	} else {
		exit('DLF-ERROR 04-11');
	}
	
}


// footer display
if (file_exists("screens/default/elements/footer.php")) {
	require("screens/default/elements/footer.php");
} else {
	exit('DLF-ERROR 04-12');
}


if (APP_DEBUG_FLAG == 1) {
	echo "<div class=\"container\"><div class=\"debug_values\">";
		foreach ($dlf_debug_array as $werte) {
			echo "<div>" . $werte['title'] . ": " . $werte['value'] . "</div>";
		}
	echo "</div>";
	
}


// integration of js functions for control from control.php
echo $dlf_control;

// specific validation methods for jQuery validator from the core
if (file_exists("engine/js/validation.js")) {
	require("engine/js/validation.js");
} else {
	exit('DLF-ERROR 04-13');
}
// specific validation methods for jQuery validator from the app
if (file_exists("app/engine/js/validation.js")) {
	require("app/engine/js/validation.js");
}
// specific validation methods for jQuery validator from the module
if (file_exists("modules/" . $dlf_modules . "/engine/js/validation.js")) {
	require("modules/" . $dlf_modules . "/engine/js/validation.js");
}


// integration of jquery functions for form validation constructed in input.php
echo $dlf_form_validation_jquery_final;

// modal dialog for delete confirmation, not displayed at the start of the page
echo "<div id=\"dlf_delete_confirm\" class=\"modal fade\" role=\"dialog\">";
echo "<div class=\"modal-dialog\">";
echo "<div class=\"modal-content\">";
echo "<div class=\"modal-header\">";
echo "<div class=\"modal-body\">";
echo "<p><span class=\"glyphicon glyphicon-exclamation-sign\"></span> " . DLF_MODAL_SHOULD_BE_DELETED . "</p>";
echo "</div>";
echo "<div class=\"modal-footer\">";
echo "<button type=\"button\" class=\"btn btn-custom\" data-dismiss=\"modal\"><span class=\"glyphicon glyphicon-ok\"></span> " . DLF_MODAL_CANCEL . " </button>";
echo "<button type=\"button\" class=\"btn btn-danger\" data-dismiss=\"modal\" id=\"dlf_delete_confirm_btn\"><span class=\"glyphicon glyphicon-remove\"></span> " . DLF_MODAL_DELETE . " </button>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";

// EventListener for submit event when confirmation is clicked in the modal delete dialog
echo <<<eof
<script>
	document.getElementById("dlf_delete_confirm_btn").addEventListener("click", function() {
	document.getElementById('dlf_form').submit();
	document.getElementById('dlf_loading').style.display = 'block';
}
); 
</script>
eof;

//this part is not displayed with the start of the page but shown as "loading" after submit 
echo "<div id=\"dlf_loading\">&nbsp;</div>";

echo "</body></html>";

?>