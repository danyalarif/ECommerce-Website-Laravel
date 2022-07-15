<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css"> 
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!-----BODY----->
	<div class="body">
		<div class="form-container-parent">
			<div class = "form-container">
				<div class="form-header">
					<h3>Welcome</h3>
				</div>
				<div class="inputs">
					<form class="input-form" action="/login" method="POST">
						@csrf
						<div id="emailfield" class="inputfield-container">
							<input id="email" name="email" type="email" required placeholder="Email" value="{{$email ?? ''}}">
						</div>
						<p id="email-validator"></p>
						<div class="inputfield-container">
							<input id="password" name="password" type="password" required placeholder="Password" value="{{$password ?? ''}}">
						</div>
						<p id="login-validator"></p>
						<div class="login-button-container">
							<button class="login-button custom-button" type="submit">SIGN IN</button>
						</div>
					</form>
				</div>
				<div class="login-footer">
					<a data-toggle="modal" data-target="#updatePassword" href="#">Forgot Password?</a>
					<a href="register">Don't have an account?</a>
					<div class="modal fade" id="updatePassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header" style="background-color: var(--backgroundSecondary)">
									<h5 style="color: var(--textColorSecondary)" class="modal-title" id="exampleModalLongTitle">Update Password</h5>
									<button style="color: var(--textColorSecondary)" type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
								</div>
								<form id="forgetPasswordForm" method="POST" action="/updatePassword">
									@csrf
									<div class="modal-body">
										<div class="form-group">
											<input type="text" name="mail" class="form-control" placeholder="Enter your current email">
										</div>
										<div class="form-group">
											<input type="password" name="newPassword" class="form-control" placeholder="Enter your new password">
										</div>
										<div class="form-group">
											<input type="password" name="newConfirmPassword" class="form-control" placeholder="Re-enter your new password">
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn custom-button-secondary" data-dismiss="modal">Close</button>
										<button type="submit" class="btn custom-button">Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="server-error-container"><p>{{Session::get('error') ?? ''}}</p></div>
			</div>
		</div>
	</div>
	<!-------FOOTER------------>
	@component('layouts.components.footer')
	@endcomponent
	<script src="js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/forms.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/login.js"></script>
</body>
</html>