<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-11-30
modules/xdummy/engine/languages/de-de.php
module language file German
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "Deutscher Text");

define("MOD_HEADER", "xdummy");
define("MOD_LIST_SUBHEADER", "Beispielmodul für eine einfache Daten-Administration in Standard Methode");
define("MOD_LIST_INTRO", "Das ist nur ein kleiner Absatz als Einführung zu diesem Beispielmodul.<br><br>Es fängt mit einer Liste aller vorhandenen Datensätze an. Neue Datensätze können angelegt werden und existierende können aktualisiert oder gelöscht werden.");
define("MOD_ITEM_SUBHEADER", "Example module with create action");
define("MOD_ITEM_INTRO", "The input has been saved. Saved input displayed below (queried from DB).");

define("MOD_NEW_ERROR", "Your data has not been saved correctly. Please try again.");
define("MOD_LIST_ERROR", "Entschuldigung, da ist was schief gelaufen...");

define("MOD_FIELD_LABEL_FAMILYNAME","Family Name");
define("MOD_FIELD_PLACEHOLDER_FAMILYNAME","Family Name");
define("MOD_FIELD_LABEL_FIRSTNAME","First Name");
define("MOD_FIELD_PLACEHOLDER_FIRSTNAME","First Name");

define("MOD_BUTTON_DEFAULT", "Further input");

define("MOD_VAL_ISALTER", "Bitte ganzzahligen Wert für Alter eingeben");

?>
