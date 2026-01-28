<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Order;
use App\Models\Status;
use Illuminate\Http\Request;

class OrderController extends Controller
{
 
public function CREATEstaus(Request $request){
    $order=Order::where("id",$request->order_id)->first();
    
$status =Status::create([
    "order_id"=> $request->order_id,
    "name"=>$request->name,

]);

return view("order.ordertracking",compact("order","status"));
}
    

public function showallstatus(Request $request){
$status=Status::all();  

    return view("order.ordertracking",compact("status"));






}
}