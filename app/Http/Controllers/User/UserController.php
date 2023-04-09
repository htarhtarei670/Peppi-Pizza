<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //start order
    public function homePage(){
        $products=Product::get();
        $categories=Category::get();
        $order=Order::where('user_id',Auth::user()->id)->get();
        //get cart count
        $carts=Cart::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('products','categories','carts','order'));
    }

    //direct change password page
    public function changePassword(){
        return view('user.password.change');
    }

    //change password process
    public function changePasswordProcess($id,Request $request){
        $this->valiCheckPw($request);

        $dbPw=User::where('id',$id)->first();
        $dbPw=$dbPw->password;

        $userOldPw=$request->oldPassword;

        if(Hash::check($userOldPw, $dbPw)){
           $newPw=$request->newPassword;
           $change=[
                'password'=>Hash::make($newPw),
           ];
           User::where('id',$id)->update($change);
           return back()->with(['changeSuccess'=>'Password Changed Successfully!!']);
        }
        return back();
    }

    //direct account setting page
    public function accountPage(){
        return view('user.account.account');
    }

    //account setting process
    public function accountProcess(Request $request,$id){
        $this->valiCheckAcc($request);
        $updateData=$this->accountUpdateData($request);

        if($request->hasFile('image')){
            $oldImg=User::select('image')->where('id',$id)->first();
            $oldImg=$oldImg->image;

            if($oldImg!=null){
                Storage::delete('public',$oldImg);
            }

            $newImag=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/',$newImag);
            $updateData['image']=$newImag;
        }
        User::where('id',$id)->update($updateData);
        return back()->with(['updateSuccess'=>'Account update successfully']);
    }


    //fliter categories
    public function fliter($categoryId){
        $products=Product::where('category_id',$categoryId)->get();
        $categories=Category::get();
        $order=Order::where('user_id',Auth::user()->id)->get();

        //get cart count
        $carts=Cart::where('user_id',Auth::user()->id)->get();

        return view('user.main.home',compact('products','categories','carts','order'));
    }


    //pizza detail
    public function detail($id){
        $products=Product::where('id',$id)->first();
        $pizzaList=Product::get();

        return view('user.main.detail',compact('products','pizzaList'));
    }

    //direct cart list page 
    public function cartList($userId){
        $cartList=Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
                        ->where('user_id',$userId)
                        ->leftJoin('products','products.id','carts.product_id')
                        ->get();
        // to get total value of all cart price
        $carts=Cart::where('user_id',Auth::user()->id)->get();
        // dd($cartList->toArray());
        $totalPrice= 0;
        foreach($cartList as $c){
            $totalPrice+=$c->product_price * $c->quatity;
        }
        return view('user.main.cart',compact('cartList','totalPrice','carts'));
    }


    //direct history list page
    public function historyList(){
       $orders=Order::where('user_id',Auth::user()->id)
                        ->paginate(4);
        $orders->appends(request()->all());
       return view('user.main.history',compact('orders'));
    }
    // ------------end for order-----------------------------


    // direct user list page
    public function userList(){
        $users=User::where('role','user')
                    ->paginate(3);
        $users->appends(request()->all());
        return view('admin.user.list',compact('users'));
    }

    //user role change process
    public function userRoleChange(Request $request){
        $role=['role'=>$request->role];
        $roleChange=User::where('id',$request->userId)->update($role);
    }

    //user acc delete
    public function userAccDelete($id){
        $userInfo=User::where('id',$id)->first();
        User::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'You Banned '.$userInfo->name.' account']);
    }



    //------private class area----------
    //password change data get
    private function valiCheckPw($request){
       Validator::make($request->all(),[
            'oldPassword'=>'required|min:3',
            'newPassword'=>'required|min:3',
            'confirmPassword'=>'required|same:newPassword',
       ])->validate();
    }

    private function valiCheckAcc($request){
        Validator::make($request->all(),[
            'name'=>'required|unique:users,name,'.$request->id,
            'email'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,bmp,png,jpeg,webp|file',
        ])->validate();
    }

    //account data get
    private function accountUpdateData($request){
        return [
            'name'=>$request->name,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'email'=>$request->email,
            'gender'=>$request->gender,
            'image'=>$request->image,

        ];
    }
}