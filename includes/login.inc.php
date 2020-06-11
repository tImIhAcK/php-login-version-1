<?php

//include the user class
require_once ('../classes/user.class.php');


const COOKIE_RUNTIME = 604800; // Cookie expire after 7 days if user do not log in
const COOKIE_RUNTIME_ = 259200; // Renew cookie every 3 days when user log in

	
if (isset($_POST['submitBtn'])) {
	$uname = trim($_POST['uname']);
	$pwd = trim($_POST['pwd']);

	if (Users::query('SELECT username FROM users WHERE username=:uname', array(':uname'=>$uname))){
		$hashedPwd = Users::query('SELECT password FROM users WHERE username=:uname', array(':uname'=>$uname))[0]['password'];
		if (password_verify($pwd, $hashedPwd)) {
			$cstrong = True;
			$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
			$user_id = Users::query('SELECT id FROM users WHERE username=:uname', array(':uname'=>$uname))[0]['id'];
			Users::query('INSERT INTO login_tokens VALUES(\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$user_id));
			setcookie('SNID', $token, time() + COOKIE_RUNTIME, '/', NULL, NULL, TRUE);
			setcookie('SNID_', '1', time() + COOKIE_RUNTIME_, '/', NULL, NULL, TRUE);

			
			header("Location: ../views/home.php");
		}else{
			header("Location: ../views/login.php?incorrect_password");
		}
	}else{
		header("Location: ../views/login.php?no_account");
	}
}
?>