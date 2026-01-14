<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Pest\Support\Str;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
      public function index()
    {
      $categories = Category::whereNull('parent_id')->get();

      return view('admin.admincategory', compact('categories'));
    }

    public function showsubcategory($id){
      $subcategories = Category::where('parent_id', $id)->get();
      return view('admin.subcategory', compact('subcategories'));
    }

    



 public function productbysubcategory($id, Request $request){
    $products=Product::where('category_id', $id)->get();
    return view('admin.productbysubcategory', compact('products'));
 }

 public function show($id){          //i can use query param or route param but here route param is used
        return view('admin.productbysubcategoryform',compact('id') );
    }


 public function storeproductbysubcategory(Request $request,  $id){
$validatedData = $request->validate([
            'name'      => 'required|min:3|max:255|string',
            'price'     => 'required|numeric',
            'description' => 'required|string',
            'Is_trend'  => 'required|boolean',
            'category_id' => 'exists:categories,id'

      ]);
      //$category=Category::find($id)->id;
    // dd($category);
        
      $categoryid= $request->input('category_id');
      $product = Product::create([
        'name'=> $validatedData['name'],
        'price'=> $validatedData['price'],
       'description'=>$validatedData['description'],
       'Is_trend'=>$validatedData['Is_trend'],
       'category_id'=> $id,
       ]);

//dd($product);

      return redirect()->route('productbysubcategory.index',$id)->withSuccess('You have successfully created a Product in this Subcategory!');



 }











    

public function store(Request $request)
{
$validatedData = $request->validate([
            'name'      => 'required|min:3|max:255|string',
            'parent_id' => 'sometimes|nullable|numeric'
      ]);

      Category::create($validatedData);

      return redirect()->route('category.index')->withSuccess('You have successfully created a Category!');
}


    //
}
