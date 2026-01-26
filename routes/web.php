<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;

use App\Models\Product;
use App\Models\Category;


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard after AUTH


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})
    ->name('admin.dashboard')
    ->middleware('auth:admin');

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/userdashboard', function () {
    return view('dashboarduser');
})
    ->name('dashboarduser')
    ->middleware('auth:web');



//cart routes
Route::group([ 'prefix'=> 'cart','as'=> 'cart.'], function () {
    Route::post('/product', [UserController::class, 'Addtocart'])->name('add')->middleware('auth');
    Route::get('/', [UserController::class, 'viewcart'])->name('view')->middleware('auth');
    Route::Post('/delete', [UserController::class, 'deletefromcart'])->middleware('auth')->name('delete');

   
});


//order routes
Route::group(['prefix'=> 'order','as'=> 'order.','middleware'=> 'auth:web'], function () {
    
  Route::post('/productorder', [UserController::class, 'checkout'])->name('checkout');
  Route::get('/', [AdminController::class, 'showallOrder'])->name('history')->withoutMiddleware('auth:web')->middleware('auth:admin')   ;
  Route::get('/{id}', [AdminController::class, 'showallOrderitems'])->name('items')->withoutMiddleware('auth:web')->middleware('auth:admin')   ;
});

//forgetpassword
Route::group(['prefix'=> 'password','as'=> 'password.','middleware'=> 'guest'], function () {
    
   Route::get('/forgot-password', function () {  //this first step ask user to input email 
    //when user click forget password it routes here 
    return view('password.password-forget');
    })->name('request');


  Route::post('/forgetpassword', [UserController::class, 'Forgetpass'])->name('email');


  Route::get('/resetpassword/{token}', [UserController::class, 'ShowReset'])->name('reset');

  Route::post('/resetpassword', [UserController::class, 'ResetPassword'])->name('update');

});


//Admin Routes
Route::group(['prefix' => 'Admin', 'as' => 'admin.'], function () {
  

    Route::get('/product', [AdminController::class, 'adminproduct'])->name('product')->middleware('auth:admin');
Route::get('/product/trending', [ProductController::class, 'trendingProducts'])->name('product.trend')->middleware('auth:admin');   
    Route::get('/product/add', function () {
        $categories=Category::whereNotNull('parent_id')->get();
        
        return view('admin.productAddform',compact('categories'));
    })->name('product.add')->middleware('auth:admin');

    Route::post('/product/add', [AdminController::class, 'addproduct'])->name('product.add.submit')->middleware('auth:admin');
    Route::delete('/product/delete/{id}', [AdminController::class, 'deleteproduct'])->name('product.delete')->middleware('auth:admin');
});

//Product Routes
Route::group(['prefix'=> 'product','as'=> 'product.'], function () {   
    Route::get('/', [ProductController::class, 'index'])->name('list');


     Route::post('/edit/{product}', [AdminController::class, 'editproduct'])
    ->name('edit.submit')
    ->middleware('auth:admin');

    Route::get('/edit/{product}', function (Product $product) {
    return view('admin.producteditform', compact('product'));
    })->name('edit')->middleware('auth:admin');

    Route::get('/search', [ProductController::class, 'searchbar'])->name('searchbar')->middleware('auth:admin');

    Route::get('/latest', [ProductController::class, 'latestProducts'])->name('latest')->middleware('auth:admin');
    Route::get('/topselling', [ProductController::class, 'topsellingProducts'])->name('topselling')->middleware('auth:admin');
    Route::get('/lessselling', [ProductController::class, 'lesssellingProducts'])->name('lessselling')->middleware('auth:admin');
});


Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/subcategory/{id}', [CategoryController::class, 'showsubcategory'])->name('subcategory.index');

Route::get('/productbysubcategory/{id}', [CategoryController::class, 'productbysubcategory'])->name('productbysubcategory.index');





Route::get('/productbysub/add/{id}', [CategoryController::class, 'show'])->name('productsub.add')->middleware('auth:admin');

Route::post('/productbysubcategory/add/{id}', [CategoryController::class, 'storeproductbysubcategory'])->name('admin.product.sub.add')->middleware('auth:admin');



Route::get('/filter', [ProductController::class, 'filterbypriceandsearch'])->name('filterprice');


Route::get('/trash',[ProductController::class,'trash'])->name('admin.trashproduct')->middleware('auth:admin');

Route::post('/restore/{product}', [ProductController::class,'restore'])->name('admin.product.restore')->middleware('auth:admin');

Route::post('/delete/{product}', [ProductController::class,'delete'])->name('admin.force.delete')->middleware('auth:admin');    

Route::post('/avatar', [UserController::class,'addfileavatar'])->name('avatar.user')->middleware('auth:web');    



use App\Http\Controllers\PhotoController;

Route::resource('photos', PhotoController::class);
Route::get('/userorder',[UserController::class,'orderhistory'])->name('order.user')->middleware('auth:web');


