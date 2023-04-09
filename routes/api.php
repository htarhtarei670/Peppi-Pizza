<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiRouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//get tables list
Route::get('product/list',[ApiRouteController::class,'productList']);
Route::get('category/list',[ApiRouteController::class,'categoryList']);
Route::get('order/list',[ApiRouteController::class,'orderList']);
Route::get('orderList/list',[ApiRouteController::class,'orderListList']);
Route::get('contact/list',[ApiRouteController::class,'contactList']);
Route::get('reply/list',[ApiRouteController::class,'replyList']);

//create category
Route::post('create/category',[ApiRouteController::class,'createCategory']);
Route::post('create/contact',[ApiRouteController::class,'createContact']);

//delete category
Route::post('delete/category',[ApiRouteController::class,'deleteCategory']);//input way
// Route::get('delete/category/{id}',[ApiRouteController::class,'deleteCategory']);//uri link


//detail category
Route::get('detail/category/{id}',[ApiRouteController::class,'detailCategory']);

//update category
Route::post('update/category',[ApiRouteController::class,'updateCategory']);


/**
 * Api
 *-----
 *
 *----------Read----------
 * for product
 * http://localhost:8000/api/product/list (Get)
 *
 * for category
 * http://localhost:8000/api/category/list (Get)
 *
 * for order
 * http://localhost:8000/api/order/list (Get)
 *
 * for orderList
 * http://localhost:8000/api/orderList/list (Get)
 *
 * for contact
 * http://localhost:8000/api/contact/list (Get)
 *
 * for reply
 * http://localhost:8000/api/reply/list (Get)
 *
 *
 * --------Create-------
 * for category create
 * http://localhost:8000/api/create/category  (Post)
 * Key=category_name
 *
 * for contact create
 * http://localhost:8000/api/create/contact (Post)
 * Key=user_name,user_email,message
 *
 * ----------Delete---------
 * http://localhost:8000/api/delete/category (Post)
 * Key=category_id
 *
 *
 * --------Detail--------
 * for detail category
 * http://localhost:8000/api/detail/category/id (Get)
 *
 *
 *--------Update-----
 *for update Category
 *http://localhost:8000/api/update/category (Post)
 *key=categoryId,categoryName
 */