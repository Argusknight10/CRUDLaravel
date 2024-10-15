<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForgetController extends Controller
{
    public function index(){
        return view('Forget.index', ['title' => 'FORGET PASSWORD PAGE']);
    }
}
