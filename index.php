<?php
/**
 * A simple PHP Login Script 
 *
 * @author Panique
 * @link http://www.php-login.net
 * @link https://github.com/tImIhAcK/php-login-version-1/
 */

// include the to-be-used language, english by default. feel free to translate your project and include something else
require_once('translations/en.php');

// load the user class
require_once('classes/user.class.php');

// load the login class
require_once('classes/login.class.php');


// ... ask if we are logged in here:
if (Login::isLoggedIn()) {

	// Take user to the home page if they are logged in
	header("Location: views/home.php");
	
}else{
	// Take user to the login page if not logged in
	header("Location: views/login.php");
}
