<?php

/****************************************
dolfIJn
Module straight
SKruIJ 2017-12-01
modules/straight/engine/languages/de-de.php
module language file German
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "Deutscher Text");

define("MOD_HEADER", "xstraight");
define("MOD_SUBHEADER", "Beispielmodul");

define("MOD_VISIBLE_ONLY_ADMIN", "Dieser Teil des Beispielmoduls ist nur für Administratoren (admin) sichtbar.");
define("MOD_VISIBLE_ONLY_WRITE", "Dieser Teil des Beispielmoduls ist nur für Benutzer mit mindestens Schreibrecht (write) sichtbar.");
define("MOD_VISIBLE_ONLY_READ", "Dieser Teil des Beispielmoduls ist nur für Benutzer mit mindestens Leserecht (read) sichtbar.");
define("MOD_VISIBLE_PUBLIC", "Dieser Teil des Beispielmoduls ist auch für öffentliche Benutzer (public) sichtbar.");
define("MOD_INTRO", "Dieses Modul ist nur ein Beispiel für ein straight module. Es stellt eine Art Dashboard dar und zeigt die verschiedenen Zugriffslevel auf.");
define("MOD_NUMBER_ITEMS", "Zahl der Einträge");
define("MOD_ACCESS_RIGHTS", "Der aktuelle Benutzer hat die folgenden Zugriffsrechte für dieses Modul");


?>
