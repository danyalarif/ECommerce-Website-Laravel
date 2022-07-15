<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function viewCustomers(){
        return view('customers');
    }
    public function getCustomers(){
        $customerList = DB::select('SELECT idUser, name, email, noOrders, purchases, COALESCE(noReviews,0) AS noReviews FROM
        (SELECT MAX(user.idUser) as idUser, MAX(user.name) as name, MAX(user.email) as email, COUNT(orderID) AS noOrders, SUM(COALESCE(sellingPrice, 0)) AS purchases FROM
        (SELECT 
        MAX(savewaymart.order.idOrder) AS orderID,
        SUM(savewaymart.order.quantity*(product.producingCost + product.profit*product.producingCost/100)) AS sellingPrice,
        MAX(user.idUser) as idUser
        FROM savewaymart.order JOIN product JOIN user
        WHERE 
        savewaymart.order.productid = product.idProducts AND
        savewaymart.order.userid = user.idUser
        GROUP BY idOrder) AS sellingOrders RIGHT JOIN user
        ON user.idUser = sellingOrders.idUser 
        GROUP BY user.idUser) AS ordersInfo
        LEFT JOIN
        (SELECT userid, COUNT(productid) AS noReviews FROM review
        GROUP BY userid) AS reviewInfo
        ON reviewInfo.userid = ordersInfo.idUser;
        ');
        return $customerList;
    }
}
