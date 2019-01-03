<?php

/****************************************
dolfIJn
SKruIJ 2017-12-12
/screens/default/body.php
start for init view (application home)
****************************************/

// ü check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$dlf_select_query = "SELECT * FROM " . APP_ID . "_core_modules WHERE modules_active = 1 AND modules_delete = 0 ORDER BY modules_category, modules_sort";

$dlf_result_set = dlf_db_select_query($dlf_select_query);

if ($login->isUserLoggedIn() == true) {

	if ($_SESSION[APP_ID.'_user_name'] != "public") {
		if (dlf_isSuperAdmin() || dlf_isTenAdmin()) {
			echo "<div class=\"panel panel-default\">";
			echo "<div class=\"panel panel-heading\">";
			echo "<h3 class=\"panel-title\">Administration</h3>";
			echo "</div>";
			echo "<div class=\"panel panel-body\">";
			if (dlf_isSuperAdmin()) {
				echo "<p>Tenants</p>";
				echo "<p>Modules</p>";
			}
			echo "<p>Users</p>";
			echo "</div>";
			echo "</div>";
		}
	}
	
	$category = "";
	$dlf_newCategoryOpen = 0;
	foreach ($dlf_result_set as $datensatz) {
		// 20170118_SKruIJ: $datensatz["modules_public"] == 1 || aus if-Bedingung herausgenommen, damit die Module nicht nur aufgrund public angezeigt werden
		if (dlf_isSuperAdmin()) {
			if ($category != $datensatz["modules_category"]) {
				if ($dlf_newCategoryOpen == 1) {
					echo "</div></div>";
					$dlf_newCategoryOpen = 0;
				}
				$dlf_newCategoryOpen = 1;
				$category = $datensatz["modules_category"];
				
				echo "<div class=\"panel panel-default\">";
				echo "<div class=\"panel panel-heading\">";
				echo "<h3 class=\"panel-title\">" . $category . "</h3>";
				echo "</div>";
				echo "<div class=\"panel panel-body\">";
			}
			echo "<p><a href=\"#\" onclick=\"dlf_switch('" . $datensatz["modules_title"] . "' , 'default')\">" . $datensatz["modules_displayed_name"] . "</a></p>";
		} else {
			if (dlf_TenModRights($datensatz["modules_id"])) {
				if (dlf_isTenAdmin() || dlf_UserModRights($datensatz["modules_id"]) > 0) {
					if ($category != $datensatz["modules_category"]) {
						if ($dlf_newCategoryOpen == 1) {
							echo "</div></div>";
							$dlf_newCategoryOpen = 0;
						}
						$dlf_newCategoryOpen = 1;
						$category = $datensatz["modules_category"];
						
						echo "<div class=\"panel panel-default\">";
						echo "<div class=\"panel panel-heading\">";
						echo "<h3 class=\"panel-title\">" . $category . "</h3>";
						echo "</div>";
						echo "<div class=\"panel panel-body\">";
						
					}
					echo "<p><a href=\"#\" onclick=\"dlf_switch('" . $datensatz["modules_title"] . "' , 'default', )\">" . $datensatz["modules_displayed_name"] . "</a></p>";
				}
			}
		}
	}
	if ($dlf_newCategoryOpen == 1) {
		echo "</div></div>";
		$dlf_newCategoryOpen = 0;
	}
	
	
}

?>
