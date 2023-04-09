<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function list(){
        $categories=Category::when(request('searchKey'),function($query){
            $key=request('searchKey');
            $query->where('name','like','%'.$key.'%');

        })  ->orderBy('created_at','asc')
            ->paginate(4);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
   }

   //direct category create page
   public function createPage(){
        return view('admin.category.create');
   }

   //process of create
   public function createProcess(Request $request){
        $this->categoryValiCheck($request);
        $data=$this->categoryData($request);
        Category::create($data);
        return redirect()->route('cate#list');

   }

   //category delete
   public function deleteProcess($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'Deleted successfully']);
   }

   //direct edit page
   public function edit($id){
        $edit=Category::where('id',$id)->first();
        return view('admin.category.edit',compact('edit'));
   }

   //update process
   public function update(Request $request){
        $this->categoryValiCheck($request);
        $data=$this->categoryData($request);
        $id=$request->categoryId;

        Category::where('id',$id)->update($data);
        return redirect()->route('cate#list')->with(['updateSuccess'=>'updated successfully']);

   }

   //private category validation check
   private function categoryValiCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required|unique:categories,name,'.$request->categoryId,
        ])->validate();
   }

   //private get date category create
   private function categoryData($request){
        return[
            'name'=>$request->categoryName,
        ];
   }
}