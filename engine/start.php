<?php

/****************************************
dolfIJn
SKruIJ 2018-04-10
/engine/start.php
main engine initialisation
****************************************/

// ü check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

//SKruIJ_20160509: core config integration before php version check to allow to take selected login class into account
// include the core config
if (file_exists("engine/config/config.php")) {
	require("engine/config/config.php");
} else {
	exit('DLF-ERROR 02-01');
}

// include the app config 
if (file_exists("app/engine/config/config.php")) {
	require("app/engine/config/config.php");
} else {
	exit('APP-ERROR 02-02');
}

// check for minimum PHP version > php-login // if DLF_AUTHENTICATION_METHOD = "standard"
if (version_compare(PHP_VERSION, '5.3.7', '<') && DLF_AUTHENTICATION_METHOD == "standard") {
    exit('Sorry, this application does not run on a PHP version smaller than 5.3.7 for standard authentication method. Please use simple authentication');
} else if (version_compare(PHP_VERSION, '5.5.0', '<') && DLF_AUTHENTICATION_METHOD == "standard") {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
	if (file_exists("engine/libraries/password_compatibility_library.php")) {
	    require("engine/libraries/password_compatibility_library.php");
	} else {
		exit('DLF-ERROR 02-17');
	}
}

// set error level depending on develop flag
if (APP_DEVELOP_FLAG == 1) {
	ini_set("error_reporting", 32767);
	ini_set("display_errors", 1);
	ini_set("log_errors", 0);
	ini_set("error_log", "");
} else {
	ini_set("error_reporting", 1);
	ini_set("display_errors", 0);
	ini_set("log_errors", 1);
	ini_set("error_log", "log.txt");
}

// include the core main functions library
if (file_exists("engine/libraries/main.php")) {
	require("engine/libraries/main.php");
} else {
	exit('DLF-ERROR 02-03');
}

// include the app main functions library
if (file_exists("app/engine/libraries/main.php")) {
	require("app/engine/libraries/main.php");
} else {
	exit('APP-ERROR 02-04');
}

// include the PHPMailer library
if (file_exists("engine/classes/PHPMailer/PHPMailerAutoload.php")) {
	require("engine/classes/PHPMailer/PHPMailerAutoload.php");
} else {
	exit('DLF-ERROR 02-05');
}

// include phplot library
if (file_exists("engine/vendors/phplot/phplot.php")) {
	require("engine/vendors/phplot/phplot.php");
} else {
	exit('DLF-ERROR 02-19');
}



// include the PHPMailer library / SMTP
/*
if (file_exists("engine/classes/class.smtp.php")) {
	require("engine/classes/class.smtp.php");
} else {
	exit('DLF-ERROR 02-05b');
}
*/

switch (DLF_AUTHENTICATION_METHOD) {
	case "ldap":
		// load ldap library for ldap authentication
		if (file_exists("engine/libraries/ldap.php")) {
			require("engine/libraries/ldap.php");
		} else {
			exit('DLF-ERROR 02-06');
		}
		// load the login class for ldap authentication
		if (file_exists("engine/classes/login_ldap.php")) {
			require("engine/classes/login_ldap.php");
		} else {
			exit('DLF-ERROR 02-07');
		}
		break;
	case "simple":
		// load the login class for simple authentication
		if (file_exists("engine/classes/login_simple.php")) {
			require("engine/classes/login_simple.php");
		} else {
			exit('DLF-ERROR 02-08');
		}
		break;
	default: // incl "standard"
		// load the login class for the standard authentication
		if (file_exists("engine/classes/login.php")) {
			require("engine/classes/login.php");
		} else {
			exit('DLF-ERROR 02-09');
		}
		
		// load the registration class
		// require("engine/classes/Registration.php");
		break;
}

// create a login object. when this object is created, it will do all login/logout stuff automatically
// so this single line handles the entire login process.
$login = new Login();

// load the main control - all module relevant includes after this main control include only
if (file_exists("engine/libraries/control.php")) {
	require("engine/libraries/control.php");
} else {
	exit('DLF-ERROR 02-10');
}

