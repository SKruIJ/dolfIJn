<?php

/****************************************
dolfIJn
SKruIJ 2018-11-30
/engine/languages/en-en.php
main language file en-en
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
define("DLF_WORDING_PLEASE_SIGN_IN", "Please sign in");
define("DLF_WORDING_BACK_TO_LOGIN", "Back to Login Page");
define("DLF_WORDING_CHANGE_EMAIL", "Change email");
define("DLF_WORDING_CHANGE_PASSWORD", "Change password");
define("DLF_WORDING_CHANGE_USERNAME", "Change username");
define("DLF_WORDING_CURRENTLY", "currently");
define("DLF_WORDING_EDIT_USER_DATA", "Edit user data");
define("DLF_WORDING_EDIT_YOUR_CREDENTIALS", "You are logged in and can edit your credentials here");
define("DLF_WORDING_FORGOT_MY_PASSWORD", "I forgot my password");
define("DLF_WORDING_WELCOME", "Hello");
define("DLF_WORDING_HOME", "Home");
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
define("DLF_WORDING_REMEMBER_ME", "Keep me logged in");
define("DLF_WORDING_REQUEST_PASSWORD_RESET", "Request a password reset. Enter your username and you'll get a mail with instructions:");
define("DLF_WORDING_RESET_PASSWORD", "Reset my password");
define("DLF_WORDING_SUBMIT_NEW_PASSWORD", "Submit new password");
define("DLF_WORDING_USERNAME", "Username");
define("DLF_WORDING_YOU_ARE_LOGGED_IN_AS", "You are logged in as ");
define("DLF_WORDING_YES", "Yes");
define("DLF_WORDING_NO", "No");
define("DLF_WORDING_ITEM_DEACTIVATED", "The item is deactivated");

define("DLF_ACCESS_DENIED", "<!DOCTYPE html><head></head><body>Access denied</body></html>");

// buttons
define("DLF_BUTTON_NEW", "Add");
define("DLF_BUTTON_ITEM", "Show");
define("DLF_BUTTON_EDIT", "Edit");
define("DLF_BUTTON_DELETE", "Delete");
define("DLF_BUTTON_LIST", "List");
define("DLF_BUTTON_UPDATE", "Save");
define("DLF_BUTTON_CREATE", "Save");
define("DLF_BUTTON_CANCEL", "Cancel");
define("DLF_BUTTON_HOME", "Home");
define("DLF_BUTTON_SEND", "Send");
define("DLF_BUTTON_NEXT", "Next");
define("DLF_BUTTON_BACK", "Back");
define("DLF_BUTTON_DEFAULT", "Start of the module");




// modal delete dialog
define("DLF_MODAL_SHOULD_BE_DELETED", "Be careful, the data item will be deleted and can't be recovered! Continue to delete?");
define("DLF_MODAL_DELETE", "Continue to delete");
define("DLF_MODAL_CANCEL", "Cancel and keep the data item");

// actions
define("DLF_MESSAGE_ACTION_CREATE", "The data has been stored");
define("DLF_MESSAGE_ACTION_UPDATE", "The data has been updated");
define("DLF_MESSAGE_ACTION_DELETE", "The data has been deleted");
define("DLF_MESSAGE_ACTION_DEFAULT", "The database transaction has been performed");
define("DLF_ERROR_ACTION_CREATE", "Sorry, the data couldn't been stored");
define("DLF_ERROR_ACTION_UPDATE", "Sorry, the data couldn't been updated");
define("DLF_ERROR_ACTION_DELETE", "Sorry, the data couldn't been deleted");
define("DLF_ERROR_ACTION_DEFAULT", "Sorry, the database transaction couldn't been performed");

// for Modules, Users, Tenants module
define("DLF_MODULES_TITLE", "Modules");
define("DLF_USERS_TITLE", "Users");
define("DLF_TENANTS_TITLE", "Tenants");

// for validations
define("DLF_VALIDATION_CHECKED", "This checkbox must be ticked.");
define("DLF_VALIDATION_SELECTED", "One option must be selected.");
define("DLF_VALIDATION_ISEMAIL", "Please fill in an email address.");


?>
