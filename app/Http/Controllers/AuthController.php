<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //login page
    public function loginPage(){
        return view('login');
    }
    public function registerPage(){
        return view('register');
    }
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }
    
}
