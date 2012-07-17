<?php

	
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<title>CPanel Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<link rel="stylesheet" href="<?=BASEURL?>public/css/jquery-ui.custom.css" type="text/css" />
	<link rel="stylesheet" href="<?=BASEURL?>public/css/login.css" type="text/css" />
	
		
</head>
<body>


<div id="wrapper" align="center">
	<br /><br /><br />
	<div id="login-wrapper">
		<div align="center">
			<h1><font style="color: #1f1f1f">Authentication Test</font></h1>
		</div>
		<div id="content-wrapper" align="center">
			<form action="" id="login" method="post">
				<p>
					<label for="username">Username</label>
					<br />
					<input type="text" id="username" name="username" class="half" />
				</p>

				<p>
					<label for="password">Password</label>
					<br />
					<input type="password" id="password" name="password" class="half" />
				</p>
				
				<p>
					<input type="submit" value="Login" name="submit" width="50px" />
				</p>
				
			</form>
		</div>
	</div>

	<br /><br />
	<hr />
	<div id='footer'>
		Copyright &copy; 2011-<?=date("Y");?> RedtagVacations. All rights reserved.
	</div>
</div>


<script src="<?=BASEURL?>public/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=BASEURL?>public/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?=BASEURL?>public/js/jquery.placeholder.min.js" type="text/javascript"></script>

<script type="text/javascript">

$(document).ready(function() {


	$('input[placeholder], textarea[placeholder]').placeholder();
	
	$("form#login").validate({
		rules: {
			username: "required",
			password: "required"
		},
		messages: {
			username: 		" (Enter your Username)",
			password: 	" (Enter your password)"
		},
		errorPlacement: function(error, element) {
			error.insertAfter(element.parent().find('label:first'));
		},
		success: function(label) {
			label.html("&nbsp;").addClass("success");
		}
	});
			
});
</script>



</body>
</html>

