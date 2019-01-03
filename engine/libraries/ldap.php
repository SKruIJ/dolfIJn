<?php

/****************************************
dolfIJn
SKruIJ 2016-03-02
/engine/libraries/ldap.php
ldap library for ldap authentication
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

$ldap_hostname = DLF_LDAP_HOSTNAME;
$ldap_base_dn = DLF_LDAP_BASE_DN;  
$ldap_search_user = DLF_LDAP_SEARCH_USER;
$ldap_search_pass = DLF_LDAP_SEARCH_PASS;
$ldap_search_dn = DLF_LDAP_SEARCH_DN;
$ldap_search_uid = DLF_LDAP_SEARCH_UID;

/**
* ldap_auth
*
* Authentifizierung gegen EU-Domain
*/
function ldap_auth ($username, $password) {
  global $ldap_hostname,$ldap_base_dn,$ldap_search_user,$ldap_search_pass,$ldap_search_dn,$ldap_search_uid;
  // turn off reporting errors in case the password  will be incorrect during binding
  $reporting = error_reporting( E_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_USER_ERROR );
  $result = '';
  do {
    # Connect to LDAP server
    $con = @ldap_connect($ldap_hostname);
    if (!$con) {
      $result = 'No connection to server possible';
      break;
    }
    # Bind to server
    $search_bind = @ldap_bind($con, $ldap_search_user, $ldap_search_pass);
    if (!$search_bind) {
      $result = 'Bind not possible';
      break;
    }
    # Search for the user's complete DN
    $atts = array('dn');
    $search = @ldap_search($con, $ldap_search_dn, "$ldap_search_uid=$username", $atts);
    if (!$search) {
      $result = 'User-dn search not possible';
      break;
    }
    $info = @ldap_get_entries($con, $search);
    if (!$info || (0 == $info['count'])) {
      $result = LDAP_INVALID_USERNAME;
      break;
    }
    $bind_dn = $info[0]["dn"];
    # If $bind_dn is empty the next ldap_bind command would try to perform an
    # anonymous bind instead of using the given password. This would result in an successful
    # authentication, no matter what the user enters as a password, which is an invalid behaviour.
    # So we have to check $bind_dn
    if (empty($bind_dn)) {
      $result = 'User\'s dn is empty';
      break;
    }
    # Bind with user and password
    $bind = @ldap_bind($con, $bind_dn, $password);
    if (!$bind) {
      $result = LDAP_INVALID_PASSWORD;
    }
    else {
      $result = LDAP_AUTH_OK;
    }
    # close connection
    $close = @ldap_close($con);
    break;
  } while (FALSE);
  error_reporting($reporting);
  return $result;
}
/**
* getfromldap
*
* User-Attribute aus der EU-Domain zur?ckgeben
*/
function getfromldap($userid)
{
    global $ldap_hostname,$ldap_base_dn,$ldap_search_user,$ldap_search_pass,$ldap_search_dn,$ldap_search_uid;
    /* --------------  query LDAP-Server ----------------- */
    $ds  = ldap_connect($ldap_hostname);
	  ldap_set_option($ds,LDAP_OPT_PROTOCOL_VERSION,3);
	  $bind = ldap_bind($ds,$ldap_search_user,$ldap_search_pass);
    // is a userid already entered ? Yes ? Then retreive information.
    if (isset($userid))
    {
       $sr=ldap_search ($ds, $ldap_search_dn, $ldap_search_uid.'=' . $userid);
       $info = ldap_get_entries($ds, $sr);
       //var_dump($info);
       $user['mail'] = $info[0][mail][0];
       $user['gn'] = $info[0][givenname][0];
       $user['sn'] = $info[0][sn][0];
       $user['department'] = $info[0][department][0];
       $user['l'] = $info[0][l][0];       
       $user['phone'] = $info[0][telephonenumber][0];              
       return ($user);
    }
    /* --------------------------------------------------- */
}

// $test = getfromldap("th65k2");
// var_dump($test);

?>