<?php
	
//include the user class
require_once ('../classes/user.class.php');

// load the login class
require_once('../classes/login.class.php');

include "_header.php";

$userid = Login::isLoggedIn();
$name = Users::query('SELECT username FROM users WHERE id=:userid', array(':userid'=>$userid))[0]['username'];
?>

<div>
	<h2>Welcome, <?= $name ?></h2><p /><p />
	<form action="../includes/logout.inc.php" method="POST">
		<input type="checkbox" name="alldevices" value="alldevices">Logout from all devices<p />
	<button type="submit" name="submit">Logout</button>
</form>
</div>

<?php
	include "_header.php";
?>