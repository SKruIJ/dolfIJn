<?php

/****************************************
dolfIJn
SKruIJ 2018-12-11
/engine/libraries/input.php
input form functions
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");


// CHECKED / MANUAL
// function to build the jquery function for form validation based on input from input functions
function dlf_form_validation_builder($myFieldName, $myInputPara = array(), $myFieldNumber) {
// initialised by $myFieldName == ""
// $myFieldName > unique name as identifier of the input field
// $myInputPara > array expected as input with several optional array items
// "label" > optional / label text, if not defined a label won't be displayed
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "maxlength" > optional / defines if there is a limit for the max length of the input string
// "minlength" > optional / defines if there is a limit for the min length of the input string
// "required" > optional / defins if the input field expects a required input
// "equalTo" > optional / define if the input of a field has to be equal to the input of another field (fieldname as parameter)
// "error_msg" > optional / define an individual error message overruling the standard message
// $myFieldNumber > the field number in the form to distinguidh between the first and further


	
	global $dlf_form_validation_jquery;
	global $dlf_form_validation_msg;
	global $dlf_form_validation_jquery_final;

	
	if ($myFieldName == "") {
	// initialising
		/*
		$dlf_form_validation_jquery = "<script type=\"text/javascript\">
				$(\"#dlf_form\").validate({
					submitHandler: function(form) {
						if(document.getElementById('dlf_action').value == 'del00') {
							$(\"#dlf_delete_confirm\").modal();
						} else if(document.getElementById('dlf_action').value == 'upd00' && document.getElementById('dlf_edit_mode').value == 'unchanged') {
						
						} else if(document.getElementById('dlf_action').value == 'cre00' && document.getElementById('dlf_edit_mode').value == 'unchanged') {
						
						} else {
							form.submit();
							document.getElementById('dlf_loading').style.display = 'block';
						}
					},
					rules: { ";

		*/
		$dlf_form_validation_jquery = "
			<script type=\"text/javascript\">
				$(\"#dlf_form\").validate({
					submitHandler: function(form) {
						if(document.getElementById('dlf_action').value == 'del00') {
							$(\"#dlf_delete_confirm\").modal();
						} else if(document.getElementById('dlf_action').value == 'upd00' && document.getElementById('dlf_edit_mode').value == 'unchanged') {
										
						} else {
							form.submit();
							document.getElementById('dlf_loading').style.display = 'block';
						}
					},
					rules: {
		";

	} else {
		
		// for each field the rules and the potential error message are added
		if ($myFieldNumber == 1) {
			$dlf_form_validation_jquery .= dlf_form_field_validation($myFieldName, $myInputPara);
			$dlf_form_validation_msg .= dlf_form_field_validation_msg($myFieldName, $myInputPara);
		} else {
			// further fields in the form (starting with ,)
			$dlf_form_validation_jquery .= ", " . dlf_form_field_validation($myFieldName, $myInputPara);
			$dlf_form_validation_msg .= dlf_form_field_validation_msg($myFieldName, $myInputPara);			
		}
	}
	
	$dlf_form_validation_add = " , errorElement: 'div' , errorPlacement: function(error, element) { if ( element.prop( \"type\" ) === \"checkbox\" ) { error.insertAfter( element.parent( \"label\" ) ); } else if ( element.prop( \"type\" ) === \"radio\" ) { error.appendTo( element.parents ( '.errcon' ) ); } else { error.insertAfter ( element ); } }";
	
	$dlf_form_validation_jquery_final = $dlf_form_validation_jquery . " }, messages: { " .  $dlf_form_validation_msg  . " } " . $dlf_form_validation_add . "});</script>";
    
}


// CHECKED / MANUAL
// function to add the field specific validation requirements into the whole jquery function / called from dlf_form_validation_builder
function dlf_form_field_validation($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field / has to correspond with field name defined in mds
// $myInputPara > array expected as input with several optional array items
// "label" > optional / label text, if not defined a label won't be displayed
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "maxlength" > optional / defines if there is a limit for the max length of the input string
// "minlength" > optional / defines if there is a limit for the min length of the input string
// "required" > optional / defins if the input field expects a required input
// "equalTo" > optional / define if the input of a field has to be equal to the input of another field (fieldname as parameter)


	global $dlf_modules;

	
	$field_requirements = "";
	$flag = 0;

	
	$field_requirements .= $myFieldName . ":{ ";
// minlength, email, required, equalTo, specific ones	
	
		// specific validation method for jQuery validator from the app / not mandatory
		if (file_exists("engine/libraries/validation.php")) {
			require("engine/libraries/validation.php");
		} else {
			exit('DLF-ERROR 10-01');
		}

		// specific validation method for jQuery validator from the app / not mandatory
		if (file_exists("app/engine/libraries/validation.php")) {
			require("app/engine/libraries/validation.php");
		}

		// specific validation method for jQuery validator from the module / not mandatory
		if (file_exists("modules/" . $dlf_modules . "/engine/libraries/validation.php")) {
			require("modules/" . $dlf_modules . "/engine/libraries/validation.php");
		}

		if (isset($myInputPara["equalTo"])) {
			if ($flag == 1) {
				$field_requirements .= " , ";
			}
			$flag = 1;
			$field_requirements .= " equalTo: \"#" . $myInputPara["equalTo"] . "\" ";
		}
		
		if (isset($myInputPara["required"])) {
			if ($flag == 1) {
				$field_requirements .= " , ";
			}
			$flag = 1;
			$field_requirements .= " required: true ";
		}
	
		if (isset($myInputPara["minlength"])) {
			if ($flag == 1) {
				$field_requirements .= " , ";
			}
			$flag = 1;
			$field_requirements .= " minlength: " . $myInputPara["minlength"] ;
		}
		
	$field_requirements .= " }";
			
	return $field_requirements;

}


// CHECKED / MANUAL
// function to add the field specific error message for validation into the whole jquery function / called from dlf_form_validation_builder
function dlf_form_field_validation_msg($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field / has to correspond with field name defined in mds
// $myInputPara > array expected as input with several optional array items
// relevant here only
// "error_msg" > optional / define an individual error message overruling the standard message

	
	$field_error_msg = "";
	
	if (isset($myInputPara["error_msg"])) {
		$field_error_msg .= $myFieldName . ": \"";
		$field_error_msg .= $myInputPara["error_msg"];
		$field_error_msg .=  "\" , ";
	}
	
	
	return $field_error_msg;

}



// CHECKED / MANUAL
// function for a text input field
function dlf_input_text($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputPara > array expected as input with several optional array items
// "label" > optional / label text, if not defined a label won't be displayed
// "placeholder" > optional / placeholder text
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "maxlength" > optional / defines if there is a limit for the max length of the input string
// "minlength" > optional / defines if there is a limit for the min length of the input string
// "required" > optional / defins if the input field expects a required input


	global $dlf_form_values;
	global $dlf_edit_number_fields;

	
	// setting of the field value / either already set (from previous view by session) or defined as default value
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["value"])) {
			$dlf_form_values[$myFieldName] = $myInputPara["value"];
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			//$dlf_form_values[$myFieldName] = "";
			$formvalue = "";
		}
	}
	if ($formvalue == "") {
		$valueparameter = "";
	} else {
		$valueparameter = " value=\"" . $formvalue . "\" ";
	}
	
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	//each input function has to call the form validation builder function
	dlf_form_validation_builder($myFieldName, $myInputPara, $myFieldNumber);


	if (isset($myInputPara["required"])) {
		if (isset($myInputPara["label"])) {
			$labelmandatoryparameter = "*";
			$postmandatoryparameter = "";
		} else {
			$labelmandatoryparameter = "";
			$postmandatoryparameter = "*";
		}
	} else {
		$labelmandatoryparameter = "";
		$postmandatoryparameter = "";
	}

	if (isset($myInputPara["label"])) {
		$labelparameter = " <label class=\"control-label\" for=\"" . $myFieldName . "\">" . $myInputPara["label"] . "</label> ";
	} else {
		$labelparameter = "";
	}

	if (isset($myInputPara["placeholder"])) {
		$placeholderparameter = " placeholder=\"" . $myInputPara["placeholder"] . "\" ";
	} else {
		$placeholderparameter = "";
	}

	if (isset($myInputPara["maxlength"])) {
		$maxlengthparameter = " maxlength=\"" . $myInputPara["maxlength"] . "\" ";
	} else {
		$maxlengthparameter = "";
	}

	if (isset($myInputPara["autofocus"])) {
		$autofocusparameter = " autofocus ";
	} else {
		$autofocusparameter = "";
	}

	return "<div class=\"form-group\">" . $labelparameter . $labelmandatoryparameter . "<input class=\"form-control \" form=\"dlf_form\" id=\"" . $myFieldName . "\" type=\"text\" name=\"" . $myFieldName . "\" " . $placeholderparameter . $valueparameter . $maxlengthparameter . $autofocusparameter . " onchange=\"dlf_change_mode()\">" . $postmandatoryparameter . "</div>";

}


