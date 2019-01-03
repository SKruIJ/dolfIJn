<?php

/****************************************
app
SKruIJ 2019-01-03
/app/config/config.php
app configuration
ü
****************************************/

// check if #key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// version and release of the app
// YYYYMMDD = release date
// XX = Interim incrementer
define("APP_VERSION", "2018031501");
// Human-friendly version name
define("APP_RELEASE", "1.0.2");
// core title, will be displayed in the footer together with copyright
define("APP_TITLE", "dolfIJn:pt");
// copyright, will be displayed in the footer
define("APP_COPYRIGHT", "&copy; 2016-2018 SKruIJ");
// author for meta data
define("APP_AUTHOR", "SKruIJ");
// description for meta data
define("APP_DESCRIPTION", "app ... yet another stuff");

// APP ID used to avoid conflicts between several installed apps based on dolfijn, eg on session variables / cookies / database
// !!! dlf is not allowed
define("APP_ID", "dpt");

// debug mode on(1) or off(0) // in debug mode additional fields and outputs are shown of hidden information
define("APP_DEBUG_FLAG", 0);

// develop mode on(1) of off(0) // defines the error level
define("APP_DEVELOP_FLAG", 1);

// standard pagination limit
define("DLF_PAGINATION_LIMIT", 10);

// Authentication method "ldap"/"standard"/"simple"
define("DLF_AUTHENTICATION_METHOD", "standard");


// Configuration for: Database Connection
// This is the place where your database login constants are saved
// Acer NoteBook
define("DLF_DB_HOST", "localhost");
define("DLF_DB_NAME", "dpt");
define("DLF_DB_USER", "root");
define("DLF_DB_PASS", "");


/**
 * Configuration for: Cookies
 * Please note: The DLF_COOKIE_DOMAIN needs the domain where your app is,
 * in a format like this: .mydomain.com
 * Note the . in front of the domain. No www, no http, no slash here!
 * For local development .127.0.0.1 or .localhost is fine, but when deploying you should
 * change this to your real domain, like '.mydomain.com' ! The leading dot makes the cookie available for
 * sub-domains too.
 * @see http://stackoverflow.com/q/9618217/1114320
 * @see http://www.php.net/manual/en/function.setcookie.php
 *
 * DLF_COOKIE_RUNTIME: How long should a cookie be valid ? 1209600 seconds = 2 weeks
 * DLF_COOKIE_DOMAIN: The domain where the cookie is valid for, like '.mydomain.com'
 * DLF_COOKIE_SECRET_KEY: Put a random value here to make your app more secure. When changed, all cookies are reset.
 */
define("DLF_COOKIE_RUNTIME", 4838400);
define("DLF_COOKIE_DOMAIN", ".localhost");
define("DLF_COOKIE_SECRET_KEY", "1gSK361wq$78sfpMJFe-93s");



/**
 * Configuration for: Email server credentials
 *
 * Here you can define how you want to send emails.
 * If you have successfully set up a mail server on your linux server and you know
 * what you do, then you can skip this section. Otherwise please set DLF_EMAIL_USE_SMTP to true
 * and fill in your SMTP provider account data.
 *
 * An example setup for using gmail.com [Google Mail] as email sending service,
 * works perfectly in August 2013. Change the "xxx" to your needs.
 * Please note that there are several issues with gmail, like gmail will block your server
 * for "spam" reasons or you'll have a daily sending limit. See the readme.md for more info.
 *
 * define("DLF_EMAIL_USE_SMTP", true);
 * define("DLF_EMAIL_SMTP_HOST", "ssl://smtp.gmail.com");
 * define("DLF_EMAIL_SMTP_AUTH", true);
 * define("DLF_EMAIL_SMTP_USERNAME", "xxxxxxxxxx@gmail.com");
 * define("DLF_EMAIL_SMTP_PASSWORD", "xxxxxxxxxxxxxxxxxxxx");
 * define("DLF_EMAIL_SMTP_PORT", 465);
 * define("DLF_EMAIL_SMTP_ENCRYPTION", "ssl");
 *
 * It's really recommended to use SMTP!
 *
 */