// load the db control
if (file_exists("engine/libraries/db_control.php")) {
	require("engine/libraries/db_control.php");
} else {
	exit('DLF-ERROR 02-11');
}

// load the input form functions
if (file_exists("engine/libraries/input.php")) {
	require("engine/libraries/input.php");
} else {
	exit('DLF-ERROR 02-12');
}

// load the html output functions
if (file_exists("engine/libraries/output.php")) {
	require("engine/libraries/output.php");
} else {
	exit('DLF-ERROR 02-18');
}

// load the button functions
if (file_exists("engine/libraries/buttons.php")) {
	require("engine/libraries/buttons.php");
} else {
	exit('DLF-ERROR 02-16');
}

// include module elements like config, library module
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
		if (file_exists("modules/" . $dlf_modules . "/engine/config/config.php")) {
			require("modules/" . $dlf_modules . "/engine/config/config.php");
		} else {
			exit('MOD-ERROR 02-13');
		}
				
		// additional library include for module / not mandatory
		if (file_exists("modules/" . $dlf_modules . "/engine/libraries/main.php")) {
			require("modules/" . $dlf_modules . "/engine/libraries/main.php");
		}
}

// SKruIJ_20180302: language setting moved from page.php to here
// Language Setting
$dlf_language = dlf_SetLanguage($dlf_language);

if(APP_OVERWRITE_LANGUAGE_FLAG == 1) {
	if (file_exists("app/engine/languages/overwrite/" . $dlf_language . ".php")) {
		require("app/engine/languages/overwrite/" . $dlf_language . ".php");
	} elseif (file_exists("app/engine/languages/overwrite/" . APP_START_LANGUAGE . ".php")) {
		require("app/engine/languages/overwrite/" . APP_START_LANGUAGE . ".php");
	} elseif (file_exists("app/engine/languages/overwrite/" . DLF_DEFAULT_LANGUAGE . ".php")) {
		require("app/engine/languages/overwrite/" . DLF_DEFAULT_LANGUAGE . ".php");
	} else {
		exit('APP-ERROR 04-01');
	}
} else {
	if (file_exists("engine/languages/" . $dlf_language . ".php")) {
		require("engine/languages/" . $dlf_language . ".php");
	} elseif (file_exists("engine/languages/" . APP_START_LANGUAGE . ".php")) {
		require("engine/languages/" . APP_START_LANGUAGE . ".php");
	} elseif (file_exists("engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php")) {
		require("engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php");
	} else {
		exit('DLF-ERROR 04-02');
	}
}
if (file_exists("app/engine/languages/" . $dlf_language . ".php")) {
	require("app/engine/languages/" . $dlf_language . ".php");
} elseif (file_exists("app/engine/languages/" . APP_START_LANGUAGE . ".php")) {
	require("app/engine/languages/" . APP_START_LANGUAGE . ".php");
} elseif (file_exists("app/engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php")) {
	require("app/engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php");
} else {
	exit('APP-ERROR 04-03');
}

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
		if (file_exists("modules/" . $dlf_modules . "/engine/languages/" . $dlf_language . ".php")) {
			require("modules/" . $dlf_modules . "/engine/languages/" . $dlf_language . ".php");
		} elseif (file_exists("modules/" . $dlf_modules . "/engine/languages/" . APP_START_LANGUAGE . ".php")) {
			require("modules/" . $dlf_modules . "/engine/languages/" . APP_START_LANGUAGE . ".php");
		} elseif (file_exists("modules/" . $dlf_modules . "/engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php")) {
			require("modules/" . $dlf_modules . "/engine/languages/" . DLF_DEFAULT_LANGUAGE . ".php");
		}
	
}




// load the creation of the head string
if (file_exists("engine/libraries/head_creator.php")) {
	require("engine/libraries/head_creator.php");
} else {
	exit('DLF-ERROR 02-14');
}
		
// load the error and messages creation
if (file_exists("actions/error_messages_creator.php")) {
	require("actions/error_messages_creator.php");
} else {
	exit('DLF-ERROR 02-15');
}

?>