// CHECKED / MANUAL
// function for a textarea input field
function dlf_input_textarea($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputPara > array expected as input with several optional array items
// "label" > optional / label text, if not defined a label won't be displayed
// "placeholder" > optional / placeholder text
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "maxlength" > optional / defines if there is a limit for the max length of the input string
// "required" > optional / defins if the input field expects a required input
// "rows" > optional / number of display rows

	global $dlf_form_values;
	global $dlf_edit_number_fields;


	// setting of the field value / either already set (from previous view by session) or defined as default value
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["value"])) {
			$dlf_form_values[$myFieldName] = $myInputPara["value"];
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			//$dlf_form_values[$myFieldName] = "";
			$formvalue = "";
		}
	}
	if ($formvalue == "") {
		$valueparameter = "";
	} else {
		$valueparameter = $formvalue;
	}
	
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	//each input function has to call the form validation builder function
	dlf_form_validation_builder($myFieldName, $myInputPara, $myFieldNumber);



	if (isset($myInputPara["required"])) {
		if (isset($myInputPara["label"])) {
			$labelmandatoryparameter = "*";
			$postmandatoryparameter = "";
		} else {
			$labelmandatoryparameter = "";
			$postmandatoryparameter = "*";
		}
	} else {
		$labelmandatoryparameter = "";
		$postmandatoryparameter = "";
	}

	if (isset($myInputPara["label"])) {
		$labelparameter = " <label class=\"control-label\" for=\"" . "dlf_fieldid_" . $myFieldName . "\">" . $myInputPara["label"] . "</label> ";
	} else {
		$labelparameter = "";
	}

	if (isset($myInputPara["placeholder"])) {
		$placeholderparameter = " placeholder=\"" . $myInputPara["placeholder"] . "\" ";
	} else {
		$placeholderparameter = "";
	}

	if (isset($myInputPara["maxlength"])) {
		$maxlengthparameter = " maxlength=\"" . $myInputPara["maxlength"] . "\" ";
	} else {
		$maxlengthparameter = "";
	}

	if (isset($myInputPara["autofocus"])) {
		$autofocusparameter = " autofocus ";
	} else {
		$autofocusparameter = "";
	}

	if (isset($myInputPara["rows"])) {
		$rowsparameter = " rows=\"" . $myInputPara["rows"] . "\" ";
	} else {
		$rowsparameter = "";
	}

	
	return "<div class=\"form-group\">" . $labelparameter . $labelmandatoryparameter . "<textarea class=\"form-control\" " . $rowsparameter . " form=\"dlf_form\" id=\"" . $myFieldName . "\" name=\"" . $myFieldName . "\" " . $placeholderparameter . $maxlengthparameter . $autofocusparameter . " onchange=\"dlf_change_mode()\">" . $valueparameter . "</textarea></div>";
	
}


