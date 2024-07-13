<?php

// app mode (prod/dev)
define("MODE", "dev"); // set this value to 'prod' when using in production mode (case sensitive)

// database configurations
define("HOST", "localhost");

define("USER", "root"); //u727508198_Xoy75

define("DATABASE", "event_2"); //u727508198_6qoJ5

define("PASSWORD", ""); //ftp123F#


// payment gateway details
define("KEYID", "rzp_test_j6d5FgCcESZyR7");
define("KEYSECRET", "IqHE3voRQDG8F3");
define("DISPLAYCURRENCY", "INR");

//  database configuration details where the information of the USERS are stored
define("USERSHOST", "localhost");

define("USERSUSER", "root"); //u727508198_Xoy75

define("USERSDATABASE", "event_2"); //u727508198_6qoJ5

define("USERSPASSWORD", ""); //ftp123F#



/**
 * Auto - generated values below
 * Do not change anything
 */

// base url
define('BASE', getBaseUrl());

// csrf token
define('CSRF', md5(uniqid(rand(), true)));