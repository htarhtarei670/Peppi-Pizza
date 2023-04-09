<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Reply;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function contactUsPage(){
        //admin reply moti for user side
        $replies=Reply::where('user_id',Auth::user()->id)->get();
        return view('user.contact.contact',compact('replies'));
    }

    //get contact info for user side
    public function contactInfo(Request $request){
        $this->valiContactInfo($request);
        $messages=$this->getContactData($request);
        Contact::create($messages);
        return back()->with(['createSuccess'=>'We got your messages and we will reply as soon as possible ']);
    }

    //direct contact page for admin side
    public function contactMessage(){
        $contactUsers=Contact::get();
        return view('admin.contact.contact',compact('contactUsers'));
    }

    // direct contact message reply for admin side
    public function messageReplyPage($id){
        $contactMessage=Contact::where('id',$id)->first();
        return view('admin.contact.reply',compact('contactMessage'));
    }

    // contact message reply process for admin side
    public function messageReplyProcess(Request $request ){
        $data=Contact::where('id',$request->userId)->first();
        $this->valiReplyInfo($request);
        $replies=$this->getReplyData($request);
        $contactUsers=Contact::get();

        Reply::create($replies);
        return view('admin.contact.contact',compact('contactUsers'));
    }


    //delete current contact data for admin side
    public function contactMessageDelete($id){
        Contact::where('id',$id)->delete();
        return back()->with(['deleteSuccess'=>'This message is banned']);
    }

    //direct admin reply page for user side
    public function contactReplyPage(){
        $adminReply=Reply::where('user_id',Auth::user()->id)->get();
        return view('user.contact.adminReply',compact('adminReply'));
    }

    // admin reply process for user side
    public function contactReplyProcess(Request $request){
        $userReply=$this->getContactData($request);
        Contact::create($userReply);
        return back()->with(['createSuccess'=>'We got your messages and we will reply as soon as possible']);
    }

    // user comment delete in user side
    public function userCommentDelete($id){
        // Contact::where('id',$id)->get();
       Reply::where('id',$id)->delete();
       return back();
    }

    //--------------------------- private function area---------------------
    private function valiContactInfo($request){
        $vali=[
            'name'=>'required|min:3',
            'email'=>'required|email',
            'message'=>'required'
        ];
        Validator::make($request->all(),$vali)->validate();
    }

    // vali reply table for admin side
    private function valiReplyInfo($request){
        $vali=[
            'userId'=>'required',
            'userName'=>'required',
            'userEmail'=>'required',
            'message'=>'required',
            'reply'=>'required'
        ];
        Validator::make($request->all(),$vali)->validate();
    }

    // get contact info data for user side
    private function getContactData($request){
        return[
            'user_id'=>$request->userId,
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=>$request->message,
        ];
    }

    //get reply info for admin side
    private function getReplyData($request){
        return[
            'user_id'=>$request->userId,
            'user_name'=>$request->userName,
            'user_email'=>$request->userEmail,
            'user_comment'=>$request->message,
            'reply'=>$request->reply
        ];
    }

}