<?php

/****************************************
dolfIJn
SKruIJ 2016-03-02
/core/modules/body.php
where core/modules screen starts
****************************************/


// ü check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// module configuration
require("core/modules/engine/config/config.php");

// db action and data select
require("core/modules/queries/queries.php");
		
// construct the header area
require("screens/default/elements/header.php");

// construct the menu area
require("screens/default/elements/menu.php");

// breadcrump, for the time being part of the module > in the future part of core ?!
require("core/modules/screens/default/elements/breadcrumb.php");

$dirs = scandir("modules");
print_r($dirs);

switch ($dlf_dataview) {
	case "list_read":
		foreach ($authors_result as $datensatz) {
			echo "<div>";
			echo "<a href=\"#\" onclick=\"dlf_show_item_read('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\">" . $datensatz["authors_name"] . "</a> <a href=\"#\" onclick=\"dlf_edit_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\"> EDIT </a>  <a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default'," . $datensatz["authors_id"] . ",'del01')\"> DELETE </a>";
			echo "</div>";
		}
		echo "<div><a href=\"#\" onclick=\"dlf_add_write('" . $dlf_modules . "')\"> ADD </a></div>";
		break;
	case "list_write":
	case "list_admin":
		foreach ($authors_result as $datensatz) {
			echo "<div>";
			echo "<a href=\"#\" onclick=\"dlf_show_item_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\">" . $datensatz["authors_name"] . "</a> <a href=\"#\" onclick=\"dlf_edit_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\"> EDIT </a>  <a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default'," . $datensatz["authors_id"] . ",'del01')\"> DELETE </a>";
			echo "</div>";
		}
		echo "<div><a href=\"#\" onclick=\"dlf_add_write('" . $dlf_modules . "')\"> ADD </a></div>";
		break;
	case "item_read":
		foreach ($authors_result as $datensatz) {
			echo "<div>";
			echo "<div><b>" . $datensatz["authors_name"] . "</b></div><div>" . $datensatz["authors_birthday"] . "</div><div>" . $datensatz["authors_hashtag"] . "</div><div>" . $datensatz["authors_nationality"] . "</div>";
			echo "</div>";
		echo "<div><a href=\"#\" onclick=\"dlf_edit_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\"> EDIT </a></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default'," . $datensatz["authors_id"] . ",'del01')\"> DELETE </a></div>";
		}
		break;
	case "item_write":
	case "item_admin":
		foreach ($authors_result as $datensatz) {
			echo "<div>";
			echo "<div><b>" . $datensatz["authors_name"] . "</b></div><div>" . $datensatz["authors_birthday"] . "</div><div>" . $datensatz["authors_hashtag"] . "</div><div>" . $datensatz["authors_nationality"] . "</div>";
			echo "</div>";
		echo "<div><a href=\"#\" onclick=\"dlf_edit_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\"> EDIT </a></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default'," . $datensatz["authors_id"] . ",'del01')\"> DELETE </a></div>";
		}
		break;
	case "edit_write":
		foreach ($authors_result as $datensatz) {
			echo "<div>Autor:</div>";
			echo "<div>Name: <input form=\"dlf_form\" id=\"dlf_formfield_1\" type=\"input\" name=\"dlf_formfield_1\" value=\"" . $datensatz["authors_name"] . "\"></div>";
			echo "<div>Birthday: <input form=\"dlf_form\" id=\"dlf_formfield_2\" type=\"input\" name=\"dlf_formfield_2\" value=\"" . $datensatz["authors_birthday"] . "\"></div>";
			echo "<div>Hashtag: <input form=\"dlf_form\" id=\"dlf_formfield_3\" type=\"input\" name=\"dlf_formfield_3\" value=\"" . $datensatz["authors_hashtag"] . "\"></div>";
			echo "<div>Nationality: <select id=\"dlf_formfield_4\" name=\"dlf_formfield_4\" size=\"1\">";
			foreach ($authors_nationality_result as $datensatz2) {
				if ($datensatz["authors_nationality"] == $datensatz2["modules_lists_item"]) {
					echo "<option value=\"" . $datensatz2["modules_lists_value"] . "\" selected>" . $datensatz2["modules_lists_item"] . "</option>";
				} else {
					echo "<option value=\"" . $datensatz2["modules_lists_value"] . "\">" . $datensatz2["modules_lists_item"] . "</option>";
				}
			}
		echo "</select></div>";
		}
		echo "<div><a href=\"#\" onclick=\"dlf_show_item_write('" . $dlf_modules . "','" . $dlf_id . "')\"> CANCEL </a></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','item'," . $dlf_id . ",'upd01')\"> SAVE </a></div>";
		break;
	case "edit_admin":
		foreach ($authors_result as $datensatz) {
			echo "<div>Autor:</div>";
			echo "<div>Name: <input form=\"dlf_form\" id=\"dlf_formfield_1\" type=\"input\" name=\"dlf_formfield_1\" value=\"" . $datensatz["authors_name"] . "\"></div>";
			echo "<div>Birthday: <input form=\"dlf_form\" id=\"dlf_formfield_2\" type=\"input\" name=\"dlf_formfield_2\" value=\"" . $datensatz["authors_birthday"] . "\"></div>";
			echo "<div>Hashtag: <input form=\"dlf_form\" id=\"dlf_formfield_3\" type=\"input\" name=\"dlf_formfield_3\" value=\"" . $datensatz["authors_hashtag"] . "\"></div>";
			echo "<div>Nationality: <select id=\"dlf_formfield_4\" name=\"dlf_formfield_4\" size=\"1\">";
			foreach ($authors_nationality_result as $datensatz2) {
				if ($datensatz["authors_nationality"] == $datensatz2["modules_lists_item"]) {
					echo "<option value=\"" . $datensatz2["modules_lists_value"] . "\" selected>" . $datensatz2["modules_lists_item"] . "</option>";
				} else {
					echo "<option value=\"" . $datensatz2["modules_lists_value"] . "\">" . $datensatz2["modules_lists_item"] . "</option>";
				}
			}
		echo "</select></div>";
		}
		echo "<div><a href=\"#\" onclick=\"dlf_show_item_write('" . $dlf_modules . "','" . $dlf_id . "')\"> CANCEL </a></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','item'," . $dlf_id . ",'upd01')\"> SAVE </a></div>";
		break;
	case "new_write":
	case "new_admin":
		echo "<div>Neuer Autor:</div>";
		echo "<div>Name: <input id=\dlf_formfield_1\" type=\"input\" name=\"dlf_formfield_1\" value=\"\"></div>";
		echo "<div>Birthday: <input id=\"dlf_formfield_2\" type=\"input\" name=\"dlf_formfield_2\" value=\"\"></div>";
		echo "<div>Hashtag: <input id=\"dlf_formfield_3\" type=\"input\" name=\"dlf_formfield_3\" value=\"#\"></div>";
		echo "<div>Nationality: <select id=\"dlf_formfield_4\" name=\"dlf_formfield_4\" size=\"1\">";
		foreach ($authors_nationality_result as $datensatz) {
			echo "<option value=\"" . $datensatz["modules_lists_value"] . "\">" . $datensatz["modules_lists_item"] . "</option>";
		}
		echo "</select></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default',0,'')\"> CANCEL </a></div>";
		echo "<div><a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default',0,'cre01')\"> SAVE </a></div>";
		break;
	default:
		foreach ($authors_result as $datensatz) {
			echo "<div>";
			echo "<a href=\"#\" onclick=\"dlf_show_item_read('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\">" . $datensatz["authors_name"] . "</a> <a href=\"#\" onclick=\"dlf_edit_write('" . $dlf_modules . "','" . $datensatz["authors_id"] . "')\"> EDIT </a>  <a href=\"#\" onclick=\"dlf_control('" . $dlf_modules . "','default'," . $datensatz["authors_id"] . ",'del01')\"> DELETE </a>";
			echo "</div>";
		}
		echo "<div><a href=\"#\" onclick=\"dlf_add_write('" . $dlf_modules . "')\"> ADD </a></div>";
		
}


// construct the footer area
require("screens/default/elements/footer.php");

?>