// CHECKED / MANUAL
// function for a single checkbox input field
function dlf_input_check_single($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputPara > array expected as input with several optional array items
// "checked" > defines if checkbox is checked or not
// "label" > optional / label text, shown behind checkbox, if not defined a label won't be displayed / if isChecked and no title defined the asterix is shown with the label
// "autofocus" > optional / defines if the autofocus is set on this input field
// "isChecked" > optional / defines if a checked box is expected (mandatory)
// "title" > optional / title text above checkbox / if title is defined and isChecked defined, the asterix is shown with the title, otherwise with the label
// "mandatory" > optional / to be defined to create asterix in case specific isCheckedxxx parameter is used for validation

	global $dlf_form_values;
	global $dlf_edit_number_fields;


	// setting of the field value / either already set (from previous view by session) or defined as default value
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["checked"])) {
			$dlf_form_values[$myFieldName] = 1;
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			$formvalue = 0;
		}
	}
	if ($formvalue == 1) {
		$checkedparameter = " checked ";
	} else {
		$checkedparameter = "";
	}
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	//each input function has to call the form validation builder function
	dlf_form_validation_builder($myFieldName, $myInputPara, $myFieldNumber);



	if (isset($myInputPara["isChecked"]) || isset($myInputPara["mandatory"])) {
		if (isset($myInputPara["label"]) || isset($myInputPara["title"])) {
			$labelmandatoryparameter = "*";
		} else {
			$labelmandatoryparameter = "";
		}
	} else {
		$labelmandatoryparameter = "";
	}

	$titleparameter = "";
	if (isset($myInputPara["title"])) {
		$titleparameter = $myInputPara["title"];	
	}
	
	$labelparameter = "";
	if (isset($myInputPara["label"])) {
		$labelparameter = $myInputPara["label"];	
	}
	
	
	if (isset($myInputPara["title"])) {
		$titleparameter .= $labelmandatoryparameter;
	} elseif (isset($myInputPara["label"])) {
		$labelparameter .= $labelmandatoryparameter;
	}
		
	if (isset($myInputPara["autofocus"])) {
		$autofocusparameter = " autofocus ";
	} else {
		$autofocusparameter = "";
	}
	
	$returnvalue = "";
	$returnvalue .= "<div class=\"checkbox boxcontainer\"><label class=\"checkbox\">";
	
	//$returnvalue .= "<input form=\"dlf_form\" type=\"hidden\" name=\"" . $myFieldName . "\" value=\"0\"><div class=\"checkbox\"><label><div>$titleparameter</div><input class=\"checkbox\" form=\"dlf_form\" type=\"checkbox\" id=\"" . $myFieldName . "\" name=\"" . $myFieldName . "\" value=\"1\" " . $checkedparameter . $autofocusparameter . " onchange=\"dlf_change_mode()\"> " . $labelparameter . " </label></div>";
	$returnvalue .= "<input form=\"dlf_form\" type=\"hidden\" name=\"" . $myFieldName . "\" value=\"0\"><div>$titleparameter</div><input class=\"checkbox\" form=\"dlf_form\" type=\"checkbox\" id=\"" . $myFieldName . "\" name=\"" . $myFieldName . "\" value=\"1\" " . $checkedparameter . $autofocusparameter . " onchange=\"dlf_change_mode()\"><label> " . $labelparameter . " </label>";
	$returnvalue .= "<span class=\"boxcheckmark\"></span>"; 
	$returnvalue .= "</label></div>";
	
	return $returnvalue;
	
}


