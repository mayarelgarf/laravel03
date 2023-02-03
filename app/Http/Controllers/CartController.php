<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{


    function cart(Request $request)
    {

        $sub_total = 0;
        $ids = Session::get('ids', []);
        $products = Product::findOrFail($ids);
        foreach ($products as $product) {

            $sub_total +=$product['price'];

        }
        $quantity = array_count_values(Session()->get('ids', []));
        return view('cart')->with(['products' => $products, 'quantity' => $quantity,'sub_total'=>$sub_total]);

    }

    function add_cart_products(Request $request)
    {

        if ($request->has('id')) {
            $ids = Session::get('ids', []);
            array_push($ids, $request->get('id'));
            Session::put('ids', $ids);
            return response()->json('Data addedd successfully');

        }}
        function inc_product(Request $request)
        {
                $ids = Session::get('ids', []);
                $ids[$request->get('id')] += 1;
                Session::put('ids', $ids);
                return response()->json("inc product");
            
            
        }

        #both functions increase and decrease price wont work
        function dec_product(Request $request)
        {
           
                $ids = Session::get('ids', []);
                $ids[$request->get('id')] -= 1;
                Session::put('ids', $ids);
                return response()->json("dec product");
            
        }


        

        }
    
