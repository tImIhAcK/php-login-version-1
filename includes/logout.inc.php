<?php

include '../classes/user.class.php';


include '../classes/login.class.php';


if(!Login::isLoggedIn()){
	die('Not logged in');
}

if (isset($_POST['submit'])) {
	if (isset($_POST['alldevices'])) {
		Users::query('DELETE FROM login_tokens WHERE user_id=:userid', array(':userid'=>Login::isLoggedIn()));
	}else{
		if (isset($_COOKIE['SNID'])) {
			Users::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])));
		}
		setcookie('SNID', '1', time()-3600);
		setcookie('SNID_', '1', time()-3600);
	}
	header("Location: ../index.php");
}

?>