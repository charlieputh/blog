<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class oesControllers extends Controller
{
    public function index(){
        //$articles = Article::latest()->get();
        //return 'articles';
        return view('oes.index');
    }
}
