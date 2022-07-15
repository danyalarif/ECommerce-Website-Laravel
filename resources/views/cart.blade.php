<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	<title>Cart</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/cart.css"> 
	<script src="https://use.fontawesome.com/fe91f75b8f.js"></script>
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--------BODY------------>
	<div class="body">
        <div class="container" style="background-color: var(--background);margin-bottom: 1rem;">
            <div class="row cart-header-row">
                <div class="col-6 col-sm-5 cart-header-container">
                    <span class="red-border"></span>
                    <span class="heading">SHOPPING CART</span>
                </div>
                <div class="col-6 col-sm-4 cart-items-no-container">
                    <span class="cart-count"></span>
                    <span class="heading">ITEMS</span>
                </div>
                <div class="col-6 col-sm-3 cart-items-no-container">
                    <button class="cart-empty-button custom-button-rounded">EMPTY CART</button>
                </div>
            </div>
        </div>
        <div class="container items-container">
        </div>
		<div class="container">
			<div class="row justify-content-center">
				<div class="summary-container-parent">
					<div class="summary-header">
						<span>Order Summary</span>
					</div>
					<div id="summary-p">
						<div class="summary-container">
							<div class="row summary-row">
								<div class="col-6">
									<span>Sub-total</span>
								</div>
								<div class="col-6 d-flex justify-content-end">
									<span class="price">Rs. <span id="subtotal"></span></span>
								</div>
							</div>
							<div class="row summary-row">
								<div class="col-6">
									<span>Shipping fee</span>
								</div>
								<div class="col-6 d-flex justify-content-end">
									<span class="price">Rs. <span id="fee"></span></span>
								</div>
							</div>
							<div class="row summary-row total-price-container">
								<div class="col-6">
									<span>Total</span>
								</div>
								<div class="col-6 d-flex justify-content-end">
									<span class="price">Rs. <span id="total"></span></span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container button-container">
			<div class="row">
				<div class="col-12">
					<div class="checkout-button-container d-flex justify-content-center">
						<button id="checkoutButton" class="custom-button-rounded">CHECKOUT</button>
					</div>
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
	<script src="js/cart.js"></script>
</body>
</html>