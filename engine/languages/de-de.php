<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/engine/languages/de-de.php
main language file de-de
ü
****************************************/

 // check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// php-login > login & registration classes
define("DLF_MESSAGE_ACCOUNT_NOT_ACTIVATED", "Your account is not activated yet. Please click on the confirm link in the mail.");
define("DLF_MESSAGE_CAPTCHA_WRONG", "Captcha was wrong!");
define("DLF_MESSAGE_COOKIE_INVALID", "Invalid cookie");
define("DLF_MESSAGE_DATABASE_ERROR", "Database connection problem.");
define("DLF_MESSAGE_EMAIL_ALREADY_EXISTS", "This email address is already registered. Please use the \"I forgot my password\" page if you don't remember it.");
define("DLF_MESSAGE_EMAIL_CHANGE_FAILED", "Sorry, your email changing failed.");
define("DLF_MESSAGE_EMAIL_CHANGED_SUCCESSFULLY", "Your email address has been changed successfully. New email address is ");
define("DLF_MESSAGE_EMAIL_EMPTY", "Email cannot be empty");
define("DLF_MESSAGE_EMAIL_INVALID", "Your email address is not in a valid email format");
define("DLF_MESSAGE_EMAIL_SAME_LIKE_OLD_ONE", "Sorry, that email address is the same as your current one. Please choose another one.");
define("DLF_MESSAGE_EMAIL_TOO_LONG", "Email cannot be longer than 64 characters");
define("DLF_MESSAGE_LINK_PARAMETER_EMPTY", "Empty link parameter data.");
define("DLF_MESSAGE_LOGGED_OUT", "You have been logged out.");
// php-login > The "login failed"-message is a security improved feedback that doesn't show a potential attacker if the user exists or not
define("DLF_MESSAGE_LOGIN_FAILED", "Login failed.");
define("DLF_MESSAGE_OLD_PASSWORD_WRONG", "Your OLD password was wrong.");
define("DLF_MESSAGE_PASSWORD_BAD_CONFIRM", "Password and password repeat are not the same");
define("DLF_MESSAGE_PASSWORD_CHANGE_FAILED", "Sorry, your password changing failed.");
define("DLF_MESSAGE_PASSWORD_CHANGED_SUCCESSFULLY", "Password successfully changed!");
define("DLF_MESSAGE_PASSWORD_EMPTY", "Password field was empty");
define("DLF_MESSAGE_PASSWORD_RESET_MAIL_FAILED", "Password reset mail NOT successfully sent! Error: ");
define("DLF_MESSAGE_PASSWORD_RESET_MAIL_SUCCESSFULLY_SENT", "Password reset mail successfully sent!");
define("DLF_MESSAGE_PASSWORD_TOO_SHORT", "Password has a minimum length of 6 characters");
define("DLF_MESSAGE_PASSWORD_WRONG", "Wrong password. Try again.");
define("DLF_MESSAGE_PASSWORD_WRONG_3_TIMES", "You have entered an incorrect password 3 or more times already. Please wait 30 seconds to try again.");
define("DLF_MESSAGE_REGISTRATION_ACTIVATION_NOT_SUCCESSFUL", "Sorry, no such id/verification code combination here...");
define("DLF_MESSAGE_REGISTRATION_ACTIVATION_SUCCESSFUL", "Activation was successful! You can now log in!");
define("DLF_MESSAGE_REGISTRATION_FAILED", "Sorry, your registration failed. Please go back and try again.");
define("DLF_MESSAGE_RESET_LINK_HAS_EXPIRED", "Your reset link has expired. Please use the reset link within one hour.");
define("DLF_MESSAGE_VERIFICATION_MAIL_ERROR", "Sorry, we could not send you an verification mail. Your account has NOT been created.");
define("DLF_MESSAGE_VERIFICATION_MAIL_NOT_SENT", "Verification Mail NOT successfully sent! Error: ");
define("DLF_MESSAGE_VERIFICATION_MAIL_SENT", "Your account has been created successfully and we have sent you an email. Please click the VERIFICATION LINK within that mail.");
define("DLF_MESSAGE_USER_DOES_NOT_EXIST", "This user does not exist");
define("DLF_MESSAGE_USERNAME_BAD_LENGTH", "Username cannot be shorter than 2 or longer than 64 characters");
define("DLF_MESSAGE_USERNAME_CHANGE_FAILED", "Sorry, your chosen username renaming failed");
define("DLF_MESSAGE_USERNAME_CHANGED_SUCCESSFULLY", "Your username has been changed successfully. New username is ");
define("DLF_MESSAGE_USERNAME_EMPTY", "Username field was empty");
define("DLF_MESSAGE_USERNAME_EXISTS", "Sorry, that username is already taken. Please choose another one.");
define("DLF_MESSAGE_USERNAME_INVALID", "Username does not fit the name scheme: only a-Z and numbers are allowed, 2 to 64 characters");
define("DLF_MESSAGE_USERNAME_SAME_LIKE_OLD_ONE", "Sorry, that username is the same as your current one. Please choose another one.");
// php-login > screens
define("DLF_WORDING_PLEASE_SIGN_IN", "Bitte anmelden");
define("DLF_WORDING_BACK_TO_LOGIN", "Back to Login Page");
define("DLF_WORDING_CHANGE_EMAIL", "Change email");
define("DLF_WORDING_CHANGE_PASSWORD", "Change password");
define("DLF_WORDING_CHANGE_USERNAME", "Change username");
define("DLF_WORDING_CURRENTLY", "currently");
define("DLF_WORDING_EDIT_USER_DATA", "Edit user data");
define("DLF_WORDING_EDIT_YOUR_CREDENTIALS", "You are logged in and can edit your credentials here");
define("DLF_WORDING_FORGOT_MY_PASSWORD", "I forgot my password");
define("DLF_WORDING_WELCOME", "Moin");
define("DLF_WORDING_HOME", "Start");
define("DLF_WORDING_LOGIN", "Log in");
define("DLF_WORDING_LOGOUT", "Log out");
define("DLF_WORDING_NEW_EMAIL", "New email");
define("DLF_WORDING_NEW_PASSWORD", "New password");
define("DLF_WORDING_NEW_PASSWORD_REPEAT", "Repeat new password");
define("DLF_WORDING_NEW_USERNAME", "New username (username cannot be empty and must be azAZ09 and 2-64 characters)");
define("DLF_WORDING_OLD_PASSWORD", "Your OLD Password");
define("DLF_WORDING_PASSWORD", "Password");
define("DLF_WORDING_PROFILE_PICTURE", "Your profile picture (from gravatar):");
define("DLF_WORDING_REGISTER", "Register");
define("DLF_WORDING_REGISTER_NEW_ACCOUNT", "Register new account");
define("DLF_WORDING_REGISTRATION_CAPTCHA", "Please enter these characters");
define("DLF_WORDING_REGISTRATION_EMAIL", "User's email (please provide a real email address, you'll get a verification mail with an activation link)");
define("DLF_WORDING_REGISTRATION_PASSWORD", "Password (min. 6 characters!)");
define("DLF_WORDING_REGISTRATION_PASSWORD_REPEAT", "Password repeat");
define("DLF_WORDING_REGISTRATION_USERNAME", "Username (only letters and numbers, 2 to 64 characters)");
define("DLF_WORDING_REMEMBER_ME", "Ich möchte angemeldet bleiben");
define("DLF_WORDING_REQUEST_PASSWORD_RESET", "Request a password reset. Enter your username and you'll get a mail with instructions:");
define("DLF_WORDING_RESET_PASSWORD", "Reset my password");
define("DLF_WORDING_SUBMIT_NEW_PASSWORD", "Submit new password");
define("DLF_WORDING_USERNAME", "Username");
define("DLF_WORDING_YOU_ARE_LOGGED_IN_AS", "You are logged in as ");
define("DLF_WORDING_YES", "Ja");
define("DLF_WORDING_NO", "Nein");
define("DLF_WORDING_ITEM_DEACTIVATED", "Der Datensatz ist deaktiviert");

