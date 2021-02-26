<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Price;
use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Tiny_category;
use App\Models\Favourite;
use App\Models\Rating;
use Illuminate\Http\Request;
use Session;
use DateTime;
use Hash;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderByRaw('id DESC')->paginate(20);
        return view('backend.show_product')->with('product',$product);
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
            'name' => ' required|unique:products',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
            if($validate){
                // $name = $request->name;
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);

            $product = new Product;
            $product->tiny_category_id = $request->tiny_category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->main_category_id = $request->main_category_id;
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
    public function show($id)
    {
        $main = Main_category::all();
        $product = Product::find($id);
        $main_cat = Main_category::find($product->main_category_id);
        $sub_cat = Sub_category::find($product->sub_category_id);
        $tiny_cat = Tiny_category::find($product->tiny_category_id);

        // return response()->json($tiny_cat);
        return view('backend.edit_product',compact('main','product','main_cat','sub_cat','tiny_cat'));
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
    public function update(Request $request, Product $product, $id)
    {

        $validate = $request->validate([
            'name' => ' required|unique:products,name,'.$id,
            'product_model' => ' required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000',
        ]);
        if($request->file('image')==''){
            $old = Product::find($id);
            $imageName = $old->image;

        }else{
            $old = Product::find($id);
            $oldImage = $old->image;
            unlink('public/images/'.$oldImage);

            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images'),$imageName);

        }


        $product = Product::find($id);
        $product->tiny_category_id = $request->tiny_category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->main_category_id = $request->main_category_id;
        $product->name = $request->name;
        $product->brand = $request->product_model;
        $product->details = $request->details;
        $product->image = $imageName;

        $product->save();
        return redirect('/admin/product/show')->with('msg','Product Updated Successfully');

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
    public function findCat($id){
        $main = Product::find($id)->main->main_category;
        $sub = Product::find($id)->sub->sub_category;
        $tiny = Product::find($id)->tiny->tiny_category;
        $data = [$main,$sub,$tiny];
        return response()->json($data);

    }
    public function findPrice($id){
        $price = Price::where('product_id',$id)->get();
        return response()->json($price);
    }
    public function changeStatus($id){
        $status = Product::find($id);
        if($status->status == 'publish'){
            $newStatus = Product::find($id);
            $newStatus->status = 'unpublish';
            $newStatus->save();
            return response()->json('unpublish');
        }else{
            $newStatus = Product::find($id);
            $newStatus->status = 'publish';
            $newStatus->save();
            return response()->json('publish');
        }
    }
    public function getProduct($id){
        $main = Product::find($id)->main->main_category;
        $sub = Product::find($id)->sub->sub_category;
        $tiny = Product::find($id)->tiny->tiny_category;
        $cat = [$main,$sub,$tiny];
        $product = Product::find($id);
        $price = Product::find($id)->prices;
        $data = [$cat,$product,$price];
        return response()->json($data);
    }


    public function productInfo($id){
        if(Session::has('user')){
            $user_id = Session::get('user')['id'];
        }else{
            $user_id = 99999;
        }
        $product = Product::find($id);
        $price = Product::find($id)->prices;
        $favourite = Favourite::where('product_id',$id)->where('user_id',$user_id)->first();
        $fav_count = Favourite::where('product_id',$id)->count();
        // return response()->json($fav_count);
        $review = Rating::where('product_id',$id)->orderBy('id', 'desc')->skip(0)->take(15)->with('user')->get();
        $rating = Rating::where('product_id',$id)->groupBy('user_id')->get()->avg('rate');
        $rating_count = Rating::where('product_id',$id)->groupBy('user_id')->count();
        // echo time_elapsed_string('2013-05-01 00:22:35');

        // return response()->json();
        return view('frontend.product_info',compact('product','price','favourite','review','rating','rating_count','fav_count'));
    }

    function searchTop($id){
        // return response()->json($id);
        if($id==''){
            return response()->json('');
        }
        $result = Product::where('name','like',"%{$id}%")->skip(0)->take(5)->get();
        return response()->json($result);
    }
    function searchResult(Request $request){

        $name = $request->search;

        $product = Product::where('name','like',"%{$name}%")->paginate(12);
        // return response()->json($product[0]->name);
        return view('frontend.search')->with('product',$product);
    }

    public function removeProduct(Request $request){
        // return response()->json(Hash::make('adminmamun'));
        // Product, Price, Favourite, Rating
        $id = $request->id;
        $image = Product::find($id);
        // return response()->json($image->image);
        $product = Product::where('id',$id)->delete();
        $price = Price::where('product_id',$id)->delete();
        $favourite = Favourite::where('product_id',$id)->delete();
        $rating = Rating::where('product_id',$id)->delete();
        unlink(public_path('images/'.$image->image));
        return Redirect()->back()->with('msg','Product Deleted Successfully');
    }



    public function getSubProduct(Request $request){
        if($request->ajax()){
            $product = Product::where('sub_category_id',$request->s_id)->with('price')->paginate(20);
            return view('frontend.filter_product')->with('product',$product);
        }

    }
    public function getSubBrand(Request $request){
        $brand = Product::where('sub_category_id',$request->s_id)->groupBy('brand')->get();
        return response()->json($brand);
    }
    public function getTinyBrand(Request $request){
        $brand = Product::where('sub_category_id',$request->s_id)->where('tiny_category_id',$request->t_id)->groupBy('brand')->get();
        return response()->json($brand);
    }
    public function getTinyCategory(Request $request){
        $tiny = Tiny_category::where('sub_category_id',$request->s_id)->get();
        return response()->json($tiny);
    }

    public function getSubTinyProduct(Request $request){
        if($request->ajax()){
            $product = Product::where('sub_category_id',$request->s_id)->where('tiny_category_id',$request->t_id)->with('price')->paginate(20);

            return view('frontend.filter_product')->with('product',$product);
        }
    }
    public function getSubTinyBrandPagination(Request $request){
        if($request->ajax()){
            $product = Product::where('sub_category_id',$request->s_id)
            ->where('tiny_category_id',$request->t_id)
            ->where('brand',$request->brand)
            ->with('price')->paginate(20);

            return view('frontend.filter_product')->with('product',$product);
        }
    }
    public function getBrandProduct(Request $request){
        if($request->ajax()){
            $product = Product::where('sub_category_id',$request->s_id)->where('brand',$request->brand)->with('price')->paginate(20);

            return view('frontend.filter_product')->with('product',$product);
        }
    }
    public function getSubTinyBrandProduct(Request $request){
        if($request->ajax()){
            $product = Product::where('sub_category_id',$request->s_id)->where('tiny_category_id',$request->t_id)->where('brand',$request->brand)->with('price')->paginate(20);

            return view('frontend.filter_product')->with('product',$product);
        }
    }



    public function getSubPrice(Request $request){
        $min = Product::where('sub_category_id',$request->s_id)->with('price')->get();
        $taka = [];
        foreach ($min as  $key => $value) {
            array_push($taka,$value->price->price);
        }


        if(count($min)!=0){
            $minNumber = min($taka);
            $maxNumber = max($taka);
        }else{
            $minNumber = 0;
            $maxNumber = 0;
        }
        $data=[$minNumber,$maxNumber];
        return response()->json($data);

    }
    public function getSubTinyPrice(Request $request){
        $min = Product::where('sub_category_id',$request->s_id)
        ->where('tiny_category_id',$request->t_id)
        ->with('price')->get();
        $taka = [];
        foreach ($min as  $key => $value) {
            array_push($taka,$value->price->price);
        }


        if(count($min)!=0){
            $minNumber = min($taka);
            $maxNumber = max($taka);
        }else{
            $minNumber = 0;
            $maxNumber = 0;
        }
        $data=[$minNumber,$maxNumber];
        return response()->json($data);

    }
    public function getSubBrandPrice(Request $request){
        $min = Product::where('sub_category_id',$request->s_id)
        ->where('brand',$request->brand)
        ->with('price')->get();
        $taka = [];
        foreach ($min as  $key => $value) {
            array_push($taka,$value->price->price);
        }


        if(count($min)!=0){
            $minNumber = min($taka);
            $maxNumber = max($taka);
        }else{
            $minNumber = 0;
            $maxNumber = 0;
        }
        $data=[$minNumber,$maxNumber];
        return response()->json($data);

    }
    public function getSubTinyBrandPrice(Request $request){
        $min = Product::where('sub_category_id',$request->s_id)
        ->where('tiny_category_id',$request->t_id)
        ->where('brand',$request->brand)
        ->with('price')->get();
        $taka = [];
        foreach ($min as  $key => $value) {
            array_push($taka,$value->price->price);
        }


        if(count($min)!=0){
            $minNumber = min($taka);
            $maxNumber = max($taka);
        }else{
            $minNumber = 0;
            $maxNumber = 0;
        }
        $data=[$minNumber,$maxNumber];
        return response()->json($data);

    }



    public function fetch_product(Request $request){
        if($request->ajax()){
            $product = Product::orderByRaw('id DESC')->with('price')->paginate(20);
            return view('frontend.filter_product')->with('product',$product);
        }
    }
    public function getPriceSubTinyBrandFilter(Request $request){
        if($request->ajax()){

            $products = Product::with(['price' => function ($query) use ($request) {
                $query->where('price', '>=',$request->min)->where('price','<=',$request->max);

            }])->where('sub_category_id',$request->s_id)
            ->where('tiny_category_id',$request->t_id)
            ->where('brand',$request->brand)
            ->get();
            $newProduct = [];
            foreach ($products as $key => $value) {
                if($value->price){
                    array_push($newProduct,$value);
                }
            }
            // return response()->json($newProduct);
            return view('frontend.filter_product')->with('product',$newProduct);
        }
    }
    public function getPriceSubTinyFilter(Request $request){
        if($request->ajax()){

            $products = Product::with(['price' => function ($query) use ($request) {
                $query->where('price', '>=',$request->min)->where('price','<=',$request->max);

            }])->where('sub_category_id',$request->s_id)
            ->where('tiny_category_id',$request->t_id)
            ->get();
            $newProduct = [];
            foreach ($products as $key => $value) {
                if($value->price){
                    array_push($newProduct,$value);
                }
            }
            // return response()->json($newProduct);
            return view('frontend.filter_product')->with('product',$newProduct);
        }
    }
    public function getPriceSubBrandFilter(Request $request){
        if($request->ajax()){

            $products = Product::with(['price' => function ($query) use ($request) {
                $query->where('price', '>=',$request->min)->where('price','<=',$request->max);

            }])->where('sub_category_id',$request->s_id)
            ->where('brand',$request->brand)
            ->get();
            $newProduct = [];
            foreach ($products as $key => $value) {
                if($value->price){
                    array_push($newProduct,$value);
                }
            }
            // return response()->json($newProduct);
            return view('frontend.filter_product')->with('product',$newProduct);
        }
    }
    public function getPriceSubFilter(Request $request){
        if($request->ajax()){

            $products = Product::with(['price' => function ($query) use ($request) {
                $query->where('price', '>=',$request->min)->where('price','<=',$request->max);

            }])->where('sub_category_id',$request->s_id)
            ->get();
            $newProduct = [];
            foreach ($products as $key => $value) {
                if($value->price){
                    array_push($newProduct,$value);
                }
            }
            // return response()->json($newProduct);
            return view('frontend.filter_product')->with('product',$newProduct);
        }
    }
    public function getPriceFilter(Request $request){
        if($request->ajax()){

            $products = Product::with(['price' => function ($query) use ($request) {
                $query->where('price', '>=',$request->min)->where('price','<=',$request->max);

            }])->get();
            $newProduct = [];
            foreach ($products as $key => $value) {
                if($value->price){
                    array_push($newProduct,$value);
                }
            }
            // return response()->json($newProduct);
            return view('frontend.filter_product')->with('product',$newProduct);
        }
    }

}
