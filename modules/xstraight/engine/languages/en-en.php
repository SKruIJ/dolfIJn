<?php

/****************************************
dolfIJn
Module straight
SKruIJ 2017-12-01
modules/straight/engine/languages/en-en.php
module language file English
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "English text");

define("MOD_HEADER", "xstraight");
define("MOD_SUBHEADER", "Example module");

define("MOD_VISIBLE_ONLY_ADMIN", "This part of the example is only visible for admins.");
define("MOD_VISIBLE_ONLY_WRITE", "This part of the example is only visible for users with at least write access.");
define("MOD_VISIBLE_ONLY_READ", "This part of the example is only visible for users with at least read access.");
define("MOD_VISIBLE_PUBLIC", "This part of the example is visible even for public users.");
define("MOD_INTRO", "This module is just an example for a straight module. It shows a kind of dashboard and demonstrates different access levels.");
define("MOD_NUMBER_ITEMS", "Number of items");
define("MOD_ACCESS_RIGHTS", "The current user has the following access rights on this moodule");


?>
