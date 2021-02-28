<?php

namespace App\Http\Controllers;

use App\Models\Main_category;
use App\Models\Sub_category;
use App\Models\Tiny_category;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Favourite;
use Illuminate\Http\Request;
use DB;

class MainCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $tiny = DB::table('tiny_categories')
        //         ->join('sub_categories', 'tiny_categories.sub_category_id','sub_categories.id')
        //         ->join('main_categories','sub_categories.main_category_id','main_categories.id')
        //         ->get();
        // return response()->json($tiny);
        $main = Main_category::paginate(10, '*','main');
        // $main2 = Main_category::find(8)->subCategory;  //paginate(5, '*','main');

        $sub = Sub_category::with('mainCategory')->paginate(10, '*','sub');
        //  return response()->json($sub) ;
        $tiny = Tiny_category::with('mainCategory','subCategory')->paginate(10, '*','tiny');
        // return response()->json($tiny) ;
        return view('backend.show_category',compact('main','sub','tiny'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $main = Main_category::all();
        return view('backend.categories')->with('main',$main);
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
            'main_category' => ' required|unique:main_categories|max:50',
        ]);
        $main = new Main_category;
        $main->main_category = $request->main_category;
        $main->save();
        if($main){
            return Redirect()->back()->with('msg','Main Category Added');
        }else{
            return Redirect()->back()->with('error','Main Category can not Added');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function show(Main_category $main_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Main_category $main_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validate = $request->validate([
            'main_category' => ' required|unique:main_categories,main_category,'.$request->id,
        ]);
        $main = Main_category::find($request->id);
        $main->main_category = $request->main_category;
        $main->save();
        return Redirect()->back()->with('msg','Main Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Main_category  $main_category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Main_category $main_category)
    {
        //
    }
    public function getMain(){
        $cat = Main_category::all();
        $product = Product::orderByRaw('id DESC')->with('price')->paginate(12);
        $top_rated = Rating::selectRaw('product_id, AVG(rate) as avg')->groupBy('product_id')->orderBy('rate','Desc')->skip(0)->take(10)->with('price')->with('product')->get();
        $fav = Favourite::selectRaw('product_id, COUNT(user_id) as count')->groupBy('product_id')->orderBy('count','DESC')->skip(0)->take(10)->with('product')->with('price')->get();
        // return response()->json($fav);
        return view('frontend.index',compact('cat','product','top_rated','fav'));
    }

    function fetch_data(Request $request){
        // return response()->json("thik ase");
        if($request->ajax()){
            $product = Product::orderByRaw('id DESC')->with('price')->paginate(12);
            return view('frontend.new-item')->with('product',$product);
        }
    }


    public function getAll($id){
        $subcat = Sub_category::where('main_category_id',$id)->get();
        $tinycat = Tiny_category::where('main_category_id',$id)->with('subCategory')->get();
        $product = Product::where('main_category_id',$id)->orderByRaw('id DESC')->with('price')->with('sub')->with('tiny')->paginate(20);
        $brand = Product::groupBy('brand')->get();
        // return response()->json($brand);
        $min = Product::where('main_category_id',$id)->with('price')->get();
        // $brand = Product::distinct()->where('main_category_id',$id)->with('sub')->with('tiny')->get();
        // $minimum = min(array($min->price->price));
        // return response()->json($min[0]->price->price);
        
            $taka = [];
            foreach ($min as  $key => $value) {
                array_push($taka,$value->price->price);
            }
            if($taka){
                $minNumber = min($taka);
                $maxNumber = max($taka);
            }else{
                $minNumber=0;
                $maxNumber=0;
            }
            
        


        // $products = Product::with(['price' => function ($query) {
        //     $query->where('price', '>=',50000)->where('price','<=',250000);

        // }])->where('main_category_id',$id)
        // ->paginate(2);
        // $newProduct = [];
        // foreach ($products as $key => $value) {
        //     if($value->price){
        //         array_push($newProduct,$value);
        //     }
        // }
        // return response()->json($products);
        // return response()->json($newProduct);

        return view('frontend.product_filter2',compact('subcat','product','tinycat','minNumber','maxNumber','brand'));
    }


    public static function mainCategory(){
        $cat = Main_category::all();
        return $cat;
    }

}
