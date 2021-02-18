<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Product;
use Session;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Session::get('user')->id;
        $rate = Rating::where('user_id',$user_id)->groupBy('product_id')->with('product')->paginate(10);
        // return response()->json($rate);
        return view('frontend.rated')->with('product',$rate);
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
        $user_id = $request->session()->get('user')['id'];
        $rating = new Rating;
        $rating->product_id = $request->product_id;
        $rating->user_id = $user_id;
        $rating->rate = $request->rating;
        $rating->comment = $request->review;
        $rating->save();
        Rating::where('product_id',$request->product_id)->where('user_id',$user_id)->update(['rate' => $request->rating]);



        return Redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
