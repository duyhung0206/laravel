<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function pagecreate(){
        $customers = Customer::all();
        $products = Product::all();
        return view('order.create')
            ->with('customers', $customers)
            ->with('products', $products);
    }

    public function create(Request $request){
        $data = $request->all();
        var_dump($data['product']);
    }
}
