<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-27
modules/xform/dataviews/confirm.php
dataview confirm as example
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// a function to generate a banner in case of a public form
echo(dlf_public_banner("public_banner_1024.png"));

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_CONFIRM_SUBHEADER));

// a function to generate an intro para
echo(dlf_intro(MOD_CONFIRM_INTRO));


// a function to generate a vertical space between the paras
echo(dlf_vspace());


echo "<div class=\"panel panel-default\">";
echo "<table class=\"table\">";
echo "<tr><td>" . MOD_FIELD_LABEL_CATEGORY . "</td><td><strong>" . dlf_htmlout($dlf_form_values["kategorie"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_ADDRESS . "</td><td><strong>" . dlf_htmlout($dlf_form_values["anrede"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_NAME . "</td><td><strong>" . dlf_htmlout($dlf_form_values["name"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_FIRSTNAME . "</td><td><strong>" . dlf_htmlout($dlf_form_values["vorname"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_STREET . "</td><td><strong>" . dlf_htmlout($dlf_form_values["strasse"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_STREETNUMBER . "</td><td><strong>" . dlf_htmlout($dlf_form_values["hausnr"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_POSTCODE . "</td><td><strong>" . dlf_htmlout($dlf_form_values["plz"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_CITY . "</td><td><strong>" . dlf_htmlout($dlf_form_values["ort"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_EMAIL . "</td><td><strong>" . dlf_htmlout($dlf_form_values["email"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_ALTER . "</td><td><strong>" . dlf_htmlout($dlf_form_values["alter"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_KOMMENTAR . "</td><td><strong>" . dlf_htmlout($dlf_form_values["kommentar"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_TAC . "</td><td><strong>" . dlf_htmlout($dlf_form_values["tac"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_NEWSLETTER1 . "</td><td><strong>" . dlf_htmlout($dlf_form_values["newsletter1"]) . "</strong></td></tr>";
echo "<tr><td>" . MOD_FIELD_LABEL_NEWSLETTER2 . "</td><td><strong>" . dlf_htmlout($dlf_form_values["newsletter2"]) . "</strong></td></tr>";

echo "</table></div>";


echo(dlf_vspace());

$buttonarray = array(array("back", 1, "form"),array("send", 4, "send"));
echo(dlf_buttonwell($buttonarray));


?>