<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-30
modules/xform/engine/languages/en-en.php
module language file English
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "English text");

define("MOD_HEADER", "xform");
define("MOD_FORM_SUBHEADER", "Example module");
define("MOD_CONFIRM_SUBHEADER", "Confirmation");
define("MOD_SEND_SUBHEADER", "Send");

define("MOD_FORM_INTRO", "This is just a little para as introduction to this form example.<br><br>Please fill the form and click 'Next'.<br><br>Fields with * are mandatory.");
define("MOD_CONFIRM_INTRO", "Please check again your input before sending them by clicking on 'Send'.<br><br>Please click on 'Back' in case you want to correct your input.");
define("MOD_SEND_INTRO", "Thank you for your input.");
define("MOD_SEND_TEXT", "A confirmation email has been sent to the following email address:");
define("MOD_SEND_ERROR", "Your data has not been saved correctly. Please try again.");



define("MOD_MESSAGE_CREATE", "Your data have been successfully stored.");
define("MOD_ERROR_CREATE", "Sorry, unfortunately an error occured while storing your data.");

define("MOD_FIELD_LABEL_CATEGORY","Category");
define("MOD_FIELD_VALUE1_CATEGORY","Employee");
define("MOD_FIELD_VALUE2_CATEGORY","Customer");
define("MOD_FIELD_VALUE3_CATEGORY","Supplier");
define("MOD_FIELD_ERR_CATEGORY","Please select a category");
define("MOD_FIELD_LABEL_ADDRESS","Address");
define("MOD_FIELD_PLACEHOLDER_ADDRESS","please select");
define("MOD_FIELD_VALUE1_ADDRESS","Mr");
define("MOD_FIELD_VALUE2_ADDRESS","Mrs");
define("MOD_FIELD_ERR_ADDRESS","Please select an address");
define("MOD_FIELD_LABEL_NAME","Name");
define("MOD_FIELD_PLACEHOLDER_NAME","Name");
define("MOD_FIELD_ERR_NAME","Please fill a name");
define("MOD_FIELD_LABEL_FIRSTNAME","First Name");
define("MOD_FIELD_PLACEHOLDER_FIRSTNAME","First Name");
define("MOD_FIELD_LABEL_STREET","Street");
define("MOD_FIELD_PLACEHOLDER_STREET","Street");
define("MOD_FIELD_LABEL_STREETNUMBER","No");
define("MOD_FIELD_PLACEHOLDER_STREETNUMBER","No");
define("MOD_FIELD_LABEL_POSTCODE","Postcode");
define("MOD_FIELD_PLACEHOLDER_POSTCODE","Postcode");
define("MOD_FIELD_LABEL_CITY","City");
define("MOD_FIELD_PLACEHOLDER_CITY","City");
define("MOD_FIELD_LABEL_EMAIL","Email");
define("MOD_FIELD_PLACEHOLDER_EMAIL","Email");
define("MOD_FIELD_LABEL_ALTER","Age");
define("MOD_FIELD_PLACEHOLDER_ALTER","Age");
define("MOD_FIELD_LABEL_KOMMENTAR","Comment");
define("MOD_FIELD_PLACEHOLDER_KOMMENTAR","Comment");
define("MOD_FIELD_ERR_KOMMENTAR","Please fill a comment");

define("MOD_FIELD_LABEL_TAC","I agree with the terms and conditions. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. ");
define("MOD_FIELD_TITLE_TAC","Terms and conditions");
define("MOD_FIELD_ERR_TAC","Please confirm that you agree with the terms and conditions");
define("MOD_FIELD_LABEL_NEWSLETTER1","I'm interested in newsetter 1. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. ");
define("MOD_FIELD_LABEL_NEWSLETTER2","I'm interested in newsetter 2.");


define("MOD_EMAIL_CONFIRMATION_SUBJECT", "Confirmation of your registration");
define("MOD_EMAIL_CONFIRMATION_ADDRESS", "Hello");
define("MOD_EMAIL_CONFIRMATION_TEXT", "we confirm your registration.<br>The following data from you have been stored:");
define("MOD_EMAIL_CONFIRMATION_GREETING", "Your adminstrator");

define("MOD_VAL_ISALTER", "Please enter integer value for the age");
define("MOD_VAL_CHECKEDNEWS1", "The Newsletter 1 must be ordered");

?>
