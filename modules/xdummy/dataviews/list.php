<?php

/****************************************
dolfIJn
Module xdummy
SKruIJ 2018-12-04
modules/xdummy/dataviews/list.php
dataview screen for full list display
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_LIST_SUBHEADER));

// a function to generate an intro para
echo(dlf_intro(MOD_LIST_INTRO));

// a function to generate a vertical space between the paras
echo(dlf_vspace());


if (!$dlf_error_flag) {
	
	// database selects on the xdummy table
	$inputpara = array("where"=>"");
	$count_items = dlf_db_count_onetable("xdummy", $inputpara);
	$inputpara = array("where"=>"", "orderby"=>"xdummy_name ASC, xdummy_vorname ASC");
	$list_items = dlf_db_list_onetable("xdummy", $inputpara);
	
	if ($count_items > 0) {
		
		echo "Die Abfrage lieferte <strong>" . $count_items .  "</strong> Datensatz/Datensätze.";
		
		echo(dlf_vspace());
			
		$inputfields = array("xdummy_name", "xdummy_vorname", "xdummy_active");
		$inputheaders = array("Name", "Vorname", "Active");
		$inputpara = array("headers"=>$inputheaders, "fields"=>$inputfields, "access"=>"read", "notactive"=>"1");
		echo(dlf_listout_edit($list_items, $inputpara));
		
		
	} else {

		echo "Es konnten keine Datensätze gefunden werden.";
		
	}

} else {
	
	echo(dlf_intro(MOD_LIST_ERROR));
	
}

echo(dlf_vspace());

$inputpara = array("icon"=>"retweet", "text"=>MOD_BUTTON_DEFAULT);
$buttonarray = array(array("home", 1), array("default", 4, $inputpara));
echo(dlf_buttonwell($buttonarray));



?>