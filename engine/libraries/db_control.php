<?php

/****************************************
dolfIJn
SKruIJ 2018-04-03
/engine/libraries/db_control.php
db control functions
ü
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// CHECKED / MANUAL
// SKruIJ_20171120: new function
// function which returns the number of datasets from one table respecting access rights and tenants
// the table must contain the following fields: _tenants_id, _active, _delete
function dlf_db_count_onetable($myTable, $myInputPara = array()) {
// $myTable > table name for the select query
// $myInputPara > array expected as input with several optional array items
// "where" > optional / for additonal "where" statements in SQL notation (connected by "AND" statements)

global $login;
global $dlf_access;

	$result_count = 0;
	
	$sql_string = "";
	$sql_string = "SELECT COUNT(*) FROM " . APP_ID . "_" . $myTable;
	
	$where = "";
	// only entries not deleted
	$where = " WHERE " . $myTable . "_delete = 0 ";
	
	// only entries of the own tenant, except for superadmin
	if (dlf_isSuperAdmin()) {
		
	} else {
		$where .= " AND " . $myTable . "_tenants_id = " . $_SESSION[APP_ID.'_user_tenants_id'];
	}
	
	// admin is allowed to see inactive users
	if ($dlf_access == "admin") {
		
	} else {
		$where .= " AND " . $myTable . "_active = 1 "; 
	}
	
	// optional 'where' statement
	if (isset($myInputPara["where"]) && trim($myInputPara["where"]) != "") {
		$where .= " AND " . $myInputPara["where"];
	} 
	
	$sql_string .= $where;
	
	if ($login->databaseConnection()) {
		$db_result = $login->db_connection->prepare($sql_string);
		$db_result->execute();
		$result_count = $db_result->fetchColumn();
	}
		
	return $result_count;
	
}


// CHECKED / MANUAL
// SKruIJ_20161203: new function
// function which returns the full result set based on a select from one table for list view, respecting admin rights for showing inactive entries and tenants_id
function dlf_db_list_onetable($myTable, $myInputPara = array()) {
// $myTable > table name for the select query
// $myInputPara > array expected as input with several optional array items
// "orderby" > optional / field name(s) for order by in SQL notation (separated by comma, complemented by ASC or DESC)
// "where" > optional / for additonal "where" statements in SQL notation (connected by "AND" statements)

global $login;
global $dlf_access;

	$result_list = array();
	
	$sql_string = "";
	$sql_string = "SELECT * FROM " . APP_ID . "_" . $myTable;
	
	$where = "";
	// only entries not deleted
	$where = " WHERE " . $myTable . "_delete = 0 ";

	// only entries of the own tenant, except for superadmin
	if (dlf_isSuperAdmin()) {
		
	} else {
		$where .= " AND " . $myTable . "_tenants_id = " . $_SESSION[APP_ID.'_user_tenants_id'];
	}
	
	// admin is allowed to see inactive users
	if ($dlf_access == "admin") {
		
	} else {
		$where .= " AND " . $myTable . "_active = 1 "; 
	}
	
	// optional 'where' statement
	if (isset($myInputPara["where"]) && trim($myInputPara["where"]) != "") {
		$where .= " AND " . $myInputPara["where"];
	} 
	
	$orderby = "";
	// optional 'orderby' statement
	if (isset($myInputPara["orderby"]) && trim($myInputPara["orderby"]) != "") {
		$orderby .= " ORDER BY " . $myInputPara["orderby"] . " ";
	}
	
	$sql_string .= $where . $orderby;
	
	if ($login->databaseConnection()) {
		$db_result = $login->db_connection->prepare($sql_string);
		$db_result->execute();
		$result_list = $db_result->fetchAll();
	}
	
	return $result_list;
	
}
	

// CHECKED / MANUAL
// SKruIJ_20180308: new function
// function which returns the first row of the result set based on a simple item query (the dataset of a table matching wiht the given id)
function dlf_db_item_onetable($myTable, $myId) {
// $myTable > table from which dataset has to be selected
// $myId > Id of the dataset which has to be selected

	global $login;
	
	$dlf_db_result= array();

	$dlf_sqlstring = "SELECT * FROM " . APP_ID . "_" . $myTable . " WHERE " . $myTable . "_id = " . $myId;
	
	
	if ($login->databaseConnection()) {
		$db_result= $login->db_connection->prepare($dlf_sqlstring);
		$db_result->execute();
		$dlf_db_result= $db_result->fetch();
	}
	
	return $dlf_db_result;

}
	


// SKruIJ_20161007: new function
// function which returns the first row of the result set based on a simple item query (the dataset of a table matching wiht the given id
function dlf_db_select_simple_item($myTable, $myId) {
// $myTable > table from which dataset has to be selected
// $myId > Id of the dataset which has to be selected

	global $login;
	
	$dlf_db_result= array();

	$dlf_sqlstring = "SELECT * FROM " . $myTable . " WHERE " . $myTable . "_id = " . $myId;
	
	if ($login->databaseConnection()) {
		$db_result= $login->db_connection->prepare($dlf_sqlstring);
		$db_result->execute();
		$dlf_db_result= $db_result->fetch();
	}
	
	return $dlf_db_result;

}
	

// function which returns the complete result set based on a defined sql query
function dlf_db_select_query($myQuery) {
// $myQuery > SQL select query string

	global $login;
	
	$dlf_db_result= array();
	$dlf_sqlstring = $myQuery;

	if ($login->databaseConnection()) {
		$db_result= $login->db_connection->prepare($dlf_sqlstring);
		$db_result->execute();
		$dlf_db_result= $db_result->fetchAll();
	}
	
	return $dlf_db_result;
}


// SKruIJ_20160901: new function
// function which returns the first row of the result set based on a defined sql query
function dlf_db_select_row_query($myQuery) {
// $myQuery > SQL select query string
	
	global $login;
	
	$dlf_db_result= array();
	$dlf_sqlstring = $myQuery;

	if ($login->databaseConnection()) {
		$db_result= $login->db_connection->prepare($dlf_sqlstring);
		$db_result->execute();
		$dlf_db_result= $db_result->fetch();
	}
	
	return $dlf_db_result;
}


// SKruIJ_20160814: new function
// function which returns the number of result rows of a select statement
function dlf_db_select_count_query($myQuery) {
// $myQuery > SQL select query string
	
	global $login;
	
	$dlf_db_result_count = 0;
	$countquery = "SELECT COUNT(*) " . stristr($myQuery,"from");

	$dlf_sqlstring = $countquery;

	if ($login->databaseConnection()) {
		$dlf_db_result = $login->db_connection->prepare($dlf_sqlstring);
		$dlf_db_result->execute();
		$dlf_db_result_count = $dlf_db_result->fetchColumn();
	}
	return $dlf_db_result_count;
}


// CHECKED / MANUAL
// function which returns a SQL query string for an INSERT operation as prepared statement for later binding of parameters
// it's only for one table inserts
// taking into account tenants_id, user_id, insert_date
// active is set 1 and delete is set 0
function dlf_mds_create($myTable,$myItemList) {
// $myTable > table name
// $myItemList > List of items for the insert into query, given in an array with field as field name (relevant for binding of parameters) and value as insert value and type (text, date, number) for each entry

	$sqlstring = "";
	$sqlstring = "INSERT INTO " . APP_ID . "_" . $myTable . " (";
	
	$i = 0;
	foreach ($myItemList as $item) {
		if ($i > 0) $sqlstring .= ", "; 
		$sqlstring .= $myTable . "_" . $item["field"];
		$i += 1;
	}
	$sqlstring .= ", " . $myTable . "_tenants_id, " . $myTable . "_active, " . $myTable . "_delete, " . $myTable . "_insert_date, " . $myTable . "_insert_user_id) VALUES (";
	
	$i = 0;
	foreach ($myItemList as $item) {
		if ($i > 0) $sqlstring .= ", ";
		$sqlstring .= ":" . $item["field"]; 
		$i += 1;
	}
	
	$sqlstring .= ", " . $_SESSION[APP_ID.'_user_tenants_id'] . " , 1, 0, NOW(), " . $_SESSION[APP_ID.'_user_id'] . " )" ;
		
	return $sqlstring;
	
}


function dlf_db_create($myTable, $myItemList) {
// $myTable > table name
// $myItemList > List of items for the insert into query, given in an array with field as field name and value as insert value and type (text, date, number) for each entry

	global $login;

if ($login->isUserLoggedIn() == true) {
	$userid = $_SESSION[APP_ID.'_user_id'];
} else {
	$userid = 0;
}

	$dlf_sqlstring = "";
	$dlf_sqlstring = "INSERT INTO " . $myTable . " (";
	
	$dlf_i = 0;
	foreach ($myItemList as $item) {
		if ($dlf_i > 0) $dlf_sqlstring .= ", "; 
		$dlf_sqlstring .= $myTable . "_" . $item["field"];
		$dlf_i += 1;
	}
	$dlf_sqlstring .= ", " . $myTable . "_active, " . $myTable . "_delete, " . $myTable . "_insert_date, " . $myTable . "_insert_user_id) VALUES (";
	
	$dlf_i = 0;
	foreach ($myItemList as $item) {
		if ($dlf_i > 0) $dlf_sqlstring .= ", ";
		switch ($item["type"]) {
			case "text":
				$dlf_sqlstring .= "'" . $item["value"] . "'"; 
				break;
			case "date":
				$dlf_sqlstring .= "'" . $item["value"] . "'"; 
				break;
			case "number":
				$dlf_sqlstring .= $item["value"]; 
				break;
		}
		$dlf_i += 1;
	}
	
	$dlf_sqlstring .= ",1 , 0, NOW()," . $userid . ")";
	//$dlf_sqlstring .= ",1 , 0, NOW(),1)";
		
	return $dlf_sqlstring;
	
}


function dlf_db_delete($myTable) {
// $myTable > table name

	global $login;
	global $dlf_id;
	
	$dlf_sqlstring = "";

if ($login->isUserLoggedIn() == true) {
	$userid = $_SESSION[APP_ID.'_user_id'];
} else {
	$userid = 0;
}
	
	if (DLF_MOD_DELETE == 1) {
		// hartes delete
		$dlf_sqlstring = "DELETE FROM " . $myTable . " WHERE " . $myTable . "_id = " . $dlf_id;
	} else {
		// softes delete
		$dlf_sqlstring = "UPDATE " . $myTable . " SET " . $myTable . "_delete = 1, " . $myTable . "_delete_date = NOW(), " . $myTable . "_delete_user_id = '" . $userid . "' WHERE " . $myTable . "_id = " . $dlf_id;

	}
	
	return $dlf_sqlstring;
	
}


function dlf_db_update($myTable, $myItemList) {
// $myTable > table name
// $myItemList > List of items for the update query, given in an array with field as field name and value as insert value and type (text, date, number) for each entry

	global $login;
	global $dlf_id;

	$dlf_sqlstring = "";

if ($login->isUserLoggedIn() == true) {
	$userid = $_SESSION[APP_ID.'_user_id'];
} else {
	$userid = 0;
}


	$dlf_i = 0;
	$dlf_sqlstring = "UPDATE " . $myTable . " SET ";
	foreach ($myItemList as $item) {
			if ($dlf_i > 0) $dlf_sqlstring .= ", "; 
			switch ($item["type"]) {
				case "text":
					$dlf_sqlstring .= $myTable . "_" . $item["field"] . " = '" . $item["value"] . "'"; 
					break;
				case "date":
					$dlf_sqlstring .= $myTable . "_" . $item["field"] . " = '" . $item["value"] . "'"; 
					break;
				case "number":
					$dlf_sqlstring .= $myTable . "_" . $item["field"] . " = " . $item["value"]; 
					break;
			}
			$dlf_i += 1;

	}
	
	$dlf_sqlstring .= ", " . $myTable . "_update_date = NOW(), " . $myTable . "_update_user_id = '" . $userid . "' WHERE " . $myTable . "_id = " . $dlf_id;

	return $dlf_sqlstring;
}


// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------
// functions up to here fully qualified / functions below not yet qualified or obsolete
// ------------------------------------------------------------------------------------
// ------------------------------------------------------------------------------------



/*

//******************************************

$dlf_select = "SELECT COUNT(ilareg_con_email) AS anzahl FROM ilareg_con ORDER BY ilareg_con_name, ilareg_con_firstname";
		
		$dlf_select_codes = "SELECT * FROM ilacodes";
		
		$dlf_result_set = dlf_db_select_query($dlf_select);
	
		//$dlf_result_set_codes = $login->db_connection->query($dlf_select_codes);
		
		$dlf_result_set_codes = dlf_db_select_query($dlf_select_codes);
	
		$numberitems = 0;
		foreach ($dlf_result_set as $datensatz) {
			$numberitems = $datensatz["anzahl"];
		}
		echo "Anzahl Einträge: " . $numberitems;
	
		$lose = array();

		for ($i=1; $i<=$numberitems; $i++) {
			array_push($lose, $i);
		}
		
		$gewinn_ids = array_rand($lose,1000);
		
		for ($k=1; $k<=1000; $k++) {
			echo "Auswahl: " . $k . " : " . $gewinn_ids[$k-1] . "<br>";
		}
		
		$code_id = 1;
		for ($j=0; $j<1000; $j++) {
			$dlf_result_set_codes_row = $dlf_result_set_codes->fetch();
			$code1 = $dlf_result_set_codes_row["ilacodes_code"];
			echo $code_id . " : " . $code1 . "<br>";
			$code_id++;
			
			$dlf_result_set_codes_row = $dlf_result_set_codes->fetch();
			$code2 = $dlf_result_set_codes_row["ilacodes_code"];
			echo $code_id . " : " . $code2 . "<br>";
			$code_id++;
			$sqlupdate = "UPDATE ilareg_con SET ilareg_con_code_1 = '" . $code1 . "', ilareg_con_code_2 = '" . $code2 . "' WHERE ilareg_con_id = " . $gewinn_ids[$j];
			$login->db_connection->query($sqlupdate);

			echo $sqlupdate . "<br>";
			
		}
	*/
