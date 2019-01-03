<?php

/****************************************
dolfIJn
Module straight
SKruIJ 2018-11-22
modules/straight/body.php
where straight module starts // mandatory
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

//just some example what straight could do
//it could simply give some content out:

// database selects on the xstraight table
$inputpara = array("where"=>"");
$count_items = dlf_db_count_onetable("xstraight", $inputpara);
$inputpara = array("where"=>"", "orderby"=>"xstraight_name ASC, xstraight_firstname ASC");
$list_items = dlf_db_list_onetable("xstraight", $inputpara);

// a function to generate a title with header and subheader
echo(dlf_title(MOD_HEADER, MOD_SUBHEADER));

// preparation of the output string
$output = "<div><i>" . MOD_VISIBLE_PUBLIC . "</i></div>";
$output .= "<div>" . MOD_INTRO . "</div>";
$output .= "<div>" . MOD_ACCESS_RIGHTS . ": <b>" . $dlf_access . "</b></div>";	
// output string is shown if at least public rights		
echo(dlf_nonsec_htmlout($output)); 

// a function to generate a vertical space between the paras
echo(dlf_vspace());

$output = "<div><i>" . MOD_VISIBLE_ONLY_READ . "</i></div>";
$output .= "<div>" . MOD_NUMBER_ITEMS . ": <b>" . $count_items . "</b></div>";	
// output string is shown if at least read access	
echo(dlf_nonsec_htmlout($output, "read")); 

echo(dlf_vspace());

$output = "<div><i>" . MOD_VISIBLE_ONLY_WRITE . "</i></div>";
// output string is shown if at least write access
echo(dlf_nonsec_htmlout($output, "write")); 
// list output of the results set if at least "write" access
$inputfields = array("xstraight_name");
$inputheaders = array();
echo(dlf_listout($list_items, $inputfields, $inputheaders, "write"));

echo(dlf_vspace());

$output = "<div><i>" . MOD_VISIBLE_ONLY_ADMIN . "</i></div>";	
// output string shown for admins only
echo(dlf_nonsec_htmlout($output, "admin")); 
$inputfields = array("xstraight_name", "xstraight_firstname", "xstraight_active");
$inputheaders = array("Name", "First name", "Active");
echo(dlf_listout($list_items, $inputfields, $inputheaders, "write"));

echo(dlf_vspace());

$buttonarray = array(array("home", 1));
echo(dlf_buttonwell($buttonarray));


?>