// CHECKED / MANUAL
// function for a choice list with a defined list of values
function dlf_input_select($myFieldName, $myInputList = array(), $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputList > array as input with the list of values
// "value" > values which are transfered in the POST
// "title" > what is display in the form 
// $myInputPara > array expected as input with several optional array items
// "label" > optional / / label text, if not defined a label won't be displayed
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "required" > optional / defines if the input field expects a required input
// "placeholder" > optional / defines a value as selected and disabled / it overwrites given "value" definition
//
// if "required" is on, better not to make use of empty list item > a selected empty list item doesn't fulfil the requirement criteria
// if "required" is off, the placeholder could lead to unexpected behaviour > when no item is selected (still placeholder selected) the placeholder transfers empty value

	global $dlf_form_values;
	global $dlf_edit_number_fields;
	
	
	// setting of the field value / either already set (from previous view by session) or defined as default value
	
	$placeholderflag = 0;
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["value"])) {
			$dlf_form_values[$myFieldName] = $myInputPara["value"];
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			
			if (isset($myInputPara["placeholder"])) {
				$formvalue = $myInputPara["placeholder"];
				$placeholderflag = 1;
			} else {	
				$formvalue = "";
			}
		}
	}
	
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	//each input function has to call the form validation builder function
	dlf_form_validation_builder($myFieldName, $myInputPara, $myFieldNumber);
	

	if (isset($myInputPara["required"])) {
		if (isset($myInputPara["label"])) {
			$labelmandatoryparameter = "*";
		} else {
			$labelmandatoryparameter = "";
		}
	} else {
		$labelmandatoryparameter = "";
	}

	if (isset($myInputPara["label"])) {
		$labelparameter = $myInputPara["label"] . $labelmandatoryparameter;
	} else {
		$labelparameter = "";
	}
	
	if (isset($myInputPara["autofocus"])) {
		$autofocusparameter = " autofocus ";
	} else {
		$autofocusparameter = "";
	}
	

	$returnvalue = "";
	
	$returnvalue .= "<div class=\"form-group\"><label class=\"control-label\"> " . $labelparameter . " </label>";
	$returnvalue .= "<select form=\"dlf_form\" class=\"form-control\" id=\"" . $myFieldName . "\" name=\"" . $myFieldName . "\" size=\"1\"" . $autofocusparameter . " onchange=\"dlf_change_mode()\">";
	
	if ($placeholderflag == 1) {
		$returnvalue .= "<option value=\"" . $formvalue . "\" selected disabled>" . $formvalue . "</option>";
	}	
		
	foreach ($myInputList as $item) {
		if ($placeholderflag == 1) {
			$selectedparameter = "";
		} else {
			if ($formvalue == $item["value"]) {
				$selectedparameter = " selected ";
			} else {
				$selectedparameter = "";
			}
		}
		
		$returnvalue .= "<option value=\"" . $item["value"] . "\" " . $selectedparameter . " >" . $item["title"] . "</option>";
			
	}
	
	$returnvalue .= "</select></div>";
	
	return $returnvalue;
	
}

