<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Price;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Tiny_category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('backend.test')->with('product',$product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main_cat = Main_category::all();
        return view('backend.product')->with('main',$main_cat);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => ' required|unique:products|max:50',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
            if($validate){
                // $name = $request->name;
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);

            $product = new Product;
            $product->tiny_category_id = $request->tiny_category_id;
            $product->name = $request->name;
            $product->brand = $request->product_model;
            $product->details = $request->details;
            $product->image = $imageName;

            $product->save();

            // $tiny = $request->tiny_category_id;
            $p_name = $request->name;

            $product_id = Product::where('name',$p_name)->first();

            $price = new Price;
            $price->product_id = $product_id->id;
            $price->website_name = $request->web_name;
            $price->price = $request->price;
            $price->link = $request->web_link;
            $price->save();
            return Redirect()->back()->with('msg', "Product information save successfully");
            // $tiny = Tiny_category::where('id',$tiny)->first();
            // $sub = Sub_category::where('id',$tiny->sub_category_id)->first();
            // $main = Main_category::where('id',$sub->main_category_id)->first();
            // return redirect('/admin/add/price/page')->with( ['product_p' => $product_p,'tiny'=>$tiny,'sub'=>$sub,'main'=>$main] );
            // return view('backend.price',compact('product_p','tiny','sub','main'));
            }else{
                return Redirect()->back()->with('error', "Product information can't save");
            }



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
    public function findProduct($id){
        $product = Product::where('tiny_category_id',$id)->get();
        return response()->json($product);
    }
}
