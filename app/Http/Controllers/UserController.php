<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function dashboard(){
        if(Auth::user()->role === 'admin' ){
            return redirect()->route('admin.dashboard');
        }
        else{
            return redirect()->route('supervisor.dashboard');
        }
    }
}
