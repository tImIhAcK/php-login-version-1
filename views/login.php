<?php 
	include_once "_header.php";
?>
<form action="../includes/login.inc.php" class="login-form" method="POST">
	<h1>Login</h1>
	<div class="txtb">
		<input type="text" name="uname">
		<span data-placeholder="Username/Email"></span>
	</div>
	<div class="txtb">
		<input type="password" name="pwd">
		<span data-placeholder="Password"></span>
	</div>

	<input type="submit" class="logbtn" name="submitBtn" value="Login">

	<div class="bottom-text">
		Don't have account? <a href="create-account.php">Sign up</a>
	</div>
</form>
<script src="../js/jquery.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(".txtb input").on("focus", ()=> {
		$(this).addClass("focus");
	});

	$(".txtb input").on("blur", ()=>{
		if ($(this).val() == "") {
			$(this).removeClass("focus");
		}
	});
</script>

<?php 
	include_once "_footer.php";
?>