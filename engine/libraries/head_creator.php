<?php

/****************************************
dolfIJn
SKruIJ 2018-08-15
/engine/libraries/head_creator.php
build head string incl meta, title, scipts, css
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$dlf_head= "";

// meta data
$dlf_head .= "<meta charset=\"utf-8\">";
$dlf_head .= "<meta http-equiv=\"content-type\" content=\"txt/html; charset=utf-8\">";
$dlf_head .= "<meta name=\"author\" content=\"" . APP_AUTHOR . "\">";
$dlf_head .= "<meta name=\"application-name\" content=\"" . APP_TITLE . "\">";
$dlf_head .= "<meta name=\"description\" content=\"" . APP_DESCRIPTION . "\">";

//webapp configuration
if (APP_WEBAPP == 1) {
	$dlf_head .= "<meta name=\"apple-mobile-web-app-capable\" content=\"yes\" />";
	$dlf_head .= "<meta name=\"apple-mobile-web-app-status-bar-style\" content=\"black-translucent\" />";
	if (APP_WEBAPP_MAXSCALE == 1 && APP_WEBAPP_MINSCALE == 1) {
		$dlf_head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0\">";
	} elseif (APP_WEBAPP_MAXSCALE == 1 && APP_WEBAPP_MINSCALE == 0) {
		$dlf_head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0\">";
	} elseif (APP_WEBAPP_MAXSCALE == 0 && APP_WEBAPP_MINSCALE == 1) {
		$dlf_head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, minimum-scale=1.0\">";
	} else {
		$dlf_head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
	}
} else {
	$dlf_head .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">";
}
	
// misc icon settings
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"57x57\" href=\"app/screens/icons/apple-icon-57x57.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"60x60\" href=\"app/screens/icons/apple-icon-60x60.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"72x72\" href=\"app/screens/icons/apple-icon-72x72.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"76x76\" href=\"app/screens/icons/apple-icon-76x76.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"114x114\" href=\"app/screens/icons/apple-icon-114x114.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"120x120\" href=\"app/screens/icons/apple-icon-120x120.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"144x144\" href=\"app/screens/icons/apple-icon-144x144.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"152x152\" href=\"app/screens/icons/apple-icon-152x152.png\">";
$dlf_head .= "<link rel=\"apple-touch-icon\" sizes=\"180x180\" href=\"app/screens/icons/apple-icon-180x180.png\">";
$dlf_head .= "<link rel=\"icon\" type=\"image/png\" sizes=\"192x192\" href=\"app/screens/icons/android-icon-192x192.png\">";
$dlf_head .= "<link rel=\"icon\" type=\"image/png\" sizes=\"32x32\" href=\"app/screens/icons/favicon-32x32.png\">";
$dlf_head .= "<link rel=\"icon\" type=\"image/png\" sizes=\"96x96\" href=\"app/screens/icons/favicon-96x96.png\">";
$dlf_head .= "<link rel=\"icon\" type=\"image/png\" sizes=\"16x16\" href=\"app/screens/icons/favicon-16x16.png\">";
$dlf_head .= "<link rel=\"manifest\" href=\"app/screens/icons/manifest.json\">";
$dlf_head .= "<meta name=\"msapplication-TileColor\" content=\"" . APP_META_MSAPPLICATION_TILECOLOR . "\">";
$dlf_head .= "<meta name=\"msapplication-TileImage\" content=\"app/screens/icons/ms-icon-144x144.png\">";
$dlf_head .= "<meta name=\"theme-color\" content=\"" . APP_META_THEME_COLOR . "\">";

// title setting
// if or not module
switch ($dlf_modules) {
	case "home":
		$dlf_head .= "<title>" . APP_TITLE . "</title>";
		break;
	case "modules":
		$dlf_head .= "<title>" . APP_TITLE . " > " . DLF_MODULES_TITLE . "</title>";
		break;
	case "users":
		$dlf_head .= "<title>" . APP_TITLE . " > " . DLF_USERS_TITLE . "</title>";
		break;
	case "tenants":
		$dlf_head .= "<title>" . APP_TITLE . " > " . DLF_TENANTS_TITLE . "</title>";
		break;		
	default:
		$dlf_head .= "<title>" . APP_TITLE . " > " . MOD_SITE_TITLE . "</title>";
}

// css integration
// css reset
// $dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"screens/default/css/reset.css\">";
// jquery and bootstrap css
$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"engine/vendors/jquery/jquery-ui.min.css\">";
$dlf_head .= "<link rel=\"stylesheet\" href=\"engine/vendors/bootstrap/css/bootstrap.min.css\">";
// fonts
$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"engine/vendors/fontawesome-free-5.2.0-web/css/all.css\">";
// dolfijn and app css
$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"screens/default/css/global.css\">";
$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app/screens/default/css/app.css\">";

// module.css integration if or not module
switch ($dlf_modules) {
	case "home":
		if ($login->isUserLoggedIn() == true) {
		
		} else {
			if (file_exists("screens/default/css/login.css")) {
				$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"screens/default/css/login.css\">";
			}
			if (file_exists("app/screens/default/css/app_login.css")) {
				$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"app/screens/default/css/app_login.css\">";
			}
		}
		break;
	case "modules":
		break;
	case "users":
		break;
	case "tenants":
		break;
	default:
		if (file_exists("modules/" . $dlf_modules . "/screens/default/css/module.css")) {
			$dlf_head .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"modules/" . $dlf_modules . "/screens/default/css/module.css\">";
		}
}


// jquery and bootstrap scripts integration
$dlf_head .= "<script src=\"engine/vendors/jquery/jquery-3.2.1.min.js\"></script>";
$dlf_head .= "<script src=\"engine/vendors/jqueryvalidate/jquery.validate.min.js\"></script>";
$dlf_head .= "<script src=\"engine/vendors/jquery/jquery-ui.min.js\"></script>";
$dlf_head .= "<script src=\"engine/vendors/bootstrap/js/bootstrap.min.js\"></script>";

// additional langiage scripts if not english
switch ($dlf_language) {
	case "de-de":
		$dlf_head .= "<script src=\"engine/vendors/jqueryvalidate/validate/localization/messages_de.js\"></script>";
		break;
	case "nl-nl":
		$dlf_head .= "<script src=\"engine/vendors/jqueryvalidate/localization/messages_nl.js\"></script>";
		break;
	default:
} 

// datepicker scripts
$dlf_head .= "<script src=\"engine/vendors/jquery/datepicker-de.js\"></script>";
$dlf_head .= "<script src=\"engine/vendors/jquery/datepicker-nl.js\"></script>";
$dlf_head .= "<script src=\"engine/vendors/jquery/datepicker-en-GB.js\"></script>";

// dolfijn and app scripts
$dlf_head .= "<script src=\"engine/js/global.js\"></script>";
$dlf_head .= "<script src=\"app/engine/js/app.js\"></script>";
// if or not module
switch ($dlf_modules) {
	case "home":
		break;
	case "modules":
		break;
	case "users":
		break;
	case "tenants":
		break;
	default:
		if (file_exists("modules/" . $dlf_modules . "/engine/js/module.js")) {
			$dlf_head .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"modules/" . $dlf_modules . "/engine/js/module.js\"></script>";
		}
}

?>
