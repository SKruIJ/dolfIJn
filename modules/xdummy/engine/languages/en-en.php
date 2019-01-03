<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-11-30
modules/xdummy/engine/languages/en-en.php
module language file English
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "English text");

define("MOD_HEADER", "xdummy");
define("MOD_LIST_SUBHEADER", "Example module for a simple data administration module working in standard method");
define("MOD_LIST_INTRO", "This is just a little para as introduction to this example module.<br><br>It starts with a list of current stored data items. New data items can be created and existing ones can be updated or deleted.");
define("MOD_ITEM_SUBHEADER", "Example module with create action");
define("MOD_ITEM_INTRO", "The input has been saved. Saved input displayed below (queried from DB).");

define("MOD_NEW_ERROR", "Your data has not been saved correctly. Please try again.");
define("MOD_LIST_ERROR", "Oops, something went wrong...");

define("MOD_FIELD_LABEL_FAMILYNAME","Family Name");
define("MOD_FIELD_PLACEHOLDER_FAMILYNAME","Family Name");
define("MOD_FIELD_LABEL_FIRSTNAME","First Name");
define("MOD_FIELD_PLACEHOLDER_FIRSTNAME","First Name");

define("MOD_BUTTON_DEFAULT", "Further input");

define("MOD_VAL_ISALTER", "Please enter integer value for the age");

?>
