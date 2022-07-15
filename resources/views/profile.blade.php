<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/profile.css"> 
	<script src="https://use.fontawesome.com/fe91f75b8f.js"></script>
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--------BODY------------>
	<div class="body">
        <div class="container account-container" style="background-color: var(--background);">
            <div class="row">
                <div class="col-12">
                    <span style="font-weight: bold;font-size: 1.5rem;">My Account</span>
                </div>
            </div>
            <div class="dropdown-divider"></div>
            <div class="row profile-div-container">
                <div class="col-6">
                    <span class="head">Name</span>
                </div>
                <div class="col-6">
                    <span class="answer">{{$user->name}}</span>
                </div>
                <div class="col-6">
                    <span class="head">Email</span>
                </div>
                <div class="col-6">
                    <span class="answer">{{$user->email}}</span>
                </div>
                <div class="col-6">
                    <span class="head">Mobile Number</span>
                </div>
                <div class="col-6">
                    <span class="answer">{{$user->mobilenumber}}</span>
                </div>
                <div class="col-6">
                    <span class="head">Address</span>
                </div>
                <div class="col-6">
                    <span class="answer">{{$user->address}}</span>
                </div>
				<div class="col-6">
                    <span class="head">Balance</span>
                </div>
                <div class="col-6">
                    <span class="answer">Rs. <span>{{$user->balance}}</span></span>
                </div>
				<div class="col-12">
                    <a href="{{'/logout?userid='.$user->idUser}}" style="color: var(--backgroundSecondary);font-size: 1.25rem;" class="answer">Logout</a>
                </div>
            </div>
        </div>
		<div class="container" style="background-color: var(--background);margin-top: 2rem;">
			<div class="row">
				<div class="col-12">
                    <span style="font-weight: bold;font-size: 1.5rem;">Payments</span>
                </div>
			</div>
			<div class="dropdown-divider"></div>
			<div class="row">
				<div class="col-12">
					<div class="checkout-button-container d-flex justify-content-center">
						<button class="add-card-button custom-button-rounded"><i class="fa fa-plus"></i> ADD CREDIT CARD</button>
					</div>
				</div>
				<div class="col-12" style="margin-top: 1rem;">
					<div class="checkout-button-container d-flex justify-content-center" style="margin-bottom: 1rem;">
						<button class="deposit-button custom-button-rounded"><i class="fa fa-money"></i> DEPOSIT</button>
					</div>
				</div>
				<div id="isCredit" style="display: none;">{{$user->isCreditCard}}</div>
			</div>
			<div class="row deposit-amount-container">
				<form action="/profile" method="POST">
					@csrf
					<div class="col-12 d-flex justify-content-center" style="margin-top: 1rem;">
						<div class="inputfield-container" style="width: 40%;"> 
							<input name="amount" id="amount" type="text" required placeholder="Amount">
						</div>
					</div>
					<div class="col-12" style="margin-top: 1rem;">
						<div class="checkout-button-container d-flex justify-content-center" style="margin-bottom: 1rem;">
							<button type="submit" class="deposit-submit-button custom-button-rounded"><i class="fa fa-check-circle"></i></button>
						</div>
					</div>
					<p class="amount-validator" style="margin-top: 0.5rem;text-align: center; color: var(--backgroundSecondary);"></p>
				</form>
			</div>
		</div>
	</div>
	<!-------FOOTER------------>
	@component('layouts.components.footer')
	@endcomponent
	<script src="js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/profile.js"></script>
</body>
</html>