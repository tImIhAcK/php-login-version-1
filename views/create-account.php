<?php
	include '_header.php';
?>


	<div class="above">
	<h1>Register</h1>
	<form class="" action="../includes/create-account.inc.php" method="POST">
		<input type="text" name="fullname" value="" placeholder="Fullname"><p />
		<input type="text" name="email" value="" placeholder="Email address"><p />
		<input type="text" name="gsm" value="" placeholder="Phone number"><p />
		<input type="text" name="username" value="" placeholder="Username"><p />
		<input type="password" name="password" value="" placeholder="Password"><p />
		<input type="password" name="password_repeat" value="" placeholder="Retype password"><p />
		<input type="submit" name="submit" value="Register" />

	</form>
	</div>
	<div class="below">
		<div class="foo2">
			<span><a href="login.php">Back to Login page</a></span>
		</div>
	</div>

<?php
	include '_footer.php';
?>