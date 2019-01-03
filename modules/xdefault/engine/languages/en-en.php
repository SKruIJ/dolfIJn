<?php

/****************************************
dolfIJn
Module xdefault
SKruIJ 2018-11-21
modules/xdefault/engine/languages/en-en.php
module language file English
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "English text");

define("MOD_HEADER", "xdefault");
define("MOD_NEW_SUBHEADER", "Example module with create action");
define("MOD_NEW_INTRO", "This is just a little para as introduction to this example module with a create action .<br><br>Please fill the input fields and click 'Save'.<br><br>Fields with * are mandatory.");
define("MOD_ITEM_SUBHEADER", "Example module with create action");
define("MOD_ITEM_INTRO", "The input has been saved. Saved input displayed below (queried from DB).");

define("MOD_NEW_ERROR", "Your data has not been saved correctly. Please try again.");
define("MOD_ITEM_ERROR", "Oops, something went wrong...");

define("MOD_FIELD_LABEL_FAMILYNAME","Family Name");
define("MOD_FIELD_PLACEHOLDER_FAMILYNAME","Family Name");
define("MOD_FIELD_LABEL_FIRSTNAME","First Name");
define("MOD_FIELD_PLACEHOLDER_FIRSTNAME","First Name");

define("MOD_BUTTON_DEFAULT", "Further input");

?>
