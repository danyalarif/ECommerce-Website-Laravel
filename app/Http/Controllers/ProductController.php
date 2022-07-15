<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Database\QueryException;
class Review{
    public $productid;
    public $idUser;
    public $userName;
    public $stars;
    public $comment;
    function __construct($productid, $idUser, $userName, $stars, $comment){
        $this->productid = $productid;
        $this->idUser = $idUser;
        $this->userName = $userName;
        $this->stars = $stars;
        $this->comment = $comment;
    }
}
class ProductController extends Controller
{
    public function loadHomePage(){
        $highestRatedProducts = self::retrieveHighestRatedProducts();
        $saleProducts = self::retrieveSaleProducts();
        $newProducts = self::retrieveNewProducts();
        return view('home', ['highestRateProducts' => $highestRatedProducts, 'saleProducts' => $saleProducts, 'newProducts' => $newProducts]);
    }
    public function loadProduct(Request $request){
        $id = $request->input('productid');
        $products = DB::select('select * from product join subcategory on subcategoryid = idsubCategory left outer join review on productid = idProducts left outer join sale on idProducts = sale.productid left outer join (select idUser, name as userName from user) U1 on userid = idUser join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where idProducts = ?', [$id]);
        //creating reviews
        $reviews = [];
        $totalReviews = 0;
        $totalStars = 0;
        $product = null;
        foreach($products as $p){
            $product = $p;
            if ($p->stars == 0){        //if no reviews
                break;
            }
            array_push($reviews, new Review($p->idProducts, $p->idUser, $p->userName, $p->stars, $p->comment));
            $totalReviews++;
            $totalStars += $p->stars;
        }
        if ($totalReviews != 0){
            $averageStars = $totalStars / $totalReviews;
        }
        else{
            $averageStars = 0;
        }

        $productStars = DB::select("SELECT 
        COALESCE(SUM(case when review.stars  = 1  then 1 else 0 end),0) AS ratedStars1,
        COALESCE(SUM(case when review.stars  = 2  then 1 else 0 end),0) AS ratedStars2,
        COALESCE(SUM(case when review.stars  = 3  then 1 else 0 end),0) AS ratedStars3,
        COALESCE(SUM(case when review.stars  = 4  then 1 else 0 end),0) AS ratedStars4,
        COALESCE(SUM(case when review.stars  = 5  then 1 else 0 end),0) AS ratedStars5,
        COUNT(review.stars) AS totalStars
        FROM product JOIN review
        WHERE 
        product.idProducts = review.productid
        AND 
        product.idProducts = ".$id.";");
        $prod = null;
        foreach($productStars as $p){
            $prod = $p ;
        }
        return view('products', ['product' => $product, 'productStars'=>$prod, 'reviews' => $reviews, 'totalReviews' => $totalReviews, 'averageStars' => round($averageStars)]);
    }
    public function loadOrders(){
        $userid = self::getUserId();
        $orders = DB::select('select * from `order` join product on productid = idProducts join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where userid = ?', [$userid]);
        return view('orders', ['orders' => $orders]);
    }
    public function loadWishlist(){
        $userid = self::getUserId();
        $wishlist = DB::select('select * from product join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid join wishlist on productid = idProducts where userid = ?', [$userid]);
        return view('wishlist', ['wishlist' => $wishlist]);
    }
    public function deleteWishlist(Request $request){
        $userid = self::getUserId();
        $productid = $request->productid;
        DB::delete('delete from wishlist where userid = ? and productid = ?', [$userid, $productid]);
        return response()->json('success');
    }
    public function loadCategory(Request $request){
        $category = $request->input('category');
        $products = DB::select('SELECT idProducts, categoryName, averageStars, totalReviews, name, color, size, minAge, maxAge, soldBy, producingCost, profit, total, subcategoryid, image, title, salePercentage from (select * from (select idProducts as pid, avg(stars) as averageStars, count(stars) as totalReviews from product left outer join review on productid = idProducts group by idProducts) TEMP join product on product.idProducts = TEMP.pid) TEMP2 left outer join sale on idProducts = sale.productid join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where title = ? limit 4 offset 0', [$category]);
        return view('category', ['products' => $products, 'category' => $category]);
    }
    public function loadProductsInRange(Request $request){
        $category = $request->input('category');
        $start = $request->input('start');
        $end = $request->input('end');
        $products = DB::select('SELECT idProducts, categoryName, averageStars, totalReviews, name, color, size, minAge, maxAge, soldBy, producingCost, profit, total, subcategoryid, image, title, salePercentage from (select * from (select idProducts as pid, avg(stars) as averageStars, count(stars) as totalReviews from product left outer join review on productid = idProducts group by idProducts) TEMP join product on product.idProducts = TEMP.pid) TEMP2 left outer join sale on idProducts = sale.productid join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where title = ? limit ? offset ?', [$category, $end - $start + 1, $start - 1]);
        return response()->json($products);
    }
    public function saveToWishlist(Request $request){
        $userid = self::getUserId();
        $productid = $request->productid;
        try{
            DB::insert('INSERT INTO wishlist(userid, productid, addedOn) VALUES (?, ?, ?)', [$userid, $productid, now()]);
        }
        catch(QueryException $e){
   
        }
        return response()->json(['success'=>'success']);
    }
    public function addOrders(Request $request){
        $userid = self::getUserId();
        $user = Session::get('user');
        $productsids = $request->productids;
        $productquantities = $request->productquantities;
        $total = $request->total;
        if ($total > $user->balance){
            return response()->json(['insufficient balance'=>'insufficient balance']);
        }
        $orderid = self::getLastOrderid() + 1;
        $date = now();
        $date = $date->addDays(5);
        for ($i = 0; $i < count($productsids); $i++){    
            DB::select('INSERT INTO `order`(`idOrder`, `userid`, `productid`, `quantity`, `orderOn`, `recievedOn`) VALUES (?,?,?,?,?,?)'
            , [$orderid, $userid, $productsids[$i], $productquantities[$i], now(), $date]);
            $orderid++;
        }
        self::updateUser($userid, $user->balance - $total);
        $user->balance = $user->balance - $total;
        for ($i = 0; $i < count($productsids); $i++){
            self::updateProduct($productsids[$i], $productquantities[$i]);
        }
        //updating product and user
        return response()->json(['success'=>'success']);

    }
    private function updateProduct($productid, $quantity){
        $products = DB::select('select * from product where idProducts = ?', [$productid]);
        $product = null;
        foreach($products as $p){
            $product = $p;
            break;
        }
        $newQuantity = $product->total - $quantity;
        if ($newQuantity <= 0){
            DB::delete('delete product where idProducts = ?', [$productid]);
            return;
        }
        DB::update('update product set total = ? where idProducts = ?', [$newQuantity, $productid]);
    }
    private function updateUser($userid, $balance){
        DB::update('update user set balance = ? where idUser = ?', [$balance, $userid]);
    }
    public function searchProducts(Request $request){
        $value = $request->input('searchField');
        $category = $request->input('category');
        $products = null;
        if ($category === 'all'){
            $products = DB::select('SELECT idProducts, categoryName, averageStars, totalReviews, name, color, size, minAge, maxAge, soldBy, producingCost, profit, total, subcategoryid, image, title, salePercentage from (select * from (select idProducts as pid, avg(stars) as averageStars, count(stars) as totalReviews from product left outer join review on productid = idProducts group by idProducts) TEMP join product on product.idProducts = TEMP.pid) TEMP2 left outer join sale on idProducts = sale.productid join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where name like ?', ['%'.$value.'%']);
        }
        else{
            $products = DB::select('SELECT idProducts, categoryName, averageStars, totalReviews, name, color, size, minAge, maxAge, soldBy, producingCost, profit, total, subcategoryid, image, title, salePercentage from (select * from (select idProducts as pid, avg(stars) as averageStars, count(stars) as totalReviews from product left outer join review on productid = idProducts group by idProducts) TEMP join product on product.idProducts = TEMP.pid) TEMP2 left outer join sale on idProducts = sale.productid join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid where name like ? and categoryName = ?', ['%'.$value.'%', $category]);
        }
        return view('search', ['products' => $products, 'term' => $value]);
    }
    private function getLastOrderid(){
        $orders = DB::select('SELECT * FROM `order` order by idOrder desc');
        $orderid = 0;
        foreach($orders as $o){
            $orderid = $o->idOrder;
            break;
        }
        return $orderid;
    }
    private function getUserId(){
        if (!(Session::has('user'))){
            return;
        }
        $user = Session::get('user');
        $userid = $user->idUser;
        return $userid;
    }
    private function retrieveHighestRatedProducts(){
        $products = self::retrieveProducts();
        $highestRatedProducts = array_filter($products, 'self::testRating');
        return $highestRatedProducts;
    }
    private function retrieveSaleProducts(){
        $products = self::retrieveProducts();
        $saleProducts = array_filter($products, 'self::testSale');
        return $saleProducts;
    }
    public function testSale($element){
        return ($element->salePercentage > 0);
    }
    public function testRating($element){
        return ($element->averageStars >= 4);
    }
    private function retrieveNewProducts(){
        $newProducts = array_reverse(self::retrieveProducts());
        return $newProducts;
    }
    private function retrieveProducts(){
        $products = DB::select('SELECT idProducts, categoryName, averageStars, totalReviews, name, color, size, minAge, maxAge, soldBy, producingCost, profit, total, subcategoryid, image, title, salePercentage from (select * from (select idProducts as pid, avg(stars) as averageStars, count(stars) as totalReviews from product left outer join review on productid = idProducts group by idProducts) TEMP join product on product.idProducts = TEMP.pid) TEMP2 left outer join sale on idProducts = sale.productid join subcategory on subcategoryid = idsubCategory join (select idCategory, name as categoryName from category) U2 on idCategory = categoryid');
        return $products;
    }
    //ADMIN
    public function viewProducts(){
        return view('admin-products');
    }

    public function getProducts(){
        $productsList = 
        DB::select("SELECT ProductsInfo.idProducts AS id, name, category, subcategory, producingCost, profitPercentage, stockleft, COALESCE(SUM(savewaymart.order.quantity), 0) AS stocksold FROM 
        (
        SELECT idProducts, product.name AS name, category.name AS category, subcategory.title AS subcategory, product.producingCost AS producingCost, product.profit as profitPercentage, product.total AS stockleft FROM product INNER JOIN subcategory INNER JOIN category
        WHERE 
        product.subcategoryid = subcategory.idsubCategory AND
        subcategory.categoryid = category.idCategory
        )AS ProductsInfo LEFT JOIN savewaymart.order
        ON ProductsInfo.idProducts = savewaymart.order.productid
        GROUP BY (ProductsInfo.idProducts)");

        return $productsList;
    }

    public function viewProductForm(){
        return view('add-product');
    }

    public function deleteProduct(Request $request){
        $product = Product::find($request->productID);
        $productName = $product->name;
        $product->delete();
        return response()->json($productName." deleted successfully.");
    }

    public function addProduct(Request $request){
        $product = new Product;
        $product->name = $request->productname;
        $product->subcategoryid = $request->subcategory;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->minAge = $request->minAge;
        $product->maxAge = $request->maxAge;
        $product->soldBy = $request->soldby;
        $product->profit = $request->profit;
        $product->total = $request->stock;
        $product->producingCost = $request->producingcost;
        //Adding Image//
        $pic = $request->file('file'); 
        $picName = pathinfo($pic->getClientOriginalName(),PATHINFO_FILENAME); 
        $picName = $picName.date("y_m_d_h_m_s");
        $picType = $pic->getClientOriginalExtension(); 
        
        $picSize = $pic->getSize(); $pic->move('uploads',$picName.".".$picType); 
        $destination = 'uploads/'.$picName.".".$picType; 

        $product->image = $destination;

        $product->save();

        return redirect('/admin-products');
    }

    public function viewEditProduct(Request $request){
        $product = Product::find($request->productID);
        return view('edit-product', ['product'=>$product]);
    }
    public function editProduct(Request $request){
        $product = Product::find($request->productID);
        $product->name = $request->productname;
        $product->subcategoryid = $request->subcategory;
        $product->color = $request->color;
        $product->size = $request->size;
        $product->minAge = $request->minAge;
        $product->maxAge = $request->maxAge;
        $product->soldBy = $request->soldby;
        $product->profit = $request->profit;
        $product->total = $request->stock;
        $product->producingCost = $request->producingcost;

        $product->save();

        return redirect('/admin-products');
    }
}