// CHECKED / MANUAL
// function for a group of radio buttons with a defined list of values
function dlf_input_radio($myFieldName, $myInputList = array(), $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputList > array as input with the list of values for the radio buttons with required fields:
// "value" > values which are transfered in the POST
// "title" > what is display in the form 
// $myInputPara > array expected as input with several optional array items
// "value" > optional / pre-defined value for input field
// "autofocus" > optional / defines if the autofocus is set on this input field
// "label" > optional / title text above radio buttons / if title is defined and required defined, the asterix is shown with the title, otherwise with the label
// "isRadioSelected" > optional / defines if the radio buttons expects a required selection
// "inline" > optional / defines if the radio buttons are display inline
// "disabled" > option can not been chosen

	global $dlf_form_values;
	global $dlf_edit_number_fields;

	// setting of the field value / either already set (from previous view by session) or defined as default value
	
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["value"])) {
			$dlf_form_values[$myFieldName] = $myInputPara["value"];
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			$formvalue = "";
		}
	}
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	//each input function has to call the form validation builder function
	dlf_form_validation_builder($myFieldName, $myInputPara, $myFieldNumber);
	
	
	if (isset($myInputPara["isRadioSelected"])) {
		if (isset($myInputPara["label"])) {
			$labelmandatoryparameter = "*";
		} else {
			$labelmandatoryparameter = "";
		}
	} else {
		$labelmandatoryparameter = "";
	}

	if (isset($myInputPara["label"])) {
		$labelparameter = $myInputPara["label"] . $labelmandatoryparameter;
	} else {
		$labelparameter = "";
	}
	
	if (isset($myInputPara["autofocus"])) {
		$autofocusparameter = " autofocus ";
	} else {
		$autofocusparameter = "";
	}

	if (isset($myInputPara["disabled"])) {
		$disabledparameter = " disabled ";
	} else {
		$disabledparameter = "";
	}
	
	
	$returnvalue = "";
	
	
	if (isset($myInputPara["inline"])) {
		$returnvalue .= "<div class=\"form-inline errcon\"><div><label class=\"control-label\"> " . $labelparameter . " </label></div>";
	} else {
		$returnvalue .= "<div class=\"form errcon\"><label class=\"control-label\"> " . $labelparameter . " </label>";
	}
	
	$returnvalue .= "<input form=\"dlf_form\" type=\"hidden\" name=\"" . $myFieldName . "\" value=\"0\">";
	
	foreach ($myInputList as $item) {
		if ($formvalue == $item["value"]) {
			$checkedparameter = "checked";
		} else {
			$checkedparameter = "";
		}
		
		$returnvalue .= "<div class=\"radio radiocontainer\"><label class=\"radio\">";
		
		$returnvalue .= "<input class=\"radio\" form=\"dlf_form\" type=\"radio\" name=\"" . $myFieldName . "\" id=\"" . $myFieldName . "_". $item["value"] . "\" value=\"" . $item["value"] . "\" " . $checkedparameter . $autofocusparameter . $disabledparameter . "  onchange=\"dlf_change_mode()\">";
		$returnvalue .= "&nbsp;" . $item["title"] . "&nbsp;";
		$returnvalue .= "<span class=\"radiocheckmark\"></span>"; 
		$returnvalue .= "</label></div>";
		
		
	}
	
	$returnvalue .= "</div>";
	
	return $returnvalue;
	
		
}


