<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\Status;

use App\Models\Orderitems;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Pest\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPass;
use Nette\Utils\Image;

use function Symfony\Component\String\b;

class UserController extends Controller
{


public function register (Request $request){




$request->validate([   
 'name'     => 'required|string|max:255',
 'email'    => 'required|string|email|max:255|unique:users',
 'password' => 'required|string|min:8|confirmed',
 'image'    => 'required|image|mimes:jpg,jpeg,png|max:2048',

 ]);


$user=User::create([
    'name'=> $request->name,
    'email'=> $request->email,
'password'=>bcrypt($request->password),


]);

if($request->hasFile('image')){
//     $image=$request->file('image');
//     $imagename=$image->getClientOriginalName();
//  $image->storeAs('avatars/'.$user->id ,$imagename);

$image= $request->file('image');
 $imagename=$image->getClientOriginalName();
$imagefile=$image->storeAs('avatars/'.$user->id,$imagename,'public'); 
$user->update([
    'image'=> $imagefile,
]);
}

Auth::login($user);

return redirect()->route('dashboarduser');
}
public function login (loginRequest $request){
    
    Auth::guard('admin')->logout();

     $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('product.list');
        }
        


    //
}

public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }




    public function logout(Request $request)
    {
        Auth::logout();
    Auth::guard('web')->logout();     

        $request->session()->invalidate(); //close session
        $request->session()->regenerateToken(); //new csrf token

        return redirect('/');
    }



    public function Addtocart(Request $request){
        $request->validate([
           'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',



        ]);


        $user = $request->user();

        $user->products()->syncWithoutDetaching([
            $request->product_id => [
                'quantity' => $request->quantity
            ]
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function viewcart(){
$user=Auth::user();
$products=$user->products;
return view('product.cart',compact('products'));
    }





public function Forgetpass(Request $request){    //1
    $user=Auth::user();
    $request->validate([
        'email'=>'required|string|exists:users,email'
    ]);

$user=User::where('email',$request->email)->first();


$token=Str::random(16);
    DB::table('password_reset_tokens')->updateOrInsert([
                'email'=>$request->email,

    ],[
        'token'=> $token,
        'created_at' => now()

    ]);

     Mail::to($user->email)->send(new ResetPass($token));
        return redirect()->back()->with('success', 'Product added successfully!');



}

public function ShowReset(string $token)         //2
{
return view('password.password-reset',compact('token'));
}

public function ResetPassword(Request $request)  //3
{
    $request->validate([
        'token'=>'required|string',
        'password'=>'required|string|confirmed|min:8'

    ]);

     $tokenData = DB::table('password_reset_tokens') 
            ->where('token', $request->token)->first();

    if($tokenData){
        $user=User::where('email',$tokenData->email)->first();
          $user->update([
                'password' => bcrypt($request->password)
            ]);

            DB::table('password_reset_tokens')
            ->where('token',$request->token)
            ->delete();
            return redirect(route('login'));
    }

    abort(404);
}







public function checkout(Request $request)
{
    $user = Auth::user();
    $products = $user->products;

    if ($products->isEmpty()) {
        return redirect()->route('cart.view')->with('error', __('product.empty_cart_order'));
    }

    $validated = $request->validate([
        'quantities' => ['sometimes', 'array'],
        'quantities.*' => ['required', 'integer', 'min:1', 'max:99'],
    ]);

    $order = DB::transaction(function () use ($user, $products, $validated) {
        $order = Order::create([
            'user_id' => $user->getAuthIdentifier(),
        ]);

        foreach ($products as $product) {
            $quantity = (int) ($validated['quantities'][$product->id] ?? $product->pivot->quantity);

            OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        Status::create([
            'order_id' => $order->id,
            'name' => 'pending',
        ]);

        $user->products()->detach($products->modelKeys());

        return $order;
    });

    return redirect()->route('order.user')->with('success', __('product.order_placed', ['id' => $order->id]));
}

    public function deletefromcart(Request $request){
        
      $request->validate([
           'delete_id' => 'required|exists:products,id',



        ]);

        $product_id = $request->input('delete_id');


        $user = $request->user();

        $user->products()->detach($product_id);

        return redirect()->back()->with('success', 'Product deleted successfully!');


    }


    public function updatestate(Request $request,$id){
    $order = Order::query()->findOrFail($id);

    $laststatus= $order->statuses()->latest('created_at')->first();


    return view('order.ordertrackinguser', compact('order','laststatus'));   



}


public function cancelstatus(Request $request){

    $order = Order::findOrFail($request->order_id);
    
        $laststatus= $order->statuses()->latest('created_at')->first();

      $status=  Status::create([ 
            "order_id"=> $request->order_id,

        
      'name'=>$request->name ]);


        return view('order.ordertrackinguser', compact('order','laststatus','status'));


}

 public function orderhistory (){
    $orders = Auth::user()
        ->orders()
        ->with(['orderitemsProduct.product', 'latestStatus'])
        ->latest()
        ->get();

    return view('product.orderhistory', compact('orders'));

 }





    
}













    
