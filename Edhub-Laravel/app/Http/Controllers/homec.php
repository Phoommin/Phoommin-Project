<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
class homec extends Controller
{
    function index(Request $request)
    {
         $id = 1;
         $request->session()->put('id_user',$id);

        return view('Home');
    }
}
