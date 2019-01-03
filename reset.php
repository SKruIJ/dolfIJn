<?php

/****************************************
dolfIJn
SKruIJ 2017-12-06
reset.php
reseting all session variables
ü
****************************************/

// set #key for secured identification of other php scripts (to avoid a stand alone request of php scripts)
define("DLF_SECURE_KEY", "dolfIJn2015");

// configuration files required
require("engine/config/config.php");
require("app/engine/config/config.php");

session_start();

// 20171206_SKruIJ: Session Ende added
$_SESSION = array();
session_unset();
session_destroy();

session_start();

session_write_close();
header("Location: index.php");
exit;
?>
