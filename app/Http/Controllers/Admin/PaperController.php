<?php

namespace App\Http\Controllers\Admin;
use App\Paper;
use App\Question;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaperController extends Controller
{
    //
    public function listPapers() {

        $papers = Paper::where('full_score',0)->orderBy('created_at', 'desc')->paginate(10);
        return view('paper.index', [
            'papers' => $papers,
        ]);
    }
    //传入是字符串的问题
    public function testing($id){
    	$paper = Paper::find($id);
    	//$user  = Auth::user();
          $user = auth()->user();
        //dd($user->papers());
    	//未完成 进行判断学生

    	//如果是没有考过的
        $user_paper = $user->papers()->find($id);
        $now = Carbon::now();
        if($now->lt(Carbon::parse($paper->start_time)))
            abort('403', '考试未开始！');

        if(! $user_paper) // 未考过
            $user->papers()->attach($id, [
                'start_time'=>Carbon::now(),
                'end_time'=>Carbon::now()->addMinutes($paper->time)->min(Carbon::parse($paper->end_time)),
                'score'=>-1,
            ]);
            $paper->questions()->attach(
                Question::find(1)
            );
        //dd($user_paper);//怎么有时候是null 有时候又不是null
        //dd($paper->questions()->where('type', 0)->count());
        return view('paper.testing', [
            'paper'=>$paper,
            'user'=>$user,
            'user_paper'=>$user_paper,
        ]);
    }
}

