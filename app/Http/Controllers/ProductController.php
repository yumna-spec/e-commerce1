<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category ;
use App\Models\OrderItems;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
 public function index() //user view
    {
        $products = Product::all();
        return view('product.BurgerList', compact('products'));
    }


// public function filterPrice(Request $request)
// {      
//     $maxprice = $request->price??100;
// $products=Product::where('price', '<=', $maxprice)->get();
// //$products=$products->where('price', '=', $maxprice);
//     return view('admin.adminproducttable', compact('products','maxprice'));
// // $products = Product::where('price', '=', $maxprice)->get();

// // $products = Product::all(); 

// // $filtered = $products->where('price', '=', $maxprice);
// }

public function searchbar(){
    $maxprice = request('price', 100);
    $category_name = request('category_name', null);
    $categories= Category::wherenotNull('parent_id')->get();

    if(request()->hasAny(['search','price'])){  //Depend on the name of input field
        //using scopr on the model
        $products=Product::search(request()->input('search'));
        $products=$products->where('price', '<=', $maxprice )->where('category_name','like','%'.$category_name.'%')->get();
        


    }
    else {
      $products = Product::all();
   }

    return view('admin.adminproducttable', compact('products','maxprice', 'categories'  ));

}

public function latestProducts(){
    $products=Product::orderby('created_at','desc')->paginate(2);   //latest products first
    $categories=Category::wherenotNull('parent_id')->get();
    return view('admin.adminproducttable', compact('products', 'categories'));
}      




 public function topsellingProducts(){ 
 //$orderItems=OrderItems::groupBy('product_id')->sum('quantity')->get(); //get total quantity for all products
// $products=Product::withSum('orderItems', 'quantity')->orderby('order_items_sum_quantity','desc')->get();
  // return view('admin.adminproducttable', compact('products'));


//$orderItems = OrderItems::groupBy('product_id')->get(); //it gives me  error SQLSTATE[42000]: Syntax error or access violation
//dd($orderItems->ToArray());
// groupBy method before get method acts as a Query Builder method 
// This will give them the desired result.
//$orderItems = OrderItems::get()->groupBy('product_id'); // after get method acts as a Collection method


//$orderItems = OrderItems::select('product_id', DB::raw('sum(quantity) as total_sold'))->get()->groupBy('product_id');

//dd($orderItems->ToArray());



//$orderItems = DB::table('orderitems')->groupBy('product_id')->sumByGroup('quantity'); //I got error Call to undefined method Illuminate\Database\Query\Builder::sumByGroup()

//$orderItems = OrderItems::groupBy('product_id')->select('product_id', DB::raw('sum(quantity) as total_sold'))->get();





$orderItems = OrderItems::groupBy('product_id')->select('product_id', DB::raw('SUM(quantity) as total_sold'))->having('total_sold', '>=', 5)->get();
//dd($orderItems);
//I used the above for loop in the blade file to get product details
// Source - https://stackoverflow.com/a
// Posted by Antonio Carlos Ribeiro, modified by community. See post 'Timeline' for change history
// Retrieved 2026-01-12, License - CC BY-SA 3.0



return view('admin.sellingProducts', compact('orderItems'));

 }



 public function lesssellingProducts(){
    $orderItems=OrderItems::groupby('product_id')->select('product_id', DB::raw('SUM(quantity) as total_sold'))->having('total_sold', '<', 2)->get();    //less than 10 quantity products
    return view('admin.sellingProducts', compact('orderItems')); 


 }

 public function trendingProducts(){
    $products=Product::where('Is_trend', 1)->paginate(2);
    $categories=Category::wherenotNull('parent_id')->get();

    return view('admin.adminproducttable', compact('products', 'categories'));


 }





 public function filterbypriceandsearch(){
    $search=request('search', null);
    $maxprice=request('price', 100);
    if($search){
            // $products=Product::query()->when($search, function ($query, $search) {
            //             return $query->where('name', 'like', '%' . $search . '%');
            //         })->where('price', '<=', $maxprice)->get();
        $products=Product::where('name','like','%'.$search.'%')->where('price', '<=', $maxprice)->get();

    //$products=Product::query()->where('name','like','%'.$search.'%')->where('price', '<=', $maxprice)->get();
    }
    else {
        $products=Product::where('price', '<=', $maxprice)->get();
    }


    return view('product.BurgerList', compact('products','maxprice'));





 }



 public function trash() 
 {
 $products = Product::onlyTrashed()->get();
 $categories=Category::wherenotNull('parent_id')->get();
   return view ('admin.trashproduct', compact('products','categories'));
 }





 public function restore($id)
 {
    Product::withTrashed()->where('id', $id)->restore();

    
 return redirect()->back();

    
 }

 public function delete($id){
    Product::withTrashed()->where('id', $id)->forceDelete();
 }
















 }