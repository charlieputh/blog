<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Category;

class HomeController extends Controller
{

   public function index(){
          $i=0;
       foreach(Category::$base as $base) {
           $baseId [] = Category::where('name', Category::$base[$i])->value('id');
           ++$i;
       }
       //dd($baseId[0]);
        $data = [
            //'baseId' => $baseId,
            //'baseInfo' => Category::withCount('articles')->get(),
            'articles_count' => Article::count(),
            //'systeminfo' => Article::latest()->get(),

            'systeminfo' => Article::where('cid', $baseId[0])->orderBy('created_at', 'desc')->first(),
            //'notices' => Article::where('cid', $baseId[1])->orderBy('created_at', 'desc')->take(8)->get(),
            //考试须知长期不改变 直接放进去字段
        ];

    	return view('test.index')->with('data',$data);
    }
}
