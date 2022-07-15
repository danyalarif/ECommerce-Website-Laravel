<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Credit Card</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/creditcard.css"> 
	<script src="https://use.fontawesome.com/fe91f75b8f.js"></script>
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--------BODY------------>
	<div class="body">
        <div class="container" style="background-color: var(--background);">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-12 col-md-6 card-image-container" style="border-right: 1px solid var(--backgroundTernary);display: flex;justify-content: center;">
                    <img src="./images/card.png" width="400" style="display: block;">
                </div>
                <div class="col-12 col-sm-12 col-md-6" style="margin-top: 2rem;">
					<form action="/creditcard" method="POST">
						@csrf
						<div class="credit-card-header">
							<span>Credit Card Info</span>
						</div>
						<div class="card-inputs-container" style="margin-bottom: 1rem;">
							<div class="col-12">
								<div class="inputfield-container"> 
									<input id="name" type="text" required placeholder="Name">
								</div>
							</div>
							<p id="name-validator"></p>
							<div class="col-12">
								<div class="inputfield-container"> 
									<input id="creditcard" type="text" required placeholder="Card Number">
								</div>
							</div>
							<p id="credit-validator"></p>
							<div class="col-12" style="display: flex;justify-content: center;align-items: center;">
								<div style="width: 90%;display: flex;justify-content: space-between;align-items: center;">
									<div class="input-date-container">
										<label for="card-date">Valid Till: </label>
										<input type="date" id="card-date" style="width: 65%;">
									</div>
									<div class="inputfield-container" style="justify-content: flex-end;margin-bottom: 0;width: 40%;"> 
										<input id="cvc" type="text" required placeholder="CVC" style="width: 100%;">
									</div>
								</div>
							</div>
							<p id="date-validator"></p>
							<p id="cvc-validator"></p>
						</div>
						<div class="credit-card-footer" style="display: flex;justify-content: center;margin-bottom: 1rem;">
							<button type="submit" class="submit-button custom-button-rounded">Submit</button>
						</div>
						<div class="validation container" style="text-align: center;">
							<p style="width: 90%;margin-left:auto;margin-right:auto;" class="validation-para"></p>
						</div>
					</form>
                </div>
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
	<script src="js/creditcard.js"></script>
</body>
</html>