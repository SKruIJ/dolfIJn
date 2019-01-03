<?php

/****************************************
dolfIJn
SKruIJ 2018-11-27
/engine/libraries/buttons.php
functions for navigation, menu, link, action buttons
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");


// CHECKED / MANUAL
// function to return a well with several buttons for further action or navigation / it can include up to 4 buttons, taking into account the access rights
function dlf_buttonwell($myButtonList, $myAccessLevel = "public") {
// $myButtonList > array including a list of buttons (each as array) which should be displayed within the well / should not exceed 4 buttons
// > button array >  "button type" e.g "home" , position as int (1 - 4), access level (optional)
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default
	
	
	//global $dlf_access;
	
	$myTextTemp = "";
	
	$myTextTemp = "<div class=\"well well-sm row\">";
	
	$prevbuttonpos = 0;
	
	foreach($myButtonList as $button) {
		
		$buttonpos = $button[1] - $prevbuttonpos;
		$prevprevbuttonpos = $prevbuttonpos;
		$prevbuttonpos = $button[1];
		
		switch($button[0]) {
			case "home":
				
				if(isset($button[2])) {	
					$myTextTemp2 = dlf_button_home($buttonpos, $button[2]);
				} else {
					$myTextTemp2 = dlf_button_home($buttonpos);	
				}
				
				break;
			case "default":
				
				if(isset($button[2])) {	
					$myTextTemp2 = dlf_button_default($buttonpos, $button[2]);
				} else {
					$myTextTemp2 = dlf_button_default($buttonpos);	
				}
				break;
			case "send":
		
				if(isset($button[3])) {	
					$myTextTemp2 = dlf_button_send($buttonpos, $button[2], $button[3]);
				} else {
					$myTextTemp2 = dlf_button_send($buttonpos, $button[2]);	
				}
				
				break;
			case "create":
						
				if(isset($button[3])) {	
					$myTextTemp2 = dlf_button_create($buttonpos, $button[2], $button[3]);
				} else {
					$myTextTemp2 = dlf_button_create($buttonpos, $button[2]);	
				}
				
				break;
			case "next":
						
				if(isset($button[3])) {	
					$myTextTemp2 = dlf_button_next($buttonpos, $button[2], $button[3]);
				} else {
					$myTextTemp2 = dlf_button_next($buttonpos, $button[2]);	
				}
				
				break;
			case "back":
						
				if(isset($button[3])) {	
					$myTextTemp2 = dlf_button_back($buttonpos, $button[2], $button[3]);
				} else {
					$myTextTemp2 = dlf_button_back($buttonpos, $button[2]);	
				}
				
				break;
			default:
				$myTextTemp2 = ""; 
				break;
		}
		
		if($myTextTemp2 == "") {
			// fehlende Position durch Nicht-Anzeige des Buttons muss korrigiert werden
			$prevbuttonpos = $prevprevbuttonpos;
		} else {
			$myTextTemp .= $myTextTemp2;
		}
	
	}
	
	$myTextTemp .= "</div>";
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $myAccessLevel);
		
	return $myTextReturn;
	
}


// CHECKED / MANUAL
// function to return a home button, taking into account the access rights
// the home button is navigating back to home
function dlf_button_home($myPosition, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default

	
	$myTextTemp = "";
	
	if(!isset($myInputpara["access"])) {
		$access = "public";
	} else {
		$access = $myInputpara["access"];	
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_HOME;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-home";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
	
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"button\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_switch('home', 'default')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
		
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);
	
	return $myTextReturn;
	
}

// function to return a default button, taking into account the access rights
// the default button is navigating back to the default view of a module (without launching an action)
function dlf_button_default($myPosition, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default

	
	$myTextTemp = "";

	if(!isset($myInputpara["access"])) {
		$access = "public";
	} else {
		$access = $myInputpara["access"];	
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_DEFAULT;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-record";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
			
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$module = $_SESSION[APP_ID . "_dlf_modules"];
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"button\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_switch('" . $module . "', 'default')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
		
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);
	
	return $myTextReturn;
	
}



// CHECKED / MANUAL
// function to return a send button, taking into account the access rights (in case of non-public modules)
// in case of 'public' modules the send button is been displayed for all users, even public users
// the send button is sending the form and launching a create action / it's stepping to a dataview within the same module
function dlf_button_send($myPosition, $myDataview, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myDataview > the dataview which is shown next
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default


	$myTextTemp = "";
	
	if(!isset($myInputpara["access"])) {
		$access = "public";
	} else {
		$access = $myInputpara["access"];		
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_SEND;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-send";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
	if(!isset($myInputpara["action"])) {
		$action = "cre00";
	} else {
		$action = $myInputpara["action"];
	}
	
	
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_control('" . $myDataview . "',0,'" . $action ."')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
		
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);
	
	return $myTextReturn;
	
}

// function to return a create button, taking into account the access rights
// create button only works for write and admin rights
// the create button is sending the form and launching a create action / it's stepping to a dataview within the same module
// the create button won't be displayed for public users, even if module is declared public / therefore send button has to be used
function dlf_button_create($myPosition, $myDataview, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myDataview > the dataview which is shown next
// $myTransID > transaction ID, each db transaction has an ID / create transactions should start with 'cre..'
// $myAccessLevel > optional / access level for which output is foreseen, "write" is default, only "admin" can be used as restriction

	
	$myTextTemp = "";
	
	if(!isset($myInputpara["access"])) {
		$access = "write";
	} else {
		if ($myInputpara["access"] == "admin") {
			$access = $myInputpara["access"];
		} else {
			$access = "write";
		}
		
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_CREATE;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-save";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
	if(!isset($myInputpara["action"])) {
		$action = "cre01";
	} else {
		$action = $myInputpara["action"];
	}
	
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_control('" . $myDataview . "',0,'" . $action . "')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
	
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);

	return $myTextReturn;
	
}



// CHECKED / MANUAL
// function to return a back button, taking into account the access rights
// the back button is stepping to a dataview within the same module, taking it aa a previous view in the flow
function dlf_button_back($myPosition, $myDataview, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myDataview > the dataview which is shown next
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default



	$myTextTemp = "";
	
	if(!isset($myInputpara["access"])) {
		$access = "public";
	} else {
		$access = $myInputpara["access"];		
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_BACK;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-menu-left";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
	
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_control('" . $myDataview . "',0,'')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
		
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);
	
	return $myTextReturn;
	
}

// CHECKED / MANUAL
// function to return a next button, taking into account the access rights
// the next button is stepping to a dataview within the same module, taking it aa a next view in the flow
function dlf_button_next($myPosition, $myDataview, $myInputpara = array()) {
// $myPosition > Position of the button as int / allowed are values 1 - 4	
// $myDataview > the dataview which is shown next
// $myAccessLevel > optional / access level for which output is foreseen, can be "public", "read", "write", "admin", "public" is default


	$myTextTemp = "";
	
	if(!isset($myInputpara["access"])) {
		$access = "public";
	} else {
		$access = $myInputpara["access"];		
	}
	
	if(!isset($myInputpara["text"])) {
		$text = DLF_BUTTON_NEXT;
	} else {
		$text = $myInputpara["text"];
	}
	
	if(!isset($myInputpara["icon"])) {
		$icon = "glyphicon glyphicon-menu-right";
	} else {
		$icon = "glyphicon glyphicon-" . $myInputpara["icon"];
	}
	
	
	$colstr = "";
	
	switch($myPosition) {
		case 1:
			$colstr = "col-xs-3 col-xs-offset-0";
			break;
		case 2:
			$colstr = "col-xs-3 col-xs-offset-3";
			break;
		case 3:
			$colstr = "col-xs-3 col-xs-offset-6";
			break;
		case 4:
			$colstr = "col-xs-3 col-xs-offset-9";
			break;
		default:
		
			break;
	}
	
	$myTextTemp = "<button class=\"btn btn-md btn-custom " . $colstr . "\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $text . "\" alt=\"" . $text . "\" onclick=\"dlf_control('" . $myDataview . "',0,'')\"><span class=\"" . $icon . "\"></span><span class=\"empty-for-mobile\"> " . $text . " </span></button>";
		
	$myTextReturn = dlf_CheckOutputByAccessLevel($myTextTemp, $access);
	
	return $myTextReturn;
	
}

/*

// function for a button to submit the form to switch to another module/dataview with quite custom settings / no submit, not starting an action
// the function is making use of the js function dlf_switch()
function dlf_button_navi($myModule,$myDataView, $myButtonText, $myGlyphIconStart, $myGlyphIconEnd) {
// $myModule > the target module to switch to
// $myDataview > the target dataview to switch to
// $myButtonText > text on the button
// $myGlyphIconStart > icon to be display at the beginning
// $myGlyphIconEnd > icon to be display at the end


	return "<button class=\"btn btn-sm btn-custom\" type=\"button\"  data-toggle=\"tooltip\" title=\"" . $myButtonText . "\" alt=\"" . $myButtonText . "\" onclick=\"dlf_switch('" . $myModule . "', '" . $myDataView . "')\"><span class=\"glyphicon glyphicon-menu-" . $myGlyphIconStart . "\"></span><span class=\"empty-for-mobile\"> " . $myButtonText . " </span><span class=\"glyphicon glyphicon-" . $myGlyphIconEnd . "\"></span></button>";
	
}



// function for a button to submit the form to switch to another module/dataview with quite custom settings / could start an action
// the function is making use of the js function dlf_control()
function dlf_button_custom_icon($myModule,$myDataView, $myID, $myAction, $myButtonText, $myGlyphIconStart, $myGlyphIconEnd) {
// $myModule > the target module to switch to
// $myDataview > the target dataview to switch to
// $myID > the id of the current data item
// $myAction > the action which should be started "create"/"update"/"delete"
// $myButtonText > text on the button
// $myGlyphIconStart > icon to be display at the beginning
// $myGlyphIconEnd > icon to be display at the end


	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $myButtonText . "\" alt=\"" . $myButtonText . "\" onclick=\"dlf_control('" . $myModule . "', '" . $myDataView . "', " . $myID . ", '" . $myAction . "')\"><span class=\"glyphicon glyphicon-" . $myGlyphIconStart . "\"></span><span class=\"empty-for-mobile\"> " . $myButtonText . " </span><span class=\"glyphicon glyphicon-" . $myGlyphIconEnd . "\"></span></button>";
	
}

// function for a button to submit the form to switch to another module/dataview with quite custom settings / could start an action / right alignment
// the function is making use of the js function dlf_control()
function dlf_button_custom_icon_right($myModule,$myDataView, $myID, $myAction, $myButtonText, $myGlyphIconStart, $myGlyphIconEnd) {
// $myModule > the target module to switch to
// $myDataview > the target dataview to switch to
// $myID > the id of the current data item
// $myAction > the action which should be started "create"/"update"/"delete"
// $myButtonText > text on the button
// $myGlyphIconStart > icon to be display at the beginning
// $myGlyphIconEnd > icon to be display at the end


	return "<button class=\"btn btn-sm btn-custom pull-right\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $myButtonText . "\" alt=\"" . $myButtonText . "\" onclick=\"dlf_control('" . $myModule . "', '" . $myDataView . "', " . $myID . ", '" . $myAction . "')\"><span class=\"glyphicon glyphicon-" . $myGlyphIconStart . "\"></span><span class=\"empty-for-mobile\"> " . $myButtonText . " </span><span class=\"glyphicon glyphicon-" . $myGlyphIconEnd . "\"></span></button>";
	
}


// function for a button to submit the form to switch to another module/dataview with quite custom settings / could start an action
// the function is making use of the js function dlf_control()
function dlf_button_custom($myModule,$myDataView, $myID, $myAction, $myButtonText) {
// $myModule > the target module to switch to
// $myDataview > the target dataview to switch to
// $myID > the id of the current data item
// $myAction > the action which should be started "create"/"update"/"delete"
// $myButtonText > text on the button

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . $myButtonText . "\" alt=\"" . $myButtonText . "\" onclick=\"dlf_control('" . $myModule . "', '" . $myDataView . "', " . $myID . ", '" . $myAction . "')\">" . $myButtonText . " </button>";
	
}


// function for a button to submit the form to switch to a dataview for creating a new item / it's not starting an action
// the function is making use of the js function dlf_control_new()
function dlf_button_new($myDataView) {
// $myDataview > the target dataview to switch to

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_NEW . "\" alt=\"" . DLF_BUTTON_NEW . "\" onclick=\"dlf_control_new('" . $myDataView . "')\"><span class=\"glyphicon glyphicon-plus\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_NEW . " </span></button>";
	
}

// function for a button to submit the form for switch to show one of the items / it's not starting an action
// the function is making use of the js function dlf_control_item()
function dlf_button_item($myDataView, $myId) {
// $myDataview > the target dataview to switch to
// $myId > the id of the current data item 

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_ITEM . "\" alt=\"" . DLF_BUTTON_ITEM . "\" onclick=\"dlf_control_item('" . $myDataView . "'," . $myId . ")\"><span class=\"glyphicon glyphicon-list-alt\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_ITEM . " </span></button>";
	
}

// function for a button to submit the form for switch to edit one of the items / it's not starting an action
// the function is making use of the js function dlf_control_edit()
function dlf_button_edit($myDataView, $myId) {
// $myDataview > the target dataview to switch to
// $myId > the id of the current data item 

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_EDIT . "\" alt=\"" . DLF_BUTTON_EDIT . "\" onclick=\"dlf_control_edit('" . $myDataView . "'," . $myId . ")\"><span class=\"glyphicon glyphicon-pencil\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_EDIT . " </span></button>";
	
}

// function for a button to submit the form to delete one of the items / it's starting a delete action
// the function is making use of the js function dlf_control_delete()
function dlf_button_delete($myDataView, $myId) {
// $myDataview > the target dataview to switch to after delete
// $myId > the id of the current data item 

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_DELETE . "\" alt=\"" . DLF_BUTTON_DELETE . "\" onclick=\"dlf_control_delete('" . $myDataView . "'," . $myId . ")\"><span class=\"glyphicon glyphicon-remove\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_DELETE . " </span></button>";
	
}

// function for a button to submit the form to switch to a dataview for a list view / it's not starting an action
// the function is making use of the js function dlf_control_list()
function dlf_button_list($myDataView) {
// $myDataview > the target dataview to switch to

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_LIST . "\" alt=\"" . DLF_BUTTON_LIST . "\" onclick=\"dlf_control_list('" . $myDataView . "')\"><span class=\"glyphicon glyphicon-list\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_LIST . " </span></button>";
	
}

// function for a button to submit the form to switch to a dataview as a back step / it's not starting an action
// the function is making use of the js function dlf_control_back()
function dlf_button_back($myDataView) {
// $myDataview > the target dataview to switch to

	//return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_BACK . "\" alt=\"" . DLF_BUTTON_BACK . "\" onclick=\"dlf_control_back('" . $myDataView . "')\"><span class=\"glyphicon glyphicon-menu-left\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_BACK . " </span></button>";
	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\"  data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_BACK . "\" alt=\"" . DLF_BUTTON_BACK . "\" onclick=\"dlf_control_back('" . $myDataView . "')\"><span class=\"glyphicon glyphicon-menu-left\"></span></button>";
	
}

// function for a button to submit the form to update the item / it's starting an update action
// the function is making use of the js function dlf_control_update()
function dlf_button_update($myDataView, $myId) {
// $myDataview > the target dataview to switch to after update
// $myId > the id of the current data item 

// the class 'btn-update' is used for removing the disabled class when change mode happened
	return "<button class=\"btn btn-sm btn-custom btn-update disabled\" type=\"submit\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_UPDATE . "\" alt=\"" . DLF_BUTTON_UPDATE . "\" onclick=\"dlf_control_update('" . $myDataView . "'," . $myId . ")\"><span class=\"glyphicon glyphicon-save\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_UPDATE . " </span></button>";
	
}

// function for a button to submit the form to create a new item / it's starting a create action
// the function is making use of the js function dlf_control_create()
function dlf_button_create($myDataView) {
// $myDataview > the target dataview to switch to after update

// the class 'btn-create' is used for removing the disabled class when change mode happened
	return "<button class=\"btn btn-sm btn-custom btn-create disabled\" type=\"submit\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_CREATE . "\" alt=\"" . DLF_BUTTON_CREATE . "\" onclick=\"dlf_control_create('" . $myDataView . "')\"><span class=\"glyphicon glyphicon-save\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_CREATE . " </span></button>";
	
}


// function for a button to cancel the form / it's not starting an action
// the function is making use of the js function dlf_control_cancel()
function dlf_button_cancel($myDataView, $myId) {
// $myDataview > the target dataview to switch to after cancelation
// $myId > the id of the current data item 

	return "<button class=\"btn btn-sm btn-custom\" type=\"submit\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_CANCEL . "\" alt=\"" . DLF_BUTTON_CANCEL . "\" onclick=\"dlf_control_cancel('" . $myDataView . "'," . $myId . ")\"><span class=\"glyphicon glyphicon-menu-left\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_CANCEL . " </span></button>";
	
}


// function for a button to switch to another module (without any action)
// the function is making use of the js function dlf_switch_module()
function dlf_button_return_switch_module($myModule, $myButtonText) {
// $myModule > the target module to switch to
// $myButtonText > text on the button

	return "<button class=\"btn btn-custom\" type=\"button\" value=\"" . $myButtonText . "\" onclick=\"dlf_switch_module('" . $myModule . "')\">";
	
}


// function for a button to switch to another module (without any action)
// the function is making use of the js function dlf_switch_module()
function dlf_button_switch_module($myModule, $myButtonText) {
// $myModule > the target module to switch to
// $myButtonText > text on the button

	echo "<button class=\"btn btn-custom\" type=\"button\" value=\"" . $myButtonText . "\" onclick=\"dlf_switch_module('" . $myModule . "')\">";
	
}

// function for a button to switch to another dataview (without any action)
// the function is making use of the js function dlf_switch_dataview()
function dlf_button_switch_dataview($myDataView, $myButtonText) {
// $myDataview > the target dataview to switch to
// $myButtonText > text on the button

	return "<button class=\"btn btn-sm btn-custom\" type=\"button\" data-toggle=\"tooltip\" title=\"" . $myButtonText . "\" alt=\"" . $myButtonText . "\" onclick=\"dlf_switch_dataview('" . $myDataView . "')\">" . $myButtonText . "</button>";
	
}


// function for a button to switch back to list view (without any action)
// the function is making use of the js function dlf_switch_dataview()
//function dlf_button_switch_dataview_back_list($myDataView) {
// $myDataview > the target dataview to switch to

//	return "<div class=\"btn-group\" role=\"group\" aria-label=\"" . DLF_BUTTON_BACK_LIST . "\"><button class=\"btn btn-sm btn-custom\" type=\"button\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_BACK_LIST . "\" alt=\"" . DLF_BUTTON_BACK_LIST . "\"><span class=\"glyphicon glyphicon-menu-left\"></span></button><button class=\"btn btn-sm btn-custom\" type=\"button\" data-toggle=\"tooltip\" title=\"" . DLF_BUTTON_BACK_LIST . "\" alt=\"" . DLF_BUTTON_BACK_LIST . "\" onclick=\"dlf_switch_dataview('" . DLF_BUTTON_BACK_LIST . "')\"><span class=\"glyphicon glyphicon-list\"></span><span class=\"empty-for-mobile\"> " . DLF_BUTTON_BACK_LIST . " </span></button></div>";
	
//}


// function for a button to submit the form and to start an action
// the function is making use of the js function dlf_control()
function dlf_button_return_action($myModule, $myDataView, $myId, $myAction, $myButtonText) {
// $myModule > the current module
// $myDataview > the target dataview to switch to
// $myId > the id of the current data item 
// $myAction > the action which should be started "create"/"update"/"delete"
// $myButtonText > text on the button

	return "<input class=\"btn btn-default btn-sm btn-custom\" type=\"submit\" value=\"" . $myButtonText . "\" onclick=\"dlf_control('" . $myModule . "','" . $myDataView . "'," . $myId . ",'" . $myAction . "')\">";

}


// function for a button to submit the form and to start an action
// the function is making use of the js function dlf_control()
function dlf_button_action($myModule, $myDataView, $myId, $myAction, $myButtonText) {
// $myModule > the current module
// $myDataview > the target dataview to switch to
// $myId > the id of the current data item 
// $myAction > the action which should be started "create"/"update"/"delete"
// $myButtonText > text on the button

	echo "<button class=\"btn btn-custom\" type=\"submit\" value=\"" . $myButtonText . "\" onclick=\"dlf_control('" . $myModule . "','" . $myDataView . "'," . $myId . ",'" . $myAction . "')\">";

}

// NOT YET FINALLY DEFINED
// function for a button to launch an launch a script (without any action)
function dlf_button_script($myURL, $myTarget, $myButtonText) {
// $myURL > URL of the script
// $myTarget > open in same (_self) or new (_blank) window
// $myButtonText > text on the button

	echo "<button class=\"btn btn-custom\" type=\"button\" value=\"" . $myButtonText . "\" onclick=\"window.location.href='" . $myURL . "'\">";
	
}

*/

?>
