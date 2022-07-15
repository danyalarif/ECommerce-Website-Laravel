<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders</title>
	<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="css/cart.css"> 
	<link rel="stylesheet" href="css/orders.css"> 
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
                <div class="col-6 cart-header-container">
                    <span class="red-border"></span>
                    <span class="heading">ACTIVE ORDERS</span>
                </div>
                <div class="col-6 cart-items-no-container">
                    <span>{{count($orders)}}</span>
                    <span class="heading">ORDERS</span>
                </div>
            </div>
        </div>
        <div class="container items-container" style="padding-top: 1rem;padding-bottom: 1rem;">
            @foreach($orders as $order)
			<div class="row item-container" style="background-color: var(--background);margin-bottom: 1rem;">
                <div class="col-12 item-header">
					<div class="row">
						<div class="col-12 col-sm-6 col-md-3">
							<span class="product-title">{{$order->name}}</span>
							<span class="product-category">{{$order->categoryName}}</span>
							<span class="product-sub-category">{{$order->title}}</span>
						</div>
						<div class="col-12 col-sm-6 col-md-3 item-head">
							<span class="head">Ordered On</span>
							<span class="data order-sent">{{$order->orderOn}}</span>
						</div>
						<div class="col-12 col-sm-6 col-md-3 item-head">
							<span class="head">Recieve On</span>
							<span class="data order-recieve">{{$order->recievedOn}}</span>
						</div>
						<div class="col-12 col-sm-6 col-md-3 item-head">
							<span class="head">Status</span>
							<span id="status" class="data order-stats"></span>
						</div>
					</div>
                </div>
                <div class="col-12 col-sm-4 product-image-div" style="margin: 0.5rem 0">
                    <div class="image-container">
                        <img src="{{$order->image}}">
                    </div>
				</div>
				<div class="col-12 col-sm-5 product-data-container align-self-center">
					<div class="quantity-container">
						<span>Quantity x </span><span class="quantity">{{$order->quantity}}</span>
					</div>
					<div class="price-container">
						<span>Rs. </span><span class="price">{{($order->producingCost + ($order->producingCost * ($order->profit / 100))) * $order->quantity}}</span>
					</div>
				</div>
				<div class="col-12 col-sm-3 order-text-container align-self-center">
					<div class="order-text-parent">
						<span>Order id: </span>
						<span id="order">{{$order->idOrder}}</span>
					</div>
					<div class="order-text-parent">
						<span>paid by credit card.</span>
					</div>
				</div>
            </div>
			@endforeach
        </div>
	</div>
	<!-------FOOTER------------>
	@component('layouts.components.footer')
	@endcomponent
	<script src="js/jquery.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" crossorigin="anonymous"></script>
	<script src="js/bootstrap/bootstrap.min.js"></script>
	<script src="js/navbar.js"></script>
	<script src="js/orders.js"></script>
</body>
</html>