<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //
    function index()
    {
        $categories = Category::all();
        $products = Product::all();

        return view('index', compact('categories', 'products'));
    }

    function shop(Request $request)
    {
        $query = Product::query();
        $inputs = $request->all();
        if (isset($inputs['keywords'])) {
            $query = $query->where('name', 'like', '%' . $inputs['keywords'] . '%');
        }
        if (isset($inputs['color'])) {
            if (!in_array('-1', $inputs['color'])) {
                $query = $query->whereIn('color_id', $inputs['color']);
            }
        }
        if (isset($inputs['size'])) {
            if (!in_array('-1', $inputs['size'])) {
                $query = $query->whereIn('size_id', $inputs['size']);
            }
        }

        if ($request->has('category_id')) {

            $query = $query->where('category_id', $request->get('category_id'));

        }
        if ($request->has('price')) {
            if (!in_array('-1', $inputs['price'])) {
                $query = $query->where(function ($q) use ($inputs) {
                    foreach ($inputs['price'] as $price) {
                        $q = $q->orWhereBetween('price', [$price, $price + 100]);
                    }
                });
            }
        }
        $products = $query->paginate(9);
        return view('shop')->with([
            'products' => $products,
            'colors' => Color::all(),
            'sizes' => Size::all()
        ]);
    }

    function add_product(Request $request)
    {
        if ($request->has('id')) {
            $ids = Session::get('ids', []);
            array_push($ids, $request->get('id'));
            Session::put('ids', $ids);
            return response()->json('Data addedd successfully');
        }
        return abort(404);
    }
function checkout(){
    return view('checkout');
}



}

