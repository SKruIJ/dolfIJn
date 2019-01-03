<?php

/****************************************
dolfIJn
SKruIJ 2017-12-12
/screens/default/elements/menu.php
screen building the menu area in a default page
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");


$dlf_select_query = "SELECT * FROM " . APP_ID . "_core_modules WHERE modules_active = 1 AND modules_delete = 0 ORDER BY modules_category, modules_sort";

$dlf_result_set = dlf_db_select_query($dlf_select_query);

$menuelement = "<nav class=\"navbar navbar-custom navbar-fixed-top\"><div class=\"container\">";
$menuelement .= "<div class=\"navbar-header\"><button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\"#myNavbar\">";
$menuelement .= "<span class=\"icon-bar\"></span><span class=\"icon-bar\"></span><span class=\"icon-bar\"></span></button>";
$menuelement .= "<a class=\"navbar-brand\" href=\"#\" onclick=\"dlf_switch('home','default')\"> " . APP_TITLE . " </a></div>";
$menuelement .= "<div class=\"collapse navbar-collapse\" id=\"myNavbar\">";
 
$menuelement .= "<ul class=\"nav navbar-nav\">";

if (file_exists("app/screens/default/elements/menu.php")) {
	// taking menu configuration of the app
	require("app/screens/default/elements/menu.php");
} else {
	// taking the dolfIJn standard menu
	if ($login->isUserLoggedIn() == true) {

		$menuelement .= "<li><a href=\"#\" onclick=\"dlf_switch('home','default')\"> <span class=\"glyphicon glyphicon-home\"></span> </a></li>";
		
		if ($_SESSION[APP_ID.'_user_name'] != "public") {
			if (dlf_isSuperAdmin() || dlf_isTenAdmin()) {
				$menuelement .= "<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"> Administration <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">";
				if (dlf_isSuperAdmin()) {
					$menuelement .= "<li><a href=\"#\"> Tenants </a></li>";
					$menuelement .= "<li><a href=\"#\"> Modules </a></li>";
				}
				$menuelement .= "<li><a href=\"#\"> Users </a></li>";
				$menuelement .= "</ul></li>";
			}
		}

		$atleastonecategory = 0;
		$firstcategory = 1;
		$category = "";
		foreach ($dlf_result_set as $datensatz) {
			// 20170117_SKruIJ: $datensatz["modules_public"] == 1 || aus if-Bedingung herausgenommen, damit die Module nicht nur aufgrund public angezeigt werden
			if (dlf_isSuperAdmin()) {
				if ($category != $datensatz["modules_category"]) {
					$category = $datensatz["modules_category"];
					$atleastonecategory = 1;
					if ($firstcategory == 0) {
						$menuelement .= "</ul></li>";
					} else {
						$firstcategory = 0;
					}
					$menuelement .= "<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"> " . $category . " <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">";
				}
				$menuelement .= "<li><a href=\"#\" onclick=\"dlf_switch('" . $datensatz["modules_title"] . "','default')\"> " . $datensatz["modules_displayed_name"] . " </a></li>";
			} else {
				if (dlf_TenModRights($datensatz["modules_id"])) {
					if (dlf_isTenAdmin() || dlf_UserModRights($datensatz["modules_id"]) > 0) {
						if ($category != $datensatz["modules_category"]) {
							$category = $datensatz["modules_category"];
							$atleastonecategory = 1;
							if ($firstcategory == 0) {
								$menuelement .= "</ul></li>";
							} else {
								$firstcategory = 0;
							}
							$menuelement .= "<li class=\"dropdown\"><a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\"> " . $category . " <span class=\"caret\"></span></a><ul class=\"dropdown-menu\">";
						}
						$menuelement .= "<li><a href=\"#\" onclick=\"dlf_switch('" . $datensatz["modules_title"] . "','default')\"> " . $datensatz["modules_displayed_name"] . " </a></li>";
					}
				}
			}
		}
		if ($atleastonecategory == 1) {
			$menuelement .= "</ul></li>";
		}
	
	}

}

if ($login->isUserLoggedIn() == true && $_SESSION[APP_ID.'_user_name'] != "public") {
	$menuelement .= "</ul><ul class=\"nav navbar-nav navbar-right\"><li><a href=\"#\"><span class=\"glyphicon glyphicon-user\"></span> " . $_SESSION[APP_ID.'_user_name'] . " </a></li><li><a href=\"#\" onclick=\"logout()\"><span class=\"glyphicon glyphicon-log-out\"></span> " . DLF_WORDING_LOGOUT . " </a></li></ul></div></div></nav>";
	
} else {
	$menuelement .= "</ul><ul class=\"nav navbar-nav navbar-right\"><li><a href=\"#\"><span class=\"glyphicon glyphicon-log-in\"></span> " . DLF_WORDING_LOGIN . " </a></li></ul></div></div></nav>";
}

		
if (APP_MENU_DISPLAY_FLAG == 1) {
	if ($_SESSION[APP_ID.'_user_name'] != "public") {
		echo $menuelement;
	} else {
		if (APP_MENU_PUBLIC_DISPLAY_FLAG == 1) {
			echo $menuelement;
		}
	}
}

?>

