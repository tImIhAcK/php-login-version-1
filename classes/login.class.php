<?php

//include the user class
require_once ('user.class.php');

/*=========================================================================================================
 * The Login Class generate a tokin for the user anytime they logged in
 * @return userid => The user login ID is returned
 * @ return fasle => The user is not assigned a token and not logged in
 =========================================================================================================*/
class Login extends Users
{
	const COOKIE_RUNTIME = 604800; // Cookie expire after 7 days if user do not log in
	const COOKIE_RUNTIME_ = 259200; // Renew cookie every 3 days when user log in

	public static function isLoggedIn()
	{
		if (isset($_COOKIE['SNID'])) {
			if (Users::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))) {
				$userid = Users::query('SELECT user_id FROM login_tokens WHERE token=:token', array(':token'=>sha1($_COOKIE['SNID'])))[0]['user_id'];
				if (isset($_COOKIE['SNID'])) {
					$cstrong = True;
					// Generating the token
					$token = bin2hex(openssl_random_pseudo_bytes(64, $cstrong));
					//Inserting the token to the database and Deleting the previous token if user login again
					Users::query('INSERT INTO login_tokens VALUES(\'\', :token, :user_id)', array(':token'=>sha1($token), ':user_id'=>$userid));
					Users::query('DELETE FROM login_tokens WHERE token=:token', array(':token'=>$_COOKIE['SNID']));

					// Setting the cookie to expire after 12 WEEKS  is  user login every 3WEEKS
					//
					setcookie('SNID', $token, time() + self::COOKIE_RUNTIME, '/', NULL, NULL, TRUE);
					setcookie('SNID_', '1', time() + self::COOKIE_RUNTIME_, '/', NULL, NULL, TRUE);

					return $userid;
				}
			}
		}
		return false;
	}
}