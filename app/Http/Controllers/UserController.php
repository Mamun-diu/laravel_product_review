<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favourite;
use DB;
use Hash;
use Session;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('frontend.login');
    }
    public function checkLogin(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validate){
            $user = User::where('email',$request->email)->first();
            if($user && Hash::check($request->password, $user->password)){
                $request->session()->put('user',$user);
                $request->session()->forget('admin');
                return redirect('/');
            }else{
                $request->session()->flash('msg', "Email or password is not matched");
                return Redirect()->back();
            }
        }
    }
    public function checkLoginInstant(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validate){
            $user = User::where('email',$request->email)->first();
            if($user && Hash::check($request->password, $user->password)){
                $request->session()->put('user',$user);
                $request->session()->forget('admin');

                $user_id = $request->session()->get('user')['id'];
                $rating = new Rating;
                $rating->product_id = $request->instant_product_id;
                $rating->user_id = $user_id;
                $rating->rate = $request->instant_rating;
                $rating->comment = $request->instant_review;
                $rating->save();
                return Redirect()->back();
            }else{
                $request->session()->flash('msg', "Email or password is not matched");
                return Redirect()->back();
            }

        }
    }
    public function checkLoginFavourite(Request $request){
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if($validate){
            $user = User::where('email',$request->email)->first();
            if($user && Hash::check($request->password, $user->password)){
                $request->session()->put('user',$user);
                $request->session()->forget('admin');

                $user_id = $request->session()->get('user')['id'];
                
                $favourite = new Favourite;
                $favourite->product_id = $request->favourite_product_id;
                $favourite->user_id = $user_id;
                $favourite->save();
                return Redirect()->back();
            }else{
                $request->session()->flash('msg', "Email or password is not matched");
                return Redirect()->back();
            }

        }
    }
    public function logout(){
        Session::forget('user');
        return redirect('/');
    }
    public function registration(Request $request){
        $validate = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users', 'max:255'],
            'password' => ['required'],
            'phone' => ['required' , 'unique:users'],
            'address' => ['required'],
        ]);
        if($validate){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->save();
            return redirect('/login');
        }
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
        //
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
