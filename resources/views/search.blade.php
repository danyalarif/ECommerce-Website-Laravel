<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Results</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css"> 
	<script src="https://use.fontawesome.com/fe91f75b8f.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--------BODY------------>
	<div class="body">
		<div class="container">
			<div class="row">
				<div class="countdown-container">
					<span class="countdown-border"></span>
					<span class="countdown-heading" id="category-title">{{'Results for '.$term}}</span>
				</div>
				<div style="width: 100%;" class="dropdown-divider"></div>
			</div>
			<div class="row product-row" style="margin-top: 1rem;">
				@foreach($products as $product)
				<div class="product-container product-main col-12 col-sm-6 col-md-3 col-lg-2 col-xl-2" id="{{$product->idProducts}}">
					<div class="product">
						<div class="product-image-container">
							<img class="product-image" src="{{$product->image}}">
						</div>
						<div class="product-body">
							<div class="product-category-container">
								<a href="{{'category?category='.$product->title}}" class="product-category">{{$product->title}}</a>
								<span class="product-mainCategory" style="display: none;" hidden>{{$product->categoryName}}</span>
							</div>
							<div class="product-name-container">
								<span class="product-name">{{$product->name}}</span>
							</div>
							<div class="product-price-container">
								<span class="product-price-label">Rs.</span>
								<span class="product-price">{{$product->producingCost + ($product->producingCost * ($product->profit / 100))}}</span>
							</div>
							<div class="product-rating-container">
								@for($i = 1; $i <= $product->averageStars; $i++)
									<i class="fa fa-star fa-fill"></i>
								@endfor
								@for($i = $product->averageStars + 1; $i <= 5; $i++)
									<i class="fa fa-star"></i>
								@endfor
								<span>(</span><span class="product-rating-count">{{$product->totalReviews}}</span><span>)</span> 
							</div>
							<div class="product-footer-container">
								<div class="cart-container">
									<svg class="mu-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path></svg>
									<span>CART</span>
								</div>
								<div class="wishlist-container">
									<svg class="mu-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path></svg>
									<span>WISHLIST</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endforeach
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
	<script src="js/home.js"></script>
</body>
</html>