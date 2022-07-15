<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="_token" content="{{ csrf_token() }}">
	<title>Products</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/rating.css">
	<link rel="stylesheet" href="css/products.css"> 
	<script src="https://use.fontawesome.com/fe91f75b8f.js"></script>
</head>
<body>
	<!----HEADER-->
	@component('layouts.components.navbar')
	@endcomponent
	<!--------BODY------------>
	<div class="body">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bc-icons-2">
                        <ol class="breadcrumb purple lighten-4" style="background-color: transparent;padding: 0;">
                            <li class="breadcrumb-item product-mainCategory"><a class="primary" href="#">{{$product->categoryName}}</a><i class="fa fa-angle-right mx-2"
                                aria-hidden="true"></i></li>
                            <li class="breadcrumb-item product-category"><a class="primary" href="#">{{$product->title}}</a><i class="fa fa-angle-right mx-2"
                                aria-hidden="true"></i></li>
                            <li class="breadcrumb-item active">{{$product->name}}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="container product-container" style="background-color: var(--background);padding-top: 1rem;padding-bottom: 1rem;">
            <div class="row">
                <div class="col-12 col-sm-4 col-md-4 product-image-div">
                    <div class="image-container">
                        <img class="product-image" src="{{$product->image}}">
                    </div>
                </div>
                <div class="col-12 col-sm-5 col-md-5 product-details-div">
                    <div class="product-name-container">
                        <span class="product-name">{{$product->name}}</span>
                    </div>
					<div class="product-rating-container">
					@for($i = 1; $i <= $averageStars; $i++)
						<i class="fa fa-star fa-fill"></i>
					@endfor
					@for($i = $averageStars + 1; $i <= 5; $i++)
						<i class="fa fa-star"></i>
					@endfor
						<a class="primary" href="#"><span class="review-count">{{$totalReviews}}</span> reviews</a>
					</div>
					<div class="dropdown-divider"></div>

					<div class="product-price-container">
						<span class="product-original-price-container-span" style="display: block;text-decoration: line-through;color: var(--textColor);">
							<span class="product-original-price-label">{{$product->salePercentage > 0 ? 'Rs.' : ''}}</span>
							<span class="product-original-price">{{$product->salePercentage > 0 ? ($product->producingCost + ($product->producingCost * ($product->profit / 100))) : ''}}</span>
						</span>
						<span class="product-price-label">Rs.</span>
						<span class="product-price">{{$product->salePercentage > 0 ? (($product->producingCost + ($product->producingCost * ($product->profit / 100))) - ($product->producingCost * ($product->salePercentage / 100))) : ($product->producingCost + ($product->producingCost * ($product->profit / 100)))}}</span>
					</div>
					<div class="stock-container" style="margin-top: 0.5rem;">
						<span>In Stock <span id="stock">{{$product->total}}</span></span>
					</div>
					<div class="counter-container" style="margin-top: 0.5rem;">
						<span style="color: var(--backgroundSecondary);font-size: 1.5rem;">Quantity </span>
						<button class="square-button decrement-button">-</button>
						<span id="quantity" class="square-span number">1</span>
						<button class="square-button increment-button">+</button>
					</div>
					<div class="form-footer" style="margin-top: 1rem;">
						<button id="cart-button" class="custom-button flex-button" style="border-radius: 5px;">
							<svg class="mu-icon" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M11 9h2V6h3V4h-3V1h-2v3H8v2h3v3zm-4 9c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zm10 0c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2zm-9.83-3.25l.03-.12.9-1.63h7.45c.75 0 1.41-.41 1.75-1.03l3.86-7.01L19.42 4h-.01l-1.1 2-2.76 5H8.53l-.13-.27L6.16 6l-.95-2-.94-2H1v2h2l3.6 7.59-1.35 2.45c-.16.28-.25.61-.25.96 0 1.1.9 2 2 2h12v-2H7.42c-.13 0-.25-.11-.25-.25z"></path></svg>
							<span>CART</span>
						</button>
						<button id="wishlist-button" class="custom-button flex-button custom-button-secondary">
							<svg class="mu-icon" style="fill: var(--textColor)" focusable="false" viewBox="0 0 24 24" aria-hidden="true"><path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"></path></svg>
							<span style="color: black;">WISHLIST</span>
						</button>
					</div>
                </div>
				<div class="col-12 col-sm-3 col-md-3 delivery-div">
					<div class="delivery-header-container">
						<span style="font-weight: bold;">Delievery options</span>
					</div>
					<div class="delivery-container">
						<span>Home Delivery</span>
						<span>Rs. <span>50-100</span></span>
					</div>
					<div class="delivery-days-container">
						<span><span>4</span>-<span>7</span> days</span>
					</div>
					<div class="dropdown-divider"></div>
					<div class="store-header-container">
						<span style="font-weight: bold;">Store Details</span>
					</div>
					<div class="store-container">
						<span>Sold By</span>
						<a href="#" class="primary">Chat Now</a>
					</div>
					<div class="store-name-container">
						<span>{{$product->soldBy}}</span>
					</div>
					<div class="store-button-container" style="margin-top: 1rem;text-align: center;">
						<button class="custom-button-rounded">BROWSE STORE</button>
					</div>
				</div>
            </div>
        </div>
		<div class="container" style="background-color: var(--background);margin-top: 2rem;">
			<div class="row heading-row">
				<div class="col-12" style="font-size: 1.3rem;">
					<span style="font-size: inherit;" class="red-border"></span>
					<span style="font-size: inherit;">Product Specifications</span>
				</div>
			</div>
			<div class="row">
				<div class="col-4 specifications-container-parent">
					<div class="specifications-container">
						<span class="primary">Category</span>
						<span>{{$product->categoryName}}</span>
					</div>
					<div class="specifications-container">
						<span class="primary">Sub-Category</span>
						<span>{{$product->title}}</span>
					</div>
				</div>
				<div class="col-4 specifications-container-parent">
					<div class="specifications-container">
						<span class="primary">Size</span>
						<span>{{$product->size}}</span>
					</div>
					<div class="specifications-container">
						<span class="primary">Color</span>
						<span>{{$product->color}}</span>
					</div>
				</div>
				<div class="col-4 specifications-container-parent">
					<div class="specifications-container">
						<span class="primary">Age Range</span>
						<span>{{$product->minAge.'-'.$product->maxAge}}</span>
					</div>
				</div>
			</div>
		</div>
		<div class="container" style="background-color: var(--background);margin-top: 2rem;">
			<div class="row heading-row">
				<div class="col-12" style="font-size: 1.3rem;">
					<span style="font-size: inherit;" class="red-border"></span>
					<span style="font-size: inherit;">Reviews & Ratings for Fitness Shirt</span>
				</div>
			</div>
			<div class="row">
				<div class ="col-12 col-md-6 specifications-container-parent">
					<span class = "primary">
						Average Rating
					</span>
					<div>
						<span class = "primary givenRating" style="display:inline;font-size:32px;">{{$averageStars}}</span>
						<span style="display:inline;">/5</span>
					</div>
					<div>
						<div class="d-flex ">
							<div class="ratings">
							@for($i = 1; $i <= $averageStars; $i++)
								<i class="fa fa-star rating-color"></i>
							@endfor
							@for($i = $averageStars + 1; $i <= 5; $i++)
								<i class="fa fa-star"></i>
							@endfor
							</div>
							<h5 class="review-count">{{$totalReviews}} Rating(s)</h5>
						</div>
					</div>
					
				</div>
				<div class ="col-12 col-md-6 specifications-container-parent">
        
					<div class="mt-1 d-flex justify-content-between align-items-center">
						<h5 class="review-stat">5 Stars</h5>
						<div class="small-ratings">
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
						</div>
						
					</div>
					<div class="progress" style="height: 1px;">
						<div class="progress-bar bg-warning" role="progressbar" style="width: {{$productStars->totalStars == 0?0:($productStars->ratedStars5/$productStars->totalStars)*100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					
					<div class="mt-1 d-flex justify-content-between align-items-center">
						<h5 class="review-stat">4 Stars</h5>
						<div class="small-ratings">
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="progress" style="height: 1px;">
						<div class="progress-bar bg-warning" role="progressbar" style="width: {{$productStars->totalStars == 0?0:($productStars->ratedStars4/$productStars->totalStars)*100}};" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					
					<div class="mt-1 d-flex justify-content-between align-items-center">
						<h5 class="review-stat">3 Stars</h5>
						<div class="small-ratings">
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="progress" style="height: 1px;">
						<div class="progress-bar bg-warning" role="progressbar" style="width: {{$productStars->totalStars == 0?0:($productStars->ratedStars3/$productStars->totalStars)*100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
					
					<div class="mt-1 d-flex justify-content-between align-items-center">
						<h5 class="review-stat">2 Stars</h5> 
						<div class="small-ratings">
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="progress" style="height: 1px;">
						<div class="progress-bar bg-warning" role="progressbar" style="width: {{$productStars->totalStars == 0?0:($productStars->ratedStars2/$productStars->totalStars)*100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>

					<div class="mt-1 d-flex justify-content-between align-items-center">
						<h5 class="review-stat">1 Stars</h5>
						<div class="small-ratings">
							<i class="fa fa-star rating-color"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
							<i class="fa fa-star"></i>
						</div>
					</div>
					<div class="progress" style="height: 1px;">
						<div class="progress-bar bg-warning" role="progressbar" style="width: {{$productStars->totalStars == 0?0:($productStars->ratedStars1/$productStars->totalStars)*100}}%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>

				</div>
			</div>
			<div class="row heading-row mr-1 d-flex justify-content-between align-items-center">
				<div style="font-size: 1.3rem;">
					<span style="font-size: inherit;" class="red-border"></span>
					<span style="font-size: inherit;">Customer Reviews</span>
				</div>
				<!-- Reviews Button trigger -->
				<button type="button" class="btn custom-button" data-toggle="modal" data-target="#allReviews">
					View All Reviews
				</button>
				
				<!-- Reviews Modal -->
				<div class="modal fade" id="allReviews" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title" id="exampleModalLongTitle">Customer Reviews</h5>
						  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						  </button>
						</div>
						<div class="modal-body">
							@foreach($reviews as $review)
							<div class = "customer-rating mt-2 mb-2">
								<div class="small-ratings">
								@for($i = 1; $i <= $review->stars; $i++)
									<i class="fa fa-star rating-color"></i>
								@endfor
								@for($i = $review->stars + 1; $i <= 5; $i++)
									<i class="fa fa-star"></i>
								@endfor
								</div>

								<div>
									By <span class = "customer-name">{{$review->userName}}</span>
								</div>
								<div class = "comment">
									{{$review->comment}}
								</div>
							</div>
							@endforeach
						</div>
						<div class="modal-footer">
						  <button type="button" class="btn  custom-button-secondary" data-dismiss="modal">Close</button>
						</div>
					  </div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- Designing a review -->
				<div class = "col-12 m-2 p-3">
					<div class = "customer-rating mt-2 mb-2">
					@foreach($reviews as $review)
							<div class = "customer-rating mt-2 mb-2">
								<div class="small-ratings">
								@for($i = 1; $i <= $review->stars; $i++)
									<i class="fa fa-star rating-color"></i>
								@endfor
								@for($i = $review->stars + 1; $i <= 5; $i++)
									<i class="fa fa-star"></i>
								@endfor
								</div>

								<div>
									By <span class = "customer-name">{{$review->userName}}</span>
								</div>
								<div class = "comment">
									{{$review->comment}}
								</div>
							</div>
							@break
							@endforeach
					</div>
				</div>
			</div>
			<!-- Send Reviews -->
			<button type="button" class="btn custom-button" data-toggle="modal" data-target="#addReview">
				Add Review
			</button>
			<!-- Add Review Dialog Box-->
			<div class="modal fade" id="addReview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
				  <div class="modal-content">
					<div class="modal-header">
					  <h5 class="modal-title" id="exampleModalLongTitle">Add Review of Fitness Shirt</h5>
					  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					  </button>
					</div>
					<form method = "post" action="/add-review" id = "reviewProduct">
						@csrf
						<div class="modal-body">
							<div class="form-group">
								<label for = "rating">
									Rating
								</label>
								<div class = "small-ratings userRating" onmouseout="colorSelectedOnly()">
									<i class = "fa fa-star" onmouseover="activeAllOnHover(0)" onclick="chooseStars(1)"></i>
									<i class = "fa fa-star" onmouseover="activeAllOnHover(1)" onclick="chooseStars(2)"></i>
									<i class = "fa fa-star" onmouseover="activeAllOnHover(2)" onclick="chooseStars(3)"></i>
									<i class = "fa fa-star" onmouseover="activeAllOnHover(3)" onclick="chooseStars(4)"></i>
									<i class = "fa fa-star" onmouseover="activeAllOnHover(4)" onclick="chooseStars(5)"></i>
									<span id = "rating" name ="rating"></span>
								</div>
								<small id="ratingHelp" class="form-text text-muted">We'll Use your rating, to quantify product quality.</small>
							</div>
							<div class="form-group">
								<label for="description">Review Description</label>
								<textarea class="form-control" name="description"id="reviewDescription" rows="3"></textarea>
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
	<!-------FOOTER------------>
	@component('layouts.components.footer')
	@endcomponent
	<script src="js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/products.js"></script>
	<script src="js/review.js"></script>
</body>
</html>