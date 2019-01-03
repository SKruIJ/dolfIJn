<?php

/****************************************
dolfIJn
SKruIJ 2017-07-09
/screens/default/elements/footer.php
screen building the footer area
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$footerelement = "";

$footerelement .= "<footer class=\"footer\"><div class=\"container\"><p>";

if (file_exists("app/screens/default/elements/footer.php")) {
	// taking footer configuration of the app
	require("app/screens/default/elements/footer.php");
} else {
	// taking the dolfIJn standard footer
	$footerelement .= APP_TITLE . " " . APP_RELEASE . " built on " . DLF_TITLE . " " . DLF_RELEASE . " " . APP_COPYRIGHT;

}

$footerelement .= "</p></div></footer>";	

if (APP_FOOTER_DISPLAY_FLAG == 1) {
	if ($login->isUserLoggedIn() == true) {
		if ($_SESSION[APP_ID.'_user_name'] != "public") {
			echo $footerelement;
		} else {
			if (APP_FOOTER_PUBLIC_DISPLAY_FLAG == 1) {
				echo $footerelement;
			}
		}
	} else {
		if (APP_FOOTER_LOGIN_DISPLAY_FLAG == 1) {
			echo $footerelement;
		}
	}
}

?>