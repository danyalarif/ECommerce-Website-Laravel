<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;;

class HomeController extends Controller
{
    public function viewHome(){
        $profit = $this->monthlyProfit();
        $productSold = $this->monthlyProductSold();
        $newCustomers = $this->newCustomers();
        $satisfaction = $this->customerSatisfaction();
        $date = $this->monthRange();
        return view('admin-home', ['profit'=>$profit, 'productSold'=>$productSold, 
        'newCustomers'=>$newCustomers, 'satisfaction'=>$satisfaction, 'date'=>$date]);
    }
    private function monthRange(){
        $range = "";
        $oldDateYear = date('Y', strtotime("-1 month"));
        $newDateYear = date('Y');
        if($oldDateYear != $newDateYear){
            $oldDate = date('M y', strtotime("-1 month"));
            $newDate = date('M y');
            $range = $oldDate." - ".$newDate;
        }
        else{
            $oldDateMonth = date('M', strtotime("-1 month"));
            $newDate = date('M Y');
            $range = $oldDateMonth." - ".$newDate;
        }

        return $range;
    }
    public function getWeeklyProfit(){
        $weeklyProfit = DB::select('SELECT 
        SUM(savewaymart.order.quantity*(product.profit*product.producingCost/100)) AS productSale,
        DAYNAME(orderOn) as day
        FROM savewaymart.order JOIN product
        WHERE   
        orderOn BETWEEN NOW() - INTERVAL 7 DAY AND NOW() AND
        savewaymart.order.productid = product.idProducts
        GROUP BY orderOn
        ORDER BY orderOn DESC;');

        return $weeklyProfit;
    }

    private function monthlyProfit(){
        $monthlyProfit = DB::select("
        SELECT 
        CONCAT('Rs. ',ROUND(SUM(savewaymart.order.quantity*(product.profit*product.producingCost/100))/1000000,1), 'M')AS productSale
        FROM savewaymart.order JOIN product
        WHERE   
        orderOn BETWEEN NOW() - INTERVAL 30 DAY AND NOW() AND
        savewaymart.order.productid = product.idProducts;
        ");
        foreach($monthlyProfit as $mp=>$value){
            $monthlyProfit = $value;
        }
        
        return $monthlyProfit->productSale;
    }

    private function monthlyProductSold(){
        $monthlyProfit = DB::select("SELECT 
        SUM(savewaymart.order.quantity) AS productSold
        FROM savewaymart.order
        WHERE   
        orderOn BETWEEN NOW() - INTERVAL 30 DAY AND NOW();");
        foreach($monthlyProfit as $ps=>$value){
            $monthlyProfit = $value;
        }
        return $monthlyProfit->productSold;
    }
    private function newCustomers(){
        $newCustomers = DB::select("
            SELECT 
            COUNT(idUser) AS noUsers
            FROM user
            WHERE   
            joinedDate BETWEEN NOW() - INTERVAL 30 DAY AND NOW();
        ");
        foreach($newCustomers as $c=>$value){
            $newCustomers = $value;
        }
        return $newCustomers->noUsers;
    }
    private function customerSatisfaction(){
        $satisfaction = DB::select('
        SELECT CONCAT(ceil(100*SUM(IF(stars>=3, 1, 0))/COUNT(stars)), " %") AS satisfaction FROM review;
        ');
        foreach($satisfaction as $c=>$value){
            $satisfaction = $value;
        }
        return $satisfaction->satisfaction;
    }
}
