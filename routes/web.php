<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

//USER ROUTES

Route::get('/', function () {
    return view('index');
});
Route::get('/auth', [UserController::class, 'loadSite']);

Route::get('/home', [ProductController::class, 'loadHomePage']);

Route::get('/products', [ProductController::class, 'loadProduct']);

Route::get('/register', function(){
    return view('register');
});
Route::get('/login', function(){
    return view('login');
});
Route::get('/profile', [UserController::class, 'loadUser']);
Route::get('/creditcard', function(){
    return view('creditcard');
});
Route::get('/wishlist', [ProductController::class, 'loadWishlist']);
Route::post('/wishlist', [ProductController::class, 'saveToWishlist']);
Route::post('/deleteWishlist', [ProductController::class, 'deleteWishlist']);
Route::get('/orders', [ProductController::class, 'loadOrders']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/category', [ProductController::class, 'loadCategory']);

Route::get('/loadProducts', [ProductController::class, 'loadProductsInRange']);

Route::get('/cart', function(){
    return view('cart');
});
Route::post('/cart', [ProductController::class, 'addOrders']);

Route::post('/updatePassword', [UserController::class, 'updatePassword']);

Route::post('/register', [UserController::class, 'storeUserData']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/profile', [UserController::class, 'updateUserBalance']);
Route::post('/creditcard', [UserController::class, 'updateCreditCard']);
Route::post('/search', [ProductController::class, 'searchProducts']);

Route::get('/get-stars/{productID}', [ReviewController::class, 'getRatedStars']);
Route::get('/get-reviews/{productID}', [ReviewController::class, 'getReviews']);

Route::post('/add-review', [ReviewController::class, 'addReview']);


//ADMIN ROUTES
Route::get('/admin-users', [AdminController::class, "viewAdmins"]);
Route::get('/get-admins', [AdminController::class, "getAdmins"]);
Route::get('/add-admin', [AdminController::class, "viewAdminForm"]);
Route::get('/edit-admin', [AdminController::class, "viewEditAdmin"]);
Route::post('/add-admin', [AdminController::class, "addNewAdmin"]);
Route::post('/delete-admin', [AdminController::class, "deleteAdmin"]);
Route::post('/edit-admin', [AdminController::class, "editAdmin"]);

Route::get('/admin-products', [ProductController::class, "viewProducts"]);
Route::get('/get-products', [ProductController::class, "getProducts"]);
Route::get('/add-product', [ProductController::class, "viewProductForm"]);
Route::get('/edit-product', [ProductController::class, "viewEditProduct"]);
Route::post('/add-product', [ProductController::class, "addProduct"]);
Route::post('/delete-product', [ProductController::class, "deleteProduct"]);
Route::post('/edit-product', [ProductController::class, "editProduct"]);

Route::get('/orders-admin', [OrderController::class, "viewOrders"]);
Route::get('/get-orders', [OrderController::class, "getOrders"]);

Route::get('/customers', [CustomerController::class, "viewCustomers"]);
Route::get('/get-customers', [CustomerController::class, "getCustomers"]);

Route::get('/admin-home', [HomeController::class, "viewHome"]);
Route::get('/get-weekly-profit', [HomeController::class, "getWeeklyProfit"]);
Route::get('/monthly-profit', [HomeController::class, "monthlyProfit"]);
Route::get('/monthly-product-sold', [HomeController::class, "monthlyProductSold"]);
Route::get('/new-customers', [HomeController::class, "newCustomers"]);
Route::get('/customer-satisfaction', [HomeController::class, "customerSatisfaction"]);

?>
