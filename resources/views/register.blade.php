<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/forms.css">
	<link rel="stylesheet" href="css/register.css"> 
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--BODY-->
	<div class="body">
		<form action="/register" method="POST">
			@csrf
			<div class="form-container-parent">
				<div class = "form-container">
					<div class="form-header">
						<h3>Welcome</h3>
					</div>
					<div class="inputs">
						<div class="input-form">
							<div class="inputfield-container">
								<input style="display: block;" id="name" type="text" required placeholder="Name" name="name">
							</div>
							<p id="name-validator"></p>
							<div id="emailfield" class="inputfield-container">
								<input id="email" type="email" required placeholder="Email" name="email">
							</div>
							<p id="email-validator"></p>
							<div class="inputfield-container">
								<input id="password" type="password" required placeholder="Password" name="password">
							</div>
							<p id="password-validator"></p>
							<div class="inputfield-container">
								<input id="confirmPassword" type="password" required placeholder="Re-enter Password" name="confirmPassword">
							</div>
							<p id="confirmPassword-validator"></p>
							<div class="inputfield-container">
								<input id="mobileNumber" type="tel" required placeholder="Mobile Number" name="mobileNumber">
							</div>
							<p id="mobileNumber-validator"></p>
							<div class="inputfield-container">
								<input id="address" type="text" required placeholder="Address" name="address">
							</div>
							<p id="address-validator"></p>
						</div>
					</div>
					<div class="form-footer">
						<button id="registerButton" class="custom-button">Register</button>
						<button id="loginButton" class="custom-button custom-button-secondary">Login</button>
					</div>
					<div class="server-error-container">
						<?php
							if (isset($error)){
								print(
									'<p>'.$error.'</p>'
								);
							}
						?>
					</div>
				</div>
			</div>
		</form>
	</div>
	<!-------FOOTER------------>
	@component('layouts.components.footer')
	@endcomponent
	<script src="js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/register.js"></script>
</body>
</html>