// CHECKED / MANUAL
// function for a hidden input field
function dlf_input_hidden($myFieldName, $myInputPara = array()) {
// $myFieldName > unique name as identifier of the input field
// $myInputPara > array expected as input with several optional array items
// "value" > optional / pre-defined value for input field


	global $dlf_form_values;
	global $dlf_edit_number_fields;

	
	// setting of the field value / either already set (from previous view by session) or defined as default value
	if(isset($dlf_form_values[$myFieldName])) {
		$formvalue = $dlf_form_values[$myFieldName];
	} else {
		if (isset($myInputPara["value"])) {
			$dlf_form_values[$myFieldName] = $myInputPara["value"];
			$formvalue = $dlf_form_values[$myFieldName];
		} else {
			//$dlf_form_values[$myFieldName] = "";
			$formvalue = "";
		}
	}
	if ($formvalue == "") {
		$valueparameter = "";
	} else {
		$valueparameter = " value=\"" . $formvalue . "\" ";
	}
	
	
	// each input function has to increase the global number of input fields by 1
	$dlf_edit_number_fields += 1;
	$myFieldNumber = $dlf_edit_number_fields;
	
	return "<input form=\"dlf_form\" id=\"" . $myFieldName . "\" type=\"hidden\" name=\"" . $myFieldName . "\" " . $valueparameter . " >";

}



/*********************************************************************/
/*********************************************************************/
/*********************************************************************/