//***************************************		
/*





function dlf_db_select_simple($dlf_limit) {
	
	global $dlf_orderby;
	global $dlf_search;
	global $dlf_pagination_limit;
	global $dlf_pagination_offset;
	global $login;
	
	$dlf_sqlstring = "";
	
	if ($dlf_orderby == "") {
		// default order
		// here was by mistake an order just valid for authors
		// other general mechanism needed
		// $dlf_orderby = "ORDER BY authors_name ASC";
	}
	$dlf_orderby = " " . $dlf_orderby;

	// $dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	if (MOD_PAGINATION_LIMIT != 0) {
		$dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	}
	
	if ($dlf_pagination_limit != 0) {
		// default pagination
		$dlf_pagination = "LIMIT " . $dlf_pagination_limit . " OFFSET " . $dlf_pagination_offset;
		$dlf_pagination = " " . $dlf_pagination;
	} else {
		$dlf_pagination = "";
	}
	if ($dlf_limit == 0) {$dlf_pagination = "";}
		
	if (DLF_MOD_DELETE == 1) {
		// hartes Delete (Löschen)
		$dlf_delete = "";
	} else {
		// softes Delete (deaktivieren)
		$dlf_delete = "WHERE " . DLF_MOD_TABLE . "_delete = 0";
		$dlf_delete = " " . $dlf_delete;
	}
	
	$dlf_sqlstring = "SELECT * FROM " . DLF_MOD_TABLE . $dlf_delete . $dlf_orderby . $dlf_pagination;

	if ($login->databaseConnection()) {
		$dlf_db_result = $login->db_connection->query($dlf_sqlstring);
	}
	
	return $dlf_db_result;

}

function dlf_db_select_simple_plus($dlf_limit, $dlf_sql_where, $dlf_sql_orderby) {
	
	//global $dlf_orderby;
	global $dlf_search;
	global $dlf_pagination_limit;
	global $dlf_pagination_offset;
	global $login;
	
	$dlf_sqlstring = "";
	
	//if ($dlf_orderby == "") {
		// default order
		//$dlf_orderby = "ORDER BY authors_name ASC";
	//}
	$dlf_orderby = " ORDER BY " . $dlf_sql_orderby;
	
	// $dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	if (MOD_PAGINATION_LIMIT != 0) {
		$dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	}
	
	if ($dlf_pagination_limit != 0) {
		// default pagination
		$dlf_pagination = "LIMIT " . $dlf_pagination_limit . " OFFSET " . $dlf_pagination_offset;
		$dlf_pagination = " " . $dlf_pagination;
	} else {
		$dlf_pagination = "";
	}
	if ($dlf_limit == 0) {$dlf_pagination = "";}
		
	if (DLF_MOD_DELETE == 1) {
		// hartes Delete (Löschen)
		$dlf_delete = " WHERE " . $dlf_sql_where;
	} else {
		// softes Delete (deaktivieren)
		$dlf_delete = "WHERE " . DLF_MOD_TABLE . "_delete = 0";
		$dlf_delete = " " . $dlf_delete . " AND " . $dlf_sql_where;
	}
	
	$dlf_sqlstring = "SELECT * FROM " . DLF_MOD_TABLE . $dlf_delete . $dlf_orderby . $dlf_pagination;

	if ($login->databaseConnection()) {
		$dlf_db_result = $login->db_connection->query($dlf_sqlstring);
	}
	
	return $dlf_db_result;

}


function dlf_db_select_simple_search($dlf_limit) {
	
	global $dlf_orderby;
	global $dlf_search;
	global $dlf_pagination_limit;
	global $dlf_pagination_offset;
	global $login;
	
	$dlf_sqlstring = "";
	
	if ($dlf_orderby == "") {
		// default order
		$dlf_orderby = "ORDER BY authors_name ASC";
	}
	$dlf_orderby = " " . $dlf_orderby;

	// $dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	if (MOD_PAGINATION_LIMIT != 0) {
		$dlf_pagination_limit = MOD_PAGINATION_LIMIT;
	}
	
	if ($dlf_pagination_limit != 0) {
		// default pagination
		$dlf_pagination = "LIMIT " . $dlf_pagination_limit . " OFFSET " . $dlf_pagination_offset;
		$dlf_pagination = " " . $dlf_pagination;
	} else {
		$dlf_pagination = "";
	}
	if ($dlf_limit == 0) {$dlf_pagination = "";}
		
	if (DLF_MOD_DELETE == 1) {
		// hartes Delete (Löschen)
		$dlf_delete = "";
	} else {
		// softes Delete (deaktivieren)
		$dlf_delete = "AND " . DLF_MOD_TABLE . "_delete = 0";
		$dlf_delete = " " . $dlf_delete;
	}
	
	$dlf_sqlsearch = "WHERE UCASE(" . DLF_MOD_TABLE . "_name) LIKE UCASE('%" . $dlf_search . "%')";
	$dlf_sqlsearch = " " . $dlf_sqlsearch;
	
	$dlf_sqlstring = "SELECT * FROM " . DLF_MOD_TABLE . $dlf_sqlsearch . $dlf_delete . $dlf_orderby . $dlf_pagination;
	if ($login->databaseConnection()) {
		$dlf_db_result = $login->db_connection->query($dlf_sqlstring);
	}
	
	return $dlf_db_result;

}

// still needed??
function dlf_db_select_modules_list($dlf_category, $dlf_subcategory) {

	global $login;
	
	$dlf_sqlstring = "";

	$dlf_sqlstring = "SELECT * FROM modules_lists WHERE modules_lists_category = '" . $dlf_category . "' AND modules_lists_subcategory = '" . $dlf_subcategory . "' AND modules_lists_active = 1 ORDER BY modules_lists_order ASC";
	if ($login->databaseConnection()) {
		$dlf_db_result = $login->db_connection->query($dlf_sqlstring);
	}
	
	return $dlf_db_result;
	
}

function dlf_db_delete() {

	global $dlf_id;
	$dlf_sqlstring = "";
	
	if (DLF_MOD_DELETE == 1) {
		// hartes delete
		$dlf_sqlstring = "DELETE FROM " . DLF_MOD_TABLE . " WHERE " . DLF_MOD_TABLE . "_id = " . $dlf_id;
	} else {
		// softes delete
		$dlf_sqlstring = "UPDATE " . DLF_MOD_TABLE . " SET " . DLF_MOD_TABLE . "_delete = 1, " . DLF_MOD_TABLE . "_delete_date = NOW(), " . DLF_MOD_TABLE. "_delete_user = '" . $_SESSION[APP_ID.'user_name'] . "' WHERE " . DLF_MOD_TABLE . "_id = " . $dlf_id;

	}
	
	return $dlf_sqlstring;
	
}

function dlf_db_update($dlf_ds) {

	global $dlf_id;
	global $dlf_fieldid;
	$dlf_sqlstring = "";
	$dlf_i = 0;
	
	$dlf_sqlstring = "UPDATE " . DLF_MOD_TABLE . " SET ";
	foreach ($dlf_ds as $dlf_field_def) {
		if ($dlf_field_def["format"] != "fixedvalue") { 
			if ($dlf_i > 0) $dlf_sqlstring .= ", "; 
			switch ($dlf_field_def["type"]) {
				case "text":
					$dlf_sqlstring .= DLF_MOD_TABLE . "_" . $dlf_field_def["name"] . " = '" . $dlf_fieldid[$dlf_field_def["name"]] . "'"; 
					break;
				case "date":
					$dlf_sqlstring .= DLF_MOD_TABLE . "_" . $dlf_field_def["name"] . " = '" . $dlf_fieldid[$dlf_field_def["name"]] . "'"; 
					break;
				case "int":
					$dlf_sqlstring .= DLF_MOD_TABLE . "_" . $dlf_field_def["name"] . " = " . $dlf_fieldid[$dlf_field_def["name"]]; 
					break;
			}
			$dlf_i += 1;
		}
	}
	
	$dlf_sqlstring .= ", " . DLF_MOD_TABLE . "_update_date = NOW(), " . DLF_MOD_TABLE . "_update_user = '" . $_SESSION[APP_ID.'user_name'] . "' WHERE " . DLF_MOD_TABLE . "_id = " . $dlf_id;

	return $dlf_sqlstring;
}

function dlf_db_create_mds($dlf_ds) {

	global $dlf_id;
	global $dlf_fieldid;
	$dlf_sqlstring = "";
	
	$dlf_sqlstring = "INSERT INTO " . DLF_MOD_TABLE . " (";
	
	$dlf_i = 0;
	foreach ($dlf_ds as $dlf_field_def) {
		if ($dlf_i > 0) $dlf_sqlstring .= ", "; 
		$dlf_sqlstring .= DLF_MOD_TABLE . "_" . $dlf_field_def["name"];
		$dlf_i += 1;
	}
	$dlf_sqlstring .= ", " . DLF_MOD_TABLE . "_delete, " . DLF_MOD_TABLE . "_insert_date, " . DLF_MOD_TABLE . "_insert_user) VALUES (";
	
	$dlf_i = 0;
	foreach ($dlf_ds as $dlf_field_def) {
		if ($dlf_i > 0) $dlf_sqlstring .= ", ";
		if ($dlf_field_def["format"] != "fixedvalue") { 
			switch ($dlf_field_def["type"]) {
				case "text":
					$dlf_sqlstring .= "'" . $dlf_fieldid[$dlf_field_def["name"]] . "'"; 
					break;
				case "date":
					$dlf_sqlstring .= "'" . $dlf_fieldid[$dlf_field_def["name"]] . "'"; 
					break;
				case "int":
					$dlf_sqlstring .= $dlf_fieldid[$dlf_field_def["name"]]; 
					break;
			}
		} else {
			switch ($dlf_field_def["type"]) {
				case "text":
					$dlf_sqlstring .= "'" . $dlf_field_def["value"] . "'"; 
					break;
				case "date":
					$dlf_sqlstring .= "'" . $dlf_field_def["value"] . "'"; 
					break;
				case "int":
					$dlf_sqlstring .= $dlf_field_def["value"]; 
					break;
			}
		}
		$dlf_i += 1;
	}
	
	$dlf_sqlstring .= ", 0, NOW(),'" . $_SESSION[APP_ID.'user_name'] . "')";
		
	return $dlf_sqlstring;
}

function dlf_display($dlf_datensatz, $dlf_mds_field) {

	$dlf_table_field = DLF_MOD_TABLE . "_" . $dlf_mds_field["name"];
	
	echo "<div>" . $dlf_datensatz[$dlf_table_field] . "</div>";
	
}
*/
?>
