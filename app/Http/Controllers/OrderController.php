<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function viewOrders(){
        return view('orders-admin');
    }

    public function getOrders(){
        $command = DB::raw('SELECT 
        concat("Order#",savewaymart.order.idOrder) AS id,
        group_concat(concat(product.name, " x", savewaymart.order.quantity) separator "<br>") AS productList,
        MAX(savewaymart.order.orderOn) AS orderOn,
        MAX(savewaymart.order.recievedOn) AS recieveOn,
        SUM(savewaymart.order.quantity*(product.producingCost + product.profit*product.producingCost/100) ) AS sellingPrice,
        MAX(user.name)  AS customerName
        FROM savewaymart.order JOIN product JOIN user
        WHERE 
        savewaymart.order.productid = product.idProducts AND
        savewaymart.order.userid = user.idUser
        GROUP BY idOrder;');

        $ordersList = DB::select($command);
        
        return $ordersList;
    }
}
