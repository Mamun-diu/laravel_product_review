<?php

namespace App\Http\Controllers;

use App\Models\Sub_category;
use App\Models\Tiny_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
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
            'sub_category' => ' required|unique:sub_categories|max:50',
        ]);
        $sub = new Sub_category;
        $sub->main_category_id = $request->main_category_id;
        $sub->sub_category = $request->sub_category;
        $sub->save();
        if($sub){
            return Redirect()->back()->with('msg','Sub Category Added');
        }else{
            return Redirect()->back()->with('error','Sub Category can not Added');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sub = Sub_category::where('id',$id)->with('mainCategory')->get();
        return response()->json($sub);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'sub_category' => ' required|unique:sub_categories,sub_category,'.$request->id,
        ]);
        $sub = Sub_category::find($request->id);
        $sub->main_category_id = $request->main_category_id;
        $sub->sub_category = $request->sub_category;
        $sub->save();
        $tiny = Tiny_category::where('sub_category_id',$request->id)
        ->update(['main_category_id'=> $request->main_category_id],['sub_category_id'=>$request->id]);
        // $tiny->main_category_id = $request->main_category_id;
        // $tiny->sub_category_id = $request->id;
        // $tiny->save();
        return Redirect()->back()->with('msg','Sub Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sub_category $sub_category)
    {
        //
    }
    public function findSub($id){

        $find = Sub_category::where('main_category_id',$id)->get();
        return response()->json($find);

    }
}
