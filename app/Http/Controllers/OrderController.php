<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //direct order list page
    public function orderList(){
        $order=Order::when(request('searchKey'),function($q){
            $key=request('searchKey');
            $q->orwhere('user_id','like','%'.$key.'%')
              ->orwhere('total_price','like','%'.$key.'%')
              ->orwhere('order_code','like','%'.$key.'%');
        })
            ->select('orders.*','users.name as user_name')
            ->leftJoin('users','users.id','orders.user_id')
            ->get();
            // dd($order->toArray());
        return view('admin.order.list',compact('order'));
    }


    //sorting order list by status
    public function orderSorting(Request $request){
     $order=Order::select('orders.*','users.name as user_name')
                   ->leftJoin('users','users.id','orders.user_id');
       if ($request->status==null) {
            $order=$order->get();
       }else{
            $order=$order->where('status',$request->status)->get();
       }
        // dd($order->toArray());
        return view('admin.order.list',compact('order'));

    }

    //change order status process
    public function orderStatusChange(Request $request){
        $statusChange=Order::where('id',$request->orderId)->update([
            'status'=>$request->status
        ]);
    }


    //direct to order info page by clicking order code
    public function orderInfo($orderCode){
        $orderData=Order::where('order_code',$orderCode)->first();
        $orderListData=OrderList::select('order_lists.*','users.name as user_name','products.image as product_image','products.name as product_name')
                            ->leftJoin('products','products.id','order_lists.product_id')
                            ->leftJoin('users','users.id','order_lists.user_id')
                            ->where('order_lists.order_code',$orderCode)
                            ->get();
                            // dd($orderData->toArray());
         return view('admin.order.orderInfo',compact('orderListData','orderData'));
    }
}