/*
function dlf_input_password($dlf_input, $dlf_mds_field) {
// $dlf_input_fieldname > Label für das Feld
// $dlf_input_field_id > eindeutige ID für das Feld
// $dlf_input_maxlength > maximale Zeichenlänge für die Eingabe in das Feld (sollte mit DB korrespondieren) / wenn 0, dann kein Limit
// $dlf_input_value > vorbelegter Wert für das Feld
// $dlf_input_mandatory > 1 = Pflichtfeld / 0 = kein Pflichtfeld
	
	global $dlf_edit_number_fields;
	global $dlf_edit_mandatory;

	$dlf_edit_number_fields += 1;
	
	if (is_array($dlf_input)) {
		$dlf_input_value = $dlf_input[DLF_MOD_TABLE . "_" . $dlf_mds_field["name"]];
	} else {
		$dlf_input_value = $dlf_input;
	}
	
	$dlf_maxlength_parameter = "";
	if ($dlf_mds_field["maxlength"] > 0) {
		$dlf_maxlength_parameter = " maxlength = \"" . $dlf_mds_field["maxlength"] . "\"";
	}
	
	$dlf_autofocus_parameter ="";
	if ($dlf_edit_number_fields == 1) {
		$dlf_autofocus_parameter = " autofocus";
	}
	
	$dlf_mandatory_indicator ="";
	if ($dlf_mds_field["mandatory"] > 0) {
		$dlf_mandatory_indicator = "*";
		//array_push($dlf_edit_mandatory, $dlf_input_field_id); 	
	}
	
	echo "<div><label for=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\">" . $dlf_mds_field["label"] . $dlf_mandatory_indicator . "</label><input form=\"dlf_form\" id=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\" type=\"password\" name=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\" value=\"" . $dlf_input_value . "\"" . $dlf_maxlength_parameter . $dlf_autofocus_parameter . " onchange=\"dlf_change_mode()\"></div>";

}
*/

/*
function dlf_input_date($dlf_input, $dlf_mds_field) {
// $dlf_input_fieldname > Label für das Feld
// $dlf_input_field_id > eindeutige ID für das Feld
// $dlf_input_maxlength > maximale Zeichenlänge für die Eingabe in das Feld (sollte mit DB korrespondieren) / wenn 0, dann kein Limit
// $dlf_input_value > vorbelegter Wert für das Feld
// $dlf_input_mandatory > 1 = Pflichtfeld / 0 = kein Pflichtfeld

	global $dlf_edit_number_fields;
	global $dlf_edit_mandatory;

	$dlf_edit_number_fields += 1;
	
	if (is_array($dlf_input)) {
		$dlf_input_value = $dlf_input[DLF_MOD_TABLE . "_" . $dlf_mds_field["name"]];
	} else {
		$dlf_input_value = $dlf_input;
	}
	
	$dlf_maxlength_parameter = "";
	// maxlength doesn't make sense for date
	// if ($dlf_mds_field["maxlength"] > 0) {
	//	 $dlf_maxlength_parameter = " maxlength = \"" . $dlf_mds_field["maxlength"] . "\"";
	// }
	
	
	$dlf_autofocus_parameter ="";
	if ($dlf_edit_number_fields == 1) {
		$dlf_autofocus_parameter = " autofocus";
	}
	
	$dlf_mandatory_indicator ="";
	if ($dlf_mds_field["mandatory"] > 0) {
		$dlf_mandatory_indicator = "*";
		//array_push($dlf_edit_mandatory, $dlf_input_field_id); 	
	}
	
	echo "<div><label for=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\">" . $dlf_mds_field["label"] . $dlf_mandatory_indicator . "</label><br><input class=\"inputdate\" form=\"dlf_form\" id=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\" type=\"date\" name=\"dlf_fieldid_" . $dlf_mds_field["name"] . "\" value=\"" . $dlf_input_value . "\"" . $dlf_maxlength_parameter . $dlf_autofocus_parameter . " onchange=\"dlf_change_mode()\"></div>";

}
*/




?>
