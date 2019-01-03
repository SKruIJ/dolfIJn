<?php

/****************************************
dolfIJn
SKruIJ 2017-10-17
index.php
it's were everything starts :-)
ü
****************************************/

// set #key for secured identification of other php scripts (to avoid a stand alone request of php scripts)
define("DLF_SECURE_KEY", "dolfIJn2015");

// MVC

// C
// Start the #engine (including configuration, loading libraries, classes, languages)
// strictly no html output in this part
if (file_exists("engine/start.php")) {
	require("engine/start.php");
} else {
	exit('DLF-ERROR 01-01');
}

// M
// #action part which inlcudes transactions or other less database focused actions (eg sending emails)
// still strictly no html output in this part
if (file_exists("actions/action.php")) {
	require("actions/action.php");
} else {
	exit('DLF-ERROR 01-02');
}


// V
// Generate #page , where the html output starts
if (file_exists("screens/page.php")) {
	require("screens/page.php");
} else {
	exit('DLF-ERROR 01-03');
}

?>
