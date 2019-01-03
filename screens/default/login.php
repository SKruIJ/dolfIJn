<?php

/****************************************
dolfIJn
SKruIJ 2018-04-19
/screens/default/login.php
login page
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// simple form for login

echo "<div class=\"container\">";
echo "<form class=\"form-signin\" method=\"post\" action=\"index.php\" name=\"loginform\">";
echo "<h1 class=\"form-signin-heading\"><img src=\"app/screens/icons/android-icon-48x48.png\" alt=\"" . APP_TITLE . " Logo\"></h1>";
echo "<div class=\"spacer\">&nbsp;</div>";
echo "<label for=\"user_name\" class=\"sr-only\">" . DLF_WORDING_USERNAME . "</label>";
echo "<input class=\"form-control\" id=\"user_name\" type=\"text\" name=\"user_name\" placeholder=\"" . DLF_WORDING_USERNAME . "\" required autofocus/>";
echo "<label for=\"user_password\" class=\"sr-only\">" . DLF_WORDING_PASSWORD . "</label>";
echo "<input class=\"form-control\" id=\"user_password\" type=\"password\" name=\"user_password\" placeholder=\"" . DLF_WORDING_PASSWORD . "\" autocomplete=\"off\" required />";
echo "<div class=\"spacer\">&nbsp;</div>";

echo "<div class=\"checkbox\">";
echo "<label>";
echo "<input id=\"user_rememberme\" name=\"user_rememberme\" type=\"checkbox\" value=\"1\">" . DLF_WORDING_REMEMBER_ME;
echo "</label></div>";

echo "<button name=\"login\" value=\"" . DLF_WORDING_LOGIN . "\" class=\"btn btn-lg btn-primary btn-block\" type=\"submit\">" . DLF_WORDING_LOGIN . "</button>";
echo "</form>";
echo "</div><!-- /container -->";


/*
 <a href="password_reset.php"><?php echo DLF_WORDING_FORGOT_MY_PASSWORD; ?></a>
*/

?>
