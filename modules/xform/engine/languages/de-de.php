<?php

/****************************************
dolfIJn
Module xform
SKruIJ 2018-11-30
modules/xform/engine/languages/de-de.php
module language file German
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// example:
// define("MOD_TERM", "Deutscher Text");

define("MOD_HEADER", "xform");
define("MOD_FORM_SUBHEADER", "Beispielmodul");
define("MOD_CONFIRM_SUBHEADER", "Bestätigung");
define("MOD_SEND_SUBHEADER", "Gesendet");

define("MOD_FORM_INTRO", "Dies ist nur ein kleiner Absatz als Einführung zu diesem Formular.<br><br>Bitte füllen Sie das Formular aus und klicken auf 'Weiter'.<br><br>Felder mit einem * sind Pflichtfelder.");
define("MOD_CONFIRM_INTRO", "Bitte kontrolieren Sie noch einmal Ihre Eingaben bevor Sie sie durch Klicken auf 'Senden' abschicken.<br><br>Klicken Sie dagegen auf 'Zurück' wenn sie Ihre Eingaben korrigieren möchten.");
define("MOD_SEND_INTRO", "Vielen Dank für Ihre Eingaben.");
define("MOD_SEND_TEXT", "Eine Bestätigungsemail wurde an die folgende Email-Adresse verschickt:");
define("MOD_SEND_ERROR", "Ihre Daten wurden leider nicht korrekt erfasst. Bitte versuchen Sie es noch einmal.");

define("MOD_MESSAGE_CREATE", "Ihre Daten wurden erfolgreich gespeichert.");
define("MOD_ERROR_CREATE", "Entschuldigung. Leider ist beim Speichern Ihrer Daten ein Fehler aufgetreten.");

define("MOD_FIELD_LABEL_CATEGORY","Kategorie");
define("MOD_FIELD_VALUE1_CATEGORY","Mitarbeiter");
define("MOD_FIELD_VALUE2_CATEGORY","Kunde");
define("MOD_FIELD_VALUE3_CATEGORY","Lieferant");
define("MOD_FIELD_ERR_CATEGORY","Bitte wählen Sie eine Kategorie");
define("MOD_FIELD_LABEL_ADDRESS","Anrede");
define("MOD_FIELD_PLACEHOLDER_ADDRESS","bitte was auswählen");
define("MOD_FIELD_VALUE1_ADDRESS","Herr");
define("MOD_FIELD_VALUE2_ADDRESS","Frau");
define("MOD_FIELD_ERR_ADDRESS","Bitte wählen Sie eine Anrede");
define("MOD_FIELD_LABEL_NAME","Name");
define("MOD_FIELD_PLACEHOLDER_NAME","Name");
define("MOD_FIELD_ERR_NAME","Bitte geben Sie einen Namen an");
define("MOD_FIELD_LABEL_FIRSTNAME","Vorname");
define("MOD_FIELD_PLACEHOLDER_FIRSTNAME","Vorname");
define("MOD_FIELD_LABEL_STREET","Straße");
define("MOD_FIELD_PLACEHOLDER_STREET","Straße");
define("MOD_FIELD_LABEL_STREETNUMBER","Nr");
define("MOD_FIELD_PLACEHOLDER_STREETNUMBER","Nr");
define("MOD_FIELD_LABEL_POSTCODE","PLZ");
define("MOD_FIELD_PLACEHOLDER_POSTCODE","PLZ");
define("MOD_FIELD_LABEL_CITY","Ort");
define("MOD_FIELD_PLACEHOLDER_CITY","Ort");
define("MOD_FIELD_LABEL_EMAIL","Email");
define("MOD_FIELD_PLACEHOLDER_EMAIL","Email");
define("MOD_FIELD_LABEL_ALTER","Alter");
define("MOD_FIELD_PLACEHOLDER_ALTER","Alter");
define("MOD_FIELD_LABEL_KOMMENTAR","Kommentar");
define("MOD_FIELD_PLACEHOLDER_KOMMENTAR","Kommentar");
define("MOD_FIELD_ERR_KOMMENTAR","Bitte geben Sie einen Kommentar an");

define("MOD_FIELD_LABEL_TAC","Ich willige hiermit in die Nutzungsbedingungen ein. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. ");
define("MOD_FIELD_TITLE_TAC","Nutzungsbedingungen");
define("MOD_FIELD_ERR_TAC","Bitte bestätigen Sie, dass Sie in die Nutzungsbedingungen einwilligen");
define("MOD_FIELD_LABEL_NEWSLETTER1","Ich bin an dem Newsletter 1 interessiert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. Außerdem steht hier noch ganz viel Text um zu testen, dass auch mit viel Text das layout funktioniert. ");
define("MOD_FIELD_LABEL_NEWSLETTER2","Ich bin an dem Newsletter 2 interessiert.");




define("MOD_EMAIL_CONFIRMATION_SUBJECT", "Registrierungs-Bestätigung");
define("MOD_EMAIL_CONFIRMATION_ADDRESS", "Hallo");
define("MOD_EMAIL_CONFIRMATION_TEXT", "wir bestätigen hiermit Ihre Registrierung.<br>Die folgenden Daten von Ihnen wurden gespeichert:");
define("MOD_EMAIL_CONFIRMATION_GREETING", "Ihr Administrator");

define("MOD_VAL_ISALTER", "Bitte ganzzahligen Wert für Alter eingeben");
define("MOD_VAL_CHECKEDNEWS1", "Der Newsletter 1 muss angefordert werden");


?>
