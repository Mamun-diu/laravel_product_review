<?php

namespace App\Http\Controllers;

use App\Models\Tiny_category;
use Illuminate\Http\Request;

class TinyCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'tiny_category' => ' required|unique:tiny_categories|max:50',
        ]);
        $cat = new Tiny_category;
        $cat->main_category_id = $request->main_category_id;
        $cat->sub_category_id = $request->sub_category_id;
        $cat->tiny_category = $request->tiny_category;
        $cat->save();
        if($cat){
            return Redirect()->back()->with('msg','Tiny Category Added');
        }else{
            return Redirect()->back()->with('error','Tiny Category can not Added');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tiny_category  $tiny_category
     * @return \Illuminate\Http\Response
     */
    public function show(Tiny_category $tiny_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tiny_category  $tiny_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Tiny_category $tiny_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tiny_category  $tiny_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tiny_category $tiny_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tiny_category  $tiny_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tiny_category $tiny_category)
    {
        //
    }
    public function findTiny($id){
        $find = Tiny_category::where('sub_category_id',$id)->get();
        return response()->json($find);
    }
}
