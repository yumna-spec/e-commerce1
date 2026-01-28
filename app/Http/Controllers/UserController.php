<?php

namespace App\Http\Controllers;

use App\Http\Requests\loginRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
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
Auth::login($user);

}
}
public function login (loginRequest $request){
    
    Auth::guard('admin')->logout();

     $credentials = ['email' => $request->email, 'password' => $request->password];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended(route('dashboarduser'));
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





public function Forgetpass(Request $request){
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

public function ShowReset(string $token)
{
return view('password.password-reset',compact('token'));
}

public function ResetPassword(Request $request)
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


        $order = Order::query()->create([    //important //to make create direct from another model //Cause i use Facades
            'user_id' => $user->getAuthIdentifier(),
        ]);
        foreach ($products as $product) {

            $quantities = $request->input("quantities.{$product->id}", 1);

            //$quantity=$product->pivot->quantity; //(I added this on the Blade  so it will take the value from pivot as first value )


            $user->products()->updateExistingPivot($product->id, [
                'quantity' => $quantities
            ]);

          $orderitems=  Orderitems::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantity'   => $quantities,
                'price'      => $product->price,
            ]);




        }





        $user->products()->detach();
       // Mail::to($user->email)->send(new Ordermail($products));

        return redirect()->back();



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


    public function updatestate(Request $request){
    $order = Order::query()->findOrFail($request->order_id);
    $laststatus= $order->statuses()->latest('name')->first();

    return view('myordertrack', compact('order','laststatus'));   



}

 public function orderhistory (){
$user = Auth::user();

$orders = $user->orders;



return view('product.orderhistory', compact('orders'));

    }




    
}













    





