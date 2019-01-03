<?php

/****************************************
dolfIJn
/engine/config/config.php
core configuration
ü
****************************************/

// check if key is set, otherwise the script is stopped here
if (DLF_SECURE_KEY != "dolfIJn2015") exit("Unauthorised script access");

// version and release of the core
// YYYYMMDD = release date
// XX = Interim incrementer
define("DLF_VERSION", "2019010301");
// Human-friendly version nam
define("DLF_RELEASE", "1.1.0");
// core title, will be displayed in the footer together with copyright
define("DLF_TITLE", "dolfIJn");
// copyright, will be displayed in the footer
define("DLF_COPYRIGHT", "2015-2019 SKruIJ");

// 20170709_SKruIJ: new DLF ID
// DLF ID for identification of dlf core elements
define("DLF_ID", "dlf");

// default language setting defines the standard language in case other app language and module language can't be found
define("DLF_DEFAULT_LANGUAGE", "en-en");


/**
 * Configuration for: Hashing strength
 * This is the place where you define the strength of your password hashing/salting
 *
 * To make password encryption very safe and future-proof, the PHP 5.5 hashing/salting functions
 * come with a clever so called COST FACTOR. This number defines the base-2 logarithm of the rounds of hashing,
 * something like 2^12 if your cost factor is 12. By the way, 2^12 would be 4096 rounds of hashing, doubling the
 * round with each increase of the cost factor and therefore doubling the CPU power it needs.
 * Currently, in 2013, the developers of this functions have chosen a cost factor of 10, which fits most standard
 * server setups. When time goes by and server power becomes much more powerful, it might be useful to increase
 * the cost factor, to make the password hashing one step more secure. Have a look here
 * (@see https://github.com/panique/php-login/wiki/Which-hashing-&-salting-algorithm-should-be-used-%3F)
 * in the BLOWFISH benchmark table to get an idea how this factor behaves. For most people this is irrelevant,
 * but after some years this might be very very useful to keep the encryption of your database up to date.
 *
 * Remember: Every time a user registers or tries to log in (!) this calculation will be done.
 * Don't change this if you don't know what you do.
 *
 * To get more information about the best cost factor please have a look here
 * @see http://stackoverflow.com/q/4443476/1114320
 *
 * This constant will be used in the login and the registration class.
 */
define("DLF_HASH_COST_FACTOR", "10");

?>
