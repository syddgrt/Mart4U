<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller
{   

    public function sales(){
        $purchases = Purchase::all();
        
        $sum=0;
        $rows = DB::table('purchases')->select('items')->get();
       
        foreach($rows as $row) {
            $items = $row->items;
            $number = substr($items, strpos($items, ':') + 1);
            foreach($rows as $row){
                $numberRows = substr($items, strpos($items, ',') + 1);
            }
            $sum += (int)$number + (int)$numberRows;           
            
        }
       
        return view('admin.layout.auth.report',['purchases' => $purchases],['sum' => $sum]);
    }

}


