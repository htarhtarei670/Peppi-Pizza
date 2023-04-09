<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
   //direct products list page
    public function listPage(){
       $products= Product::select('products.*','categories.name as category_name')
        ->when(request('searchKey'),function($q){
            $key=request('searchKey');
            $q->orwhere('products.name','like','%'.$key.'%')->orwhere('products.price','like','%'.$key.'%');
       })->leftJoin('categories','categories.id','products.category_id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);

       return view('admin.products.list',compact('products'));
       $products->appends(request()->all());
    }

    //direct product create page
    public function createPage(){
        $categories=Category::select('id','name')->get();
        return view('admin.products.createPage',compact('categories'));
    }

    //product create process
    public function createProcess(Request $request){
       $this->productValiCheck($request,'create');
       $productData=$this->productData($request);

       $image=uniqid() .$request->file('pizzaImage')->getClientOriginalName();
       $request->file('pizzaImage')->storeAs('public',$image);
       $productData['image']=$image;

       Product::create($productData);
       return redirect()->route('products#list');

    }

    //delete product process
    public function deleteProcess($id){
        Product::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'product deleted successfully']);
    }

    //derict product detail page
    public function detail($id){
        $detail=Product::select('products.*','categories.name as category_name')
                ->where('products.id',$id)
                ->leftJoin('categories','categories.id','products.category_id')
                ->first();
        return view('admin.products.detail',compact('detail'));
    }

    //direct product edit page
    public function editPage($id){
        $edit=Product::where('id',$id)->first();
        $category=Category::select('id','name')->get();
        return view('admin.products.editPage',compact('edit','category'));
    }

    //update product process
    public function editProcess(Request $request){
        $this->productValiCheck($request,'update');
        $productData=$this->productData($request);
        $id=$request->pizzaId;

        if($request->hasFile('pizzaImage')){
            $oldImage=Product::where('id',$id)->first();
            $oldImage=$oldImage->image;
            if($oldImage!=null){
                Storage::delete('public',$oldImage);
           }
           $newImage=uniqid().$request->file('pizzaImage')->getClientOriginalName();
           $request->file('pizzaImage')->storeAs('public',$newImage);
           $productData['image']=$newImage;
        }
        Product::where('id',$id)->update($productData);
        return redirect()->route('products#list')->with(['updateSuccess'=>'Product updated successfully']);
    }

    //product create get date
    private function productData($request){
        return[
            'name'=>$request->pizzaName,
            'category_id'=>$request->pizzaCategory,
            'description'=>$request->pizzaDescription,
            'waiting_time'=>$request->pizzaWaitingTime,
            'price'=>$request->pizzaPrice, 

        ];
    }

    //product validation check
    private function productValiCheck($request,$action){
        $validationRules=[
            'pizzaName'=>'required|unique:products,name,'.$request->pizzaId,
            'pizzaCategory'=>'required',
            'pizzaDescription'=>'required',
            'pizzaPrice'=>'required',
            'pizzaWaitingTime'=>'required',
        ];
        $validationRules['pizzaImage'] =$action =='create'? 'required|mimes:jpg,jpeg,png,bmp,tiff,webp|file':'mimes:jpg,jpeg,png,bmp,tiff,webp|file';
        Validator::make($request->all(),$validationRules)->validate();
    }

}