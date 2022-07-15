<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;

class ReviewController extends Controller
{
    //
    public function getRatedStars($productID){
        $ratedstars = DB::select("SELECT 
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
        product.idProducts = ".$productID.";");

        return $ratedstars[0];
    }
    public function getReviews($productID){
        $productReviews = DB::select("SELECT 
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
        product.idProducts = ".$productID.";");

        return $productReviews;
    }
    public function addReview(Request $request){
        $stars = $request->input('stars');
        $description = $request->input('description');
        $productID = $request->input('productid');
        $userID = Session::get("user")->idUser;

        try {
            DB::insert("INSERT INTO `review`(`userid`, `productid`, `stars`, `comment`) 
            VALUES (?,?,?,?)",
            [$userID, $productID, $stars, $description]);
        }
        catch(QueryException $e){
            
        }
        return redirect('/products?productid='.$productID);
    }
}
