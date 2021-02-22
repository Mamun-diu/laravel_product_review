<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Rating;
use App\Models\Favourite;
use DB;
use Hash;
use Session;
use Image;
use DateTime;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user_id = Session::get('user')['id'];
        $user = User::find($user_id);
        // return response()->json($user);
        return view('frontend.profile')->with('user',$user);
    }
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
            $user = User::where('email',$request->email)->orWhere('username',$request->email)->first();
            if($user && Hash::check($request->password, $user->password)){
                $request->session()->put('user',$user);
                $request->session()->forget('admin');
                return redirect('/');
            }else{
                $request->session()->flash('error', "Email or password is not matched");
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
                $request->session()->flash('error', "Email or password is not matched");
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
                $request->session()->flash('error', "Email or password is not matched");
                return Redirect()->back();
            }

        }
    }
    public function logout(){
        Session::forget('user');
        return redirect('/');
    }
    public function registration(Request $request){
        // return response()->json($request->input());
        $validate = $request->validate([
            'fname' => ['required','max:10'],
            'lname' => ['required','max:10'],
            'username'=>['required', 'unique:users'],
            'email' => ['required', 'unique:users', 'max:255'],
            'password' => ['required'],
            're_password' => 'required|same:password',
            'phone' => ['required' , 'unique:users'],
            'address' => ['required' ],
        ]);
        $user = new User;
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->username = $request->username;
        $user->address = $request->address;
        $user->save();

        $users = User::where('email',$request->email)->first();
        if($users && Hash::check($request->password, $users->password)){
            $request->session()->put('user',$user);
            $request->session()->forget('admin');
            return redirect('/');
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
    public function show()
    {
        return view('frontend.registration');
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
        // $validate = $request->validate([
        //     'name' => ['required'],
        //     'email' => 'required|unique:users,email,'.$id,
        //     'phone' => 'required|unique:users,phone,'.$id,
        //     'address' => ['required'],
        // ]);
        // if($validate){
        //     $user = User::find($id);
        //     $user->name = $request->name;
        //     $user->email = $request->email;
        //     $user->phone = $request->phone;
        //     $user->address = $request->address;
        //     $user->save();
        //     return Redirect()->back();
        // }
    }
    public function update_password(Request $request, $id){
        $validate = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:4',
            'confirm_password' => 'required|same:new_password',
        ]);
        $user_check = User::where('id',$id)->first();
        if($user_check && Hash::check($request->old_password, $user_check->password)){
            User::where('id',$id)->update(['password'=>Hash::make($request->new_password)]);
            return Redirect()->back()->with('msg','Password Updated successfully');
        }else{
            return Redirect()->back()->with('error','Password Updated Failed');
        }
        return response()->json($user_check->password);
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

    public function update_fullname(Request $request, $id){
        $validate = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
        ]);
        $user = User::find($id);
        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->save();
        return Redirect()->back()->with('msg','Full name updated successfully');
    }
    public function update_username(Request $request, $id){
        $validate = $request->validate([
            'username' => 'required|min:4|unique:users,username,'.$id,
        ]);
        $user = User::find($id);
        $user->username = $request->username;
        $user->save();
        return Redirect()->back()->with('msg','Username updated successfully');
    }
    public function update_email(Request $request, $id){
        $validate = $request->validate([
            'email' => 'required|min:4|unique:users,email,'.$id,
        ]);
        $user = User::find($id);
        $user->email = $request->email;
        $user->save();
        return Redirect()->back()->with('msg','Email updated successfully');
    }
    public function update_phone(Request $request, $id){
        $validate = $request->validate([
            'phone' => 'required|min:10|max:11|unique:users,phone,'.$id,
        ]);
        $user = User::find($id);
        $user->phone = $request->phone;
        $user->save();
        return Redirect()->back()->with('msg','Phone updated successfully');
    }
    public function update_gender(Request $request, $id){

        $user = User::find($id);
        $user->gender = $request->gender;
        $user->save();
        return Redirect()->back()->with('msg','Gender updated successfully');
    }
    public function update_address(Request $request, $id){
        $validate = $request->validate([
            'address' => 'required',
        ]);
        $user = User::find($id);
        $user->address = $request->address;
        $user->save();
        return Redirect()->back()->with('msg','Address updated successfully');
    }
    public function update_Image(Request $request, $id){
        $validate = $request->validate([
            'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);
        $image = $request->file('file');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('user_image'),$imageName);

        // $image_resize = Image::make($image->getRealPath());
        // // return response()->json($imageName);
        // $image_resize->resize(300,300);
        // $image_resize->save(public_path('user_image/'.$imageName));

        $user = User::find($id);
        $user->image = $imageName;
        $user->save();
        if(!empty($request->old_image)){
            unlink(public_path('user_image/'.$request->old_image));
        }

        return Redirect()->back()->with('msg','Image updated successfully');
    }
    public function remove_account(Request $request, $id){
        $user = User::find($id);
        if(Hash::check($request->password, $user->password)){
            if(!empty($request->image)){
                unlink(public_path('user_image/'.$request->image));
            }
            $request->session()->forget('user');
            $data = User::find($id);
            $data->delete();

            return redirect('/');
        }else{
            return Redirect()->back()->with('error','Password not matched');
        }
    }

}
