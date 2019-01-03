<?php

/****************************************
dolfIJn
Module xdefault
SKruIJ 2018-11-05
/modules/xdefault/engine/config/config.php
module configuration // mandatory // used in /engine/start.php
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// version and release of the module
// YYYYMMDD = release date
// XX = Interim incrementer
define("MOD_VERSION", "2018112701");
// Human-friendly version name
define("MOD_RELEASE", "1.2.2");
// module method 'straight' or 'standard' / 'straight is not allowing certain functions related to actions and database functions
define("MOD_METHOD", "standard");
// allowed to access the module as public user (1) or not (0)
define("MOD_PUBLIC_ALLOWED", 0);
// module title, title of the module which is used by the application as identifier (used in the database)
define("MOD_TITLE", "xdefault");
// module description
define("MOD_DESCRIPTION", "Example for a module working in standard method, means minimum set-up for working with actions for database transactions");
// core site title, will be displayed as first part of the page title on each page // mandatory, used in /engine/libraries/head_creator.php
define("MOD_SITE_TITLE", "Default Module");
// copyright, will be displayed in the footer
define("MOD_COPYRIGHT", "2017-2018 SKruIJ");

// the default dataview the module starts with
define("MOD_DEFAULT_DATAVIEW", "new");

// hartes Delete (1) oder softes Delete / Deaktivieren (0)
define("DLF_MOD_DELETE", 0);

// Limit Wert für Pagination // 0 = Standard Pagination wird übernommen
define("MOD_PAGINATION_LIMIT", 0);

?>