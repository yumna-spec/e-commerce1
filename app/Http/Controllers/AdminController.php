<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pest\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPass;
use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;

use App\Models\Category;


use function Symfony\Component\String\b;

class AdminController extends Controller
{



public function login (Request $request){
    $request->validate ([
 'email'    => 'required|string|email|max:255|',
 'password' => 'required|string|min:8',


    ]);

     $credentials = ['email' => $request->email, 'password' => $request->password];
    Auth::guard('web')->logout();

        if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->intended(route('admin.dashboard'));

        }
return redirect()->back()->withErrors([
    'email' => 'These credentials do not match our admin records.'
]);



        
 

    //
}

    public function showLogin()
    {
        return view('admin.login');
    }



    public function Adminlogout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate(); //close session
        $request->session()->regenerateToken(); //new csrf token

        return redirect('/');
    }



public function adminproduct(){

$products = Product::all();
$categories=Category::whereNull('parent_id')->get();
return view('admin.adminproducttable',compact('products','categories'));



}




public function deleteproduct(Product $id ){


  //  Product::find($request->product_id)->delete();

$id->delete();

 return redirect()->back()->with('success', 'Product deleted successfully!');







}

 public function addproduct(Request $request){

 

    $request->validate([
        'name'=>'required|string',
       'price' => 'required|numeric|min:0|max:999999.99',
         'description'=>'string',
         'Is_trend'=>'boolean',
         'category_name'=>'exists:categories,name',
  ]);
     $product = Product::create([
        'name'=> $request->name,
        'price'=> $request->price,
       'description'=>$request->description,
       'Is_trend'=>$request->Is_trend,
       'category_name'=>$request->category_name, 


     ]);
     $id=Category::where('name',$request->category_name)->first()->id;
        $product->update(['category_id'=>$id]);

 return redirect()->back()->with('success', 'Product added successfully!');

 }

 public function editproduct(Request $request, Product $product){
    $product->update([
        'name' => $request->filled('name') ? $request->name : $product->name,
        'price' => $request->filled('price') ? $request->price : $product->price,
        'description' => $request->filled('description') ? $request->description : $product->description,
        'Is_trend' => $request->filled('Is_trend') ? $request->Is_trend : $product->Is_trend,
    ]);

    return redirect()->route('product.edit', $product->id);
}





public function showallOrder()
    {

        // return view('checkout');
        $orders = Order::all();
        

        return view('order.show', compact('orders'));
    }


    public function showallOrderitems($id)
    {
// 
        $order = Order::with('orderItemsProduct')->find($id);
       // dd($order->relationsToArray());
        // Access the order items as a collection
        // $orderItems = $order->orderItemsProduct; 
        $orderItems = $order->orderItemsProduct; 
       // $orderItems = $order->orderItemsProduct()->where('quantity', '>', 1)->get();



        return view('order.items', compact('orderItems'));
    }










    










//     }





}
