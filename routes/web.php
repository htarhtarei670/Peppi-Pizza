<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Models\User;
use App\Models\Product;

Route::middleware(['admin_auth'])->group(function(){
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'login'])->name('auth#login');
    Route::get('registerPage',[AuthController::class,'register'])->name('auth#register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('auth#dashboard');

    //admin
    Route::middleware(['admin_auth'])->group(function () {

        //category page
        Route::prefix('category')->group(function(){
            Route::get('listPage',[CategoryController::class,'list'])->name('cate#list');
            Route::get('createPage',[CategoryController::class,'createPage'])->name('cate#createPage');
            Route::post('createProcess',[CategoryController::class,'createProcess'])->name('cate#create');
            Route::get('deleteProcess/{id}',[CategoryController::class,'deleteProcess'])->name('cate#delete');
            Route::get('editPage/{id}',[CategoryController::class,'edit'])->name('cate#edit');
            Route::post('update',[CategoryController::class,'update'])->name('cate#update');
        });

        //account admin
        Route::prefix('admin')->group(function(){
            //change password
             Route::get('changePasswordPage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
             Route::post('changePasswordProcess',[AdminController::class,'changePasswordProcess'])->name('admin#changePasswordProcess');

             //account detail
             Route::get('accountDetail',[AdminController::class,'accountDetail'])->name('admin#detail');

             //account edit
             Route::get('accountEdit',[AdminController::class,'accountEdit'])->name('admin#edit');
             Route::post('accoutUpdate/{id}',[AdminController::class,'accountUpdate'])->name('admin#update');

             //acount list
             Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
             Route::get('delete/{id}',[AdminController::class,'deleteProcess'])->name('admin#delete');
             Route::get('roleChangePage/{id}',[AdminController::class,'roleChangePage'])->name('admin#roleChangePage');
             Route::post('roleChangeProcess/{id}',[AdminController::class,'roleChangeProcess'])->name('admin#roleChangeProcess');


             //products page
            Route::prefix('product')->group(function(){
                Route::get('list',[ProductController::class,'listPage'])->name('products#list');
                Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
                Route::post('createProcess',[ProductController::class,'createProcess'])->name('product#createProcess');
                Route::get('delete/{id}',[ProductController::class,'deleteProcess'])->name('product#delete');
                Route::get('detail/{id}',[ProductController::class,'detail'])->name('product#detail');
                Route::get('edit/{id}',[ProductController::class,'editPage'])->name('product#editPage');
                Route::post('editProcess',[ProductController::class,'editProcess'])->name('product#editProcess');
            });

            //order
            Route::prefix('order')->group(function(){ 
                Route::get('orderList',[OrderController::class,'orderList'])->name('admin#orderList');
                Route::get('orderSort',[OrderController::class,'orderSorting'])->name('admin#orderSorting');
                Route::get('orderStatusChange',[OrderController::class,'orderStatusChange'])->name('admin#orderStatusChange');

                //direct to order info page by clicking order code
                Route::get('orderInfo/{orderCode}',[OrderController::class,'orderInfo'])->name('admin#orderInfo');
            });

            //userList
            Route::prefix('userList')->group(function(){
               Route::get('userListPage',[UserController::class,'userList'])->name('admin#userList');
               Route::get('userRoleChange',[UserController::class,'userRoleChange'])->name('admin#userRoleChange');
               Route::get('userAccDelete/{id}',[UserController::class,'userAccDelete'])->name('admin#userAccDelete');
            });

            // contact messages
            Route::prefix('contact')->group(function(){
                Route::get('contactMessage',[ContactController::class,'contactMessage'])->name('admin#contact');
                Route::get('messageReplyPage/{id}',[ContactController::class,'messageReplyPage'])->name('admin#contactMessageReplyPage');
                Route::post('messageReplyProcess',[ContactController::class,'messageReplyProcess'])->name('admin#contactMessageReplyProcess');
                Route::get('contactMessageDelete/{id}',[ContactController::class,'contactMessageDelete'])->name('admin#contactMessageDelete');
            });
        });

    });


    //user
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        Route::get('homePage',[UserController::class,'homePage'])->name('user#home');

        //change password
        Route::prefix('password')->group(function(){
            Route::get('changePw',[UserController::class,'changePassword'])->name('user#changepasswordPage');
            Route::post('changeProcess/{id}',[UserController::class,'changePasswordProcess'])->name('user#changeProcess');
        });

        Route::prefix('account')->group(function(){
            Route::get('page',[UserController::class,'accountPage'])->name('user#account');
            Route::post('update/{id}',[UserController::class,'accountProcess'])->name('user#accountProcess');
        });

        //ajax sorting
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'ajaxSorting'])->name('ajax#sorting');

            //add data to cart table
            Route::get('cart',[AjaxController::class,'cart'])->name('ajax#addCart');

            //add data to orderList table
            Route::get('order/list',[AjaxController::class,'orderList'])->name('ajax#orderList');

            //delete a cart from cart table
            Route::get('acart',[AjaxController::class,'acart'])->name('ajax#acartDelete');

            //delete all cart from cart table
            Route::get('allCart',[AjaxController::class,'allCart'])->name('ajax#allCartDelete');

            //increate view count
            Route::get('increase/view/count',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
       });


       //fliter by categories
       Route::get('filter/{id}',[UserController::class,'fliter'])->name('fliter#categories');

       //product detail
       Route::prefix('pizza')->group(function(){
            Route::get('detail/{id}',[UserController::class,'detail'])->name('pizza#detail');
       });

       //cart route area
       Route::prefix('cart')->group(function(){
            Route::get('list/{id}',[UserController::class,'cartList'])->name('cart#list');
            Route::get('historyList',[UserController::class,'historyList'])->name('cart#historyList');
       });

       //contact us
       Route::get('contactUsPage',[ContactController::class,'contactUsPage'])->name('user#contactUsPage');
       Route::post('contactInfo',[ContactController::class,'contactInfo'])->name('user#getContactInfo');
       Route::get('contactReplyOage',[ContactController::class,'contactReplyPage'])->name('user#adminReplyPage');
       Route::post('contactReplyProcess',[ContactController::class,'contactReplyProcess'])->name('user#adminReplyProcess');
       Route::get('userCommentDelete/{id}',[ContactController::class,'userCommentDelete'])->name('user#commentDelete');
    });

});