<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //direct login page
    public function login(){
      return view('login');
    }

    //direst register page
    public function register(){
        return view('register');
    }

    //to seperate admin's and user's process
    public function dashboard(){
        if(Auth::user()->role=='admin'){
            return redirect()->route('cate#list');
        }else{
            return redirect()->route('user#home');
        }
    }

   

}