<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\size;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     * 
    
     */
    public function __construct(){
       
    }
    public function index()
    { 
        if (! Gate::allows('is_admin',)){
            abort(403);
        }
        ;
        
        //
        return view('admin.products.index')->with('products', Product::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create')->with(['categories'=>$categories,'colors'=>$colors,'sizes'=>$sizes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(Product::$rules);
    

        $imageUrl = $request->file('image')->store('products', ['disk' => 'public']);
        $product = new Product;

        $product->fill($request->post());
        $product['image'] = $imageUrl;
        $product['rating'] = 0;
        $product['rating_count'] = 0;
        $product['is_recent'] = $request['is_recent'] ? 1 : 0;
        $product['is_featured'] = $request['is_featured'] ? 1 : 0;


        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}