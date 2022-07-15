<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	<title>Wishlist</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/cart.css"> 
	<link rel="stylesheet" href="css/wishlist.css"> 
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
                    <span class="heading">MY WISHLIST</span>
                </div>
                <div class="col-6 col-sm-4 cart-items-no-container">
                    <span id="total">1</span>
                    <span class="heading">ITEMS</span>
                </div>
                <div class="col-6 col-sm-3 cart-items-no-container">
                    <button class="custom-button-rounded">CLEAR WISHLIST</button>
                </div>
            </div>
        </div>
        <div class="container items-container" style="padding-top: 1rem;padding-bottom: 1rem;">
			@foreach ($wishlist as $product)
            <div id="{{$product->idProducts}}" class="row item-container" style="background-color: var(--background);margin-bottom: 1rem;">
                <div class="col-12 item-header">
                    <span class="product-title">{{$product->name}}</span>
                    <span class="product-category">{{$product->categoryName}}</span>
                    <span class="product-sub-category">{{$product->title}}</span>
                </div>
                <div class="col-12 col-sm-4 product-image-div" style="margin: 0.5rem 0">
                    <div class="image-container">
                        <img class="product-image" src="{{$product->image}}">
                    </div>
				</div>
				<div class="col-12 col-sm-5 product-data-container align-self-center">
					<div class="price-container">
						<span>Rs. </span><span class="product-price">{{$product->producingCost + ($product->producingCost * ($product->profit / 100))}}</span>
					</div>
					<div class="date-container">
						<span>Added on: <span>{{$product->addedOn}}</span></span>
					</div>
				</div>
				<div class="col-12 col-sm-3 product-delete-container align-self-center">
					<div class="product-delete-button-container">
						<button class="delete-button custom-button-rounded"><i class="fa fa-trash"></i></button>
						<button class="cart-button custom-button-rounded"><i class="fa fa-shopping-cart"></i></button>
					</div>
				</div>
            </div>
			@endforeach
        </div>
		<div class="container button-container">
			<div class="row">
				<div class="col-12">
					<div class="checkout-button-container d-flex justify-content-center">
						<button id="add-all-to-cart" class="custom-button-rounded">ADD ALL TO CART</button>
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
	<script src="js/wishlist.js"></script>
</body>
</html>