define("DLF_EMAIL_USE_SMTP", false);
define("DLF_EMAIL_SMTP_HOST", "yourhost");
define("DLF_EMAIL_SMTP_AUTH", true);
define("DLF_EMAIL_SMTP_USERNAME", "yourusername");
define("DLF_EMAIL_SMTP_PASSWORD", "yourpassword");
define("DLF_EMAIL_SMTP_PORT", 465);
define("DLF_EMAIL_SMTP_ENCRYPTION", "ssl");

// 20170518_SKruIJ: additional parameters for SMTP to cover in case it's not defined in the email template
define("DLF_EMAIL_FROM", "admin@kruijer-net.eu");
define("DLF_EMAIL_FROMNAME", "Administrator kruijer-net");

/**
 * Configuration for: password reset email data
 * Set the absolute URL to password_reset.php, necessary for email password reset links
 */
define("DLF_EMAIL_PASSWORDRESET_URL", "http://kruijer-net.de/test2/test_php_login/password_reset.php");
define("DLF_EMAIL_PASSWORDRESET_FROM", "no-reply@kruijer-net.de");
define("DLF_EMAIL_PASSWORDRESET_FROM_NAME", "test_php_login");
define("DLF_EMAIL_PASSWORDRESET_SUBJECT", "Password reset for test_php_login");
define("DLF_EMAIL_PASSWORDRESET_CONTENT", "Please click on this link to reset your password:");

/**
 * Configuration for: verification email data
 * Set the absolute URL to register.php, necessary for email verification links
 */
define("DLF_EMAIL_VERIFICATION_URL", "http://kruijer-net.de/test2/test_php_login/register.php");
define("DLF_EMAIL_VERIFICATION_FROM", "no-reply@kruijer-net.de");
define("DLF_EMAIL_VERIFICATION_FROM_NAME", "test_php_login");
define("DLF_EMAIL_VERIFICATION_SUBJECT", "Account activation for test_php_login");
define("DLF_EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account:");

// flag if the app is integrated as iframe which includes an scroll to top onload
define("APP_IFRAME_FLAG", 0);

// flag if tenants should be supported (1) or not (0)
define("APP_TENANTS_FLAG", 1);

// start language setting for the app
define("APP_START_LANGUAGE", "en-en");

// overwrite core language files
define("APP_OVERWRITE_LANGUAGE_FLAG", 0);

// language selection flag for the app; selection an (1) oder aus (0)
define("APP_LANGUAGE_SELECTION_FLAG", 0);

// app as webapp (1) or not (0)
define("APP_WEBAPP", 0);

// app as webapp in maxscale = 1 (1) or not (0)
define("APP_WEBAPP_MAXSCALE", 0);

// app as webapp in minscale = 1 (1) or not (0)
define("APP_WEBAPP_MINSCALE", 0);

// standard screen
define("APP_SCREEN", "default");

// start module: home or specific module
define("APP_START_MODULE", "home");

// header display flag
define("APP_HEADER_DISPLAY_FLAG", 1);

// header for login display flag
define("APP_HEADER_LOGIN_DISPLAY_FLAG", 0);

// header for public display flag
define("APP_HEADER_PUBLIC_DISPLAY_FLAG", 0);

// menu display flag
define("APP_MENU_DISPLAY_FLAG", 1);

// menu for public display flag
define("APP_MENU_PUBLIC_DISPLAY_FLAG", 0);

// breadcrump display flag
define("APP_BREADCRUMB_DISPLAY_FLAG", 1);

// breadcrump for public display flag
define("APP_BREADCRUMB_PUBLIC_DISPLAY_FLAG", 0);

// footer display flag
define("APP_FOOTER_DISPLAY_FLAG", 1);

// footer for login display flag
define("APP_FOOTER_LOGIN_DISPLAY_FLAG", 1);

// footer for public display flag
define("APP_FOOTER_PUBLIC_DISPLAY_FLAG", 1);

// colour for meta theme-color as rgb
define("APP_META_THEME_COLOR", "#095d7c");

// colour for meta msapplication-TileColor as rgb
define("APP_META_MSAPPLICATION_TILECOLOR", "#ffffff");

?>
