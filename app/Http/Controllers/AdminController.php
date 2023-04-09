<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //direct change password page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //process to change password
    public function changePasswordProcess(Request $request){
        $this->changePasswordValiCheck($request);

        $currentId=Auth::user()->id;

        $data= User::select('password')->where('id',$currentId)->first();
        $dbPassword=$data->password;

        $userOldPassword=$request->oldPassword;

        if(Hash::check($userOldPassword, $dbPassword)){
            $change=[
                'password'=>Hash::make($request->newPassword),
            ];
            User::where('id',Auth::user()->id)->update($change);
            return back()->with(['changeSuccess'=>'Password Changed Successfully']);
        }
        return back()->with(['changeFail'=>'Something wrong ..,Try again']);


    }

    //direct account detail page
    public function accountDetail(){
        return view('admin.account.detail');
    }


    //direct account edit page
    public function accountEdit(){
        return view('admin.account.edit');
    }

    //update process
    public function accountUpdate($id,Request $request){
        $this->updateValiCheck($request);
        $updateData=$this->updateData($request);

        if($request->hasFile('image')){
            $dbData=User::where('id',$id)->first();
            $dbImg=$dbData->image;

            if($dbImg!=null){
                Storage::delete('public/'.$dbImg);
            }

            $userImg=uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$userImg);
            $updateData['image']=$userImg;

        }
        User::where('id',$id)->update($updateData);
        return redirect()->route('admin#detail')->with(['UpdateAccoutSuccess'=>'Account updated successfully']);

    }


    //account admin list
    //direct admin list page
    public function adminList(){
        $admin=User::when(request('searchKey'),function($q){
            $key=request('searchKey');
            $q  ->orwhere('name','like','%'.$key.'%')
                ->orwhere('email','like','%'.$key.'%')
                ->orwhere('phone','like','%'.$key.'%')
                ->orwhere('address','like','%'.$key.'%')
                ->orwhere('gender','like','%'.$key.'%');
        })
                ->where('role','admin')
                ->paginate(3);

        $admin->appends(request()->all());
        return view('admin.account.adminList',compact('admin'));
    }

    //admin account delete process
    public function deleteProcess($id){
        User::where('id',$id)->delete();
        return back()->with(['deleteSucess'=>'Admin Account Deleted']);

    }

    //admin role change page
    public function roleChangePage($id){
        $role=User::where('id',$id)->first();
        return view('admin.account.rolechange',compact('role'));
    }

    //admin role change process
    public function roleChangeProcess($id,Request $request){
        $data=$this->changingData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#list')->with(['updateSuccess'=>'Account Role Changed']);
    }


    //private function area

    //account list get data
    private function changingData($request){
       return[
         'role'=>$request->role,
       ];
    }

    //account update validation check
        private function updateValiCheck($request){
            Validator::make($request->all(),[
                'name'=>'required|unique:users,name,'.$request->id,
                'email'=>'required',
                'phone'=>'required',
                'address'=>'required',
                'gender'=>'required'
            ])->validate();
        }

        //account update data
       private function updateData($request){
            return[
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'gender'=>$request->gender,
                'updated_at'=>Carbon::now(),
            ];
       }

    //password change validation check
    private function changePasswordValiCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:5|unique:users,password',
            'newPassword'=>'required|min:5',
            'confirmPassword'=>'required|min:5|same:newPassword'
        ])->validate();
    }


}