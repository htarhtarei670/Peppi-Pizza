<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function ajaxSorting(Request $request){
      if($request->status== 'asc'){
            $data=Product::orderBy('created_at','asc')->get();
      }else if($request->status== 'desc'){
            $data=Product::orderBy('created_at','desc')->get();
      }
        return $data;
    }


    //adding data to cart
    public function cart(Request $request){
        $cart=$this->cartDataGet($request);
        // logger($cart);//to see data in log file
        Cart::create($cart);
 
        $response=[
            'message'=>'add to cart successfully',
            'status'=>'success'
        ];
        return response()->json($response, 200);//you can replace in $response name...200 is one of errors,you can search 'https status code' page in google..
    }

    //adding data to orderList
    public function orderList(Request $request){
        $total=0;
        $order=$request->all();
        foreach($order as $o){
            $orders=OrderList::create([
                    'user_id'=>$o['userId'],
                    'product_id'=>$o['productId'],
                    'order_code'=>$o['orderCode'],
                    'qty'=>$o['qty'],
                    'total'=>$o['total'],
            ]);
            $total+=$orders->total;
        };

        Cart::where('user_id',Auth::user()->id)->delete();
        Order::create([
            'user_id'=>Auth::user()->id,
            'order_code'=>$orders['order_code'],
            'total_price'=>$total +3000
        ]);

        $response=[
            'status'=>'true',
        ];
        return response()->json($response, 200);
    }

    //delete clicked current cart
    public function acart(Request $request){
        $del=Cart::where('product_id',$request['productId'])->where('id',$request['orderId'])->delete();
    }

    //delete all cart
    public function allCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //increase view count
    public function viewCount(Request $request){
        $product=Product::where('id',$request->productId)->first();
        $viewCount=[
            'view_count'=>$product->view_count +1,
        ];
       Product::where('id',$request->productId)->update($viewCount);
    }


    //private function
    private function cartDataGet($request){
        return[
            'user_id'=>$request->userId,
            'product_id'=>$request->pizzaId,
            'quatity'=>$request->productCount,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }

}
