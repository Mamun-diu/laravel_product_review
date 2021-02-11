<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Main_category;
use DB;
use Illuminate\Http\Request;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main_cat = Main_category::all();
        $main="";
        $sub="";
        $tiny="";
        $product_p="";
        return view('backend.price',compact('main_cat','main','sub','tiny','product_p'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
                'web_name' => 'required',
                'price' => 'required|numeric',
                'web_link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
            ]);
            $price = new Price;
            $price->product_id = $request->product_id;
            $price->website_name = $request->web_name;
            $price->price = $request->price;
            $price->link = $request->web_link;

            $data = Price::where('product_id', '=', $request->product_id, 'and')->where('website_name', '=', $request->web_name)->get();
            if($data == '[]'){
                $price->save();
                return Redirect()->back()->with('msg','Price added successfully');
            }else{
                return Redirect()->back()->with('error','This price is already on this website');
            }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
    }

    public function updatePrice(Request $request){
        $validate = $request->validate([
            'web' => 'required',
            'price' => 'required|numeric',
            'link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i'],
        ]);
        $price = Price::find($request->id);
        $price->website_name = $request->web;
        $price->price = $request->price;
        $price->link = $request->link;
        $price->save();
        if($price){
            return response()->json($price);
        }

    }
    public function findPrice($id){
        $price = Price::where('id',$id)->get();
        $allPrice = Price::where('product_id',$price[0]->product_id)->get();
        return response()->json($allPrice);
        // return response()->json($price[0]);
    }


    public static function getPrice($id){
        $price = Price::where('product_id',$id)->first();
        return $price;
    }
}
