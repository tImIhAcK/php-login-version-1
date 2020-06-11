<?php

require_once '../classes/user.class.php';

require_once('../translations/en.php');


if (isset($_POST['submit'])) {
	$fullname = trim($_POST['fullname']);
	$email = trim($_POST['email']);
	$gsm = trim($_POST['gsm']);
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);
	$password_repeat = trim($_POST['password_repeat']);


	// check provided data validity
    if (Users::query('SELECT email FROM users WHERE email=:email', array(':email'=>$email))) {
 		header("Location: ../views/create-account.php?".MESSAGE_EMAIL_ALREADY_EXISTS);
 	}else{
 	 	if (Users::query('SELECT username FROM users WHERE username=:username', array(':username'=>$username))){
			header("Location: ../views/create-account.php?".MESSAGE_USERNAME_EXISTS);
		}else{
			if (empty($email)) {
				header("Location: ../views/create-account.php?".MESSAGE_EMAIL_EMPTY);
			}else{
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					header("Location: ../views/create-account.php?".MESSAGE_EMAIL_INVALID);
				}else{
					if (empty($username)) {
						header("Location: ../views/create-account.php?".MESSAGE_USERNAME_EMPTY);
					}else{
						if (strlen($username) < 2 || strlen($username) > 60) {
							header("Location: ../views/create-account.php?".MESSAGE_USERNAME_BAD_LENGTH);
						}else{
							if (!preg_match('/^[a-z\d]{2,64}$/i', $username)) {
								header("Location: ../views/create-account.php?".MESSAGE_USERNAME_INVALID);
							}else{
								if (empty($password) || empty($password_repeat)) {
									header("Location: ../views/create-account.php?".MESSAGE_PASSWORD_EMPTY);
								}else{
									if (!strlen($password) > 6) {
										header("Location: ../views/create-account.php?".MESSAGE_PASSWORD_TOO_SHORT);
									}else{
										if ($password !== $password_repeat) {
											header("Location: ../views/create-account.php?".MESSAGE_PASSWORD_BAD_CONFIRM);
										}else{
											// Inserting user into the database
											Users::query('INSERT INTO users VALUES(\'\', :fullname, :email, :gsm, :username, :password)', array(':fullname'=>$fullname, ':email'=>$email, ':gsm'=>$gsm, ':username'=>$username, ':password'=>password_hash($password, PASSWORD_BCRYPT)));
											header("Location: ../views/create-account.php?success");
										}
									}
								}
							}
						}
					}
				}
			}
		}
 	}
}else{
	echo("Error creating user");
}