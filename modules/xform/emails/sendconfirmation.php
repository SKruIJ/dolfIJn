<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-04-03
modules/xform/emails/sendconfirmation.php
component sending the confirmation email for form
****************************************/

// ü check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$result = dlf_db_item_onetable("xform", $myID);

$email_from = "admin@kruijer-net.eu";
$email_fromname = "Administrator kruijer-net";
$email_address = $result["xform_email"];
$email_subject = MOD_EMAIL_CONFIRMATION_SUBJECT;
$email_body = "<table style=\"width:700px;padding:0 10px;\">";
$email_body .= "<tr><td><img src=\"" . substr($_SERVER['HTTP_REFERER'],0,-10) . "/modules/xform/emails/email_banner_720.png\"></td></tr>";
$email_body .= "<tr><td><div style=\"font-family:Arial;\"><br>";

$email_body .= "<p>" . MOD_EMAIL_CONFIRMATION_ADDRESS . " " . $result["xform_vorname"] . " " . $result["xform_name"] . ",</p>";
$email_body .= "<p>" . MOD_EMAIL_CONFIRMATION_TEXT . "</p>";
$email_body .= "<p>" . MOD_EMAIL_CONFIRMATION_GREETING . "</p>";

$email_body .= "<table>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_NAME . "</td><td><strong>" . dlf_htmlout($result["xform_name"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_FIRSTNAME . "</td><td><strong>" . dlf_htmlout($result["xform_vorname"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_STREET . "</td><td><strong>" . dlf_htmlout($result["xform_strasse"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_STREETNUMBER . "</td><td><strong>" . dlf_htmlout($result["xform_hausnr"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_POSTCODE . "</td><td><strong>" . dlf_htmlout($result["xform_plz"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_CITY . "</td><td><strong>" . dlf_htmlout($result["xform_ort"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_EMAIL . "</td><td><strong>" . dlf_htmlout($result["xform_email"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_ALTER . "</td><td><strong>" . dlf_htmlout($result["xform_alter"]) . "</strong></td></tr>";
$email_body .= "<tr><td>" . MOD_FIELD_LABEL_KOMMENTAR . "</td><td><strong>" . dlf_htmlout($result["xform_kommentar"]) . "</strong></td></tr>";

$email_body .= "</table>";


$email_body .= "</div></td></tr></table>";


$email_wordwrap = 40;


?>