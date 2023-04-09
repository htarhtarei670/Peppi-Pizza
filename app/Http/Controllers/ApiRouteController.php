<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Reply;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderList;
use Illuminate\Http\Request;



class ApiRouteController extends Controller
{
    //Read
   public function productList(){
        $data=Product::get();
        return response()->json($data, 200);
   }

   public function categoryList(){
        $data=Category::get();
        return response()->json($data, 200);
   }

   public function orderList(){
        $data=Order::get();
        return response()->json($data, 200);
   }

   public function orderListList(){
        $data=OrderList::get();
        return response()->json($data, 200);
   }

   public function contactList(){
        $data=Contact::get();
        return response()->json($data, 200);
   }

   public function replyList(){
        $data=Reply::get();
        return response()->json($data, 200);
   }

   //------Create-------
   //create category
   public function createCategory(Request $request){
        $data=[
            'name'=>$request->name,
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
        $response=Category::create($data);
        return response()->json($response, 200);
   }

    //create contact
    public function createContact(Request $request){
        $contact=$this->getContactData($request);
        $response=Contact::create($contact);
        return response()->json($response, 200);
    }

    //create product
    public function createProduct(Request $request){
        $product=$this->getProductData($request);
        $data=Product::create($product);
        return response()->json($data, 200);
    }

    // ----------Delete----------

   //delete category
   public function deleteCategory(Request $request){
    $categories=Category::where('id',$request->category_id)->first();
    $true=[
        'message'=>'deleted successfully',
        'status'=>'true',
        'data'=>$categories,
    ];
    $false=[
        'message'=>'there is no category',
        'status'=>'false',
    ];
    if(isset($categories)){
        Category::where('id',$request->category_id)->delete();
        return response()->json($true, 200);
    }
    return response()->json($false, 500);
   }

   //detail
   public function detailCategory($id){
        $data=Category::where('id',$id)->first();

        if(!empty($data)){
           return response()->json(['status'=>'success','data'=>$data], 200);
        }
        return response()->json(['status'=>'failed','data'=>'there is no category'], 500);
   }

   //----------Update---------

   //update category
   public function updateCategory(Request $request){
        $data=$this->getCategoryData($request);
        $category=Category::where('id',$request->categoryId)->first();

        if(isset($category)){
            $updateData=Category::where('id',$request->categoryId)->update($data);
            return response()->json(['status'=>'success','data'=>$data], 200);
        }
        return response()->json(['status'=>'fail','data'=>'Something wrong ..try again'], 500);
    }


// ------private function area---------
    private function getContactData($request){
        return[
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
    }


    private function getCategoryData($request){
        return[
            'name'=>$request->categoryName,
            'updated_at'=>Carbon::now(),
        ];
    }

    
}