define("DLF_ACCESS_DENIED", "<!DOCTYPE html><head></head><body>Zugriff verweigert</body></html>");

// buttons
define("DLF_BUTTON_NEW", "Neu");
define("DLF_BUTTON_ITEM", "Anzeigen");
define("DLF_BUTTON_EDIT", "Bearbeiten");
define("DLF_BUTTON_DELETE", "Löschen");
define("DLF_BUTTON_LIST", "Liste");
define("DLF_BUTTON_UPDATE", "Speichern");
define("DLF_BUTTON_CREATE", "Speichern");
define("DLF_BUTTON_CANCEL", "Abbruch");
define("DLF_BUTTON_HOME", "Start");
define("DLF_BUTTON_SEND", "Senden");
define("DLF_BUTTON_NEXT", "Weiter");
define("DLF_BUTTON_BACK", "Zurück");
define("DLF_BUTTON_DEFAULT", "Modulstart");




// modal delete dialog
define("DLF_MODAL_SHOULD_BE_DELETED", "Vorsicht, Der Datensatz wird gelöscht und kann nicht wieder hergestellt werden! Trotzdem mit Löschen fortsetzen?");
define("DLF_MODAL_DELETE", "Fortsetzen mit Löschen");
define("DLF_MODAL_CANCEL", "Abbrechen und Datensatz behalten");

// actions
define("DLF_MESSAGE_ACTION_CREATE", "Der Datensatz wurde angelegt");
define("DLF_MESSAGE_ACTION_UPDATE", "Der Datensatz wurde aktualisiert");
define("DLF_MESSAGE_ACTION_DELETE", "Der Datensatz wurde gelöscht");
define("DLF_MESSAGE_ACTION_DEFAULT", "Die Datenbank-Aktion wurde durchgeführt");
define("DLF_ERROR_ACTION_CREATE", "Der Datensatz konnte nicht angelegt werden");
define("DLF_ERROR_ACTION_UPDATE", "Der Datensatz konnte nicht aktualisiert werden");
define("DLF_ERROR_ACTION_DELETE", "Der Datensatz konnte nicht gelöscht werden");
define("DLF_ERROR_ACTION_DEFAULT", "Die Datenbank-Aktion konnte nicht durchgeführt werden");

// for Modules, Users, Tenants module
define("DLF_MODULES_TITLE", "Module");
define("DLF_USERS_TITLE", "Benutzer");
define("DLF_TENANTS_TITLE", "Mandanten");

// for validations
define("DLF_VALIDATION_CHECKED", "Dieses Kästchen muss angekreuzt werden.");
define("DLF_VALIDATION_SELECTED", "Eine Option must ausgewählt werden.");
define("DLF_VALIDATION_ISEMAIL", "Bitte eine Email-Adresse angeben.");



?>
