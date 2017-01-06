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
    public function index()
    {
        return view('admin.papers.index', [
            'papers' => Paper::with('questions')->paginate(10),
        ]);
    }

    public function create()
    {
        return view('admin.papers.create');
    }

    public function edit(Request $request, $id)
    {
        $questions_added = [];
        foreach(Paper::find($id)->questions()->get() as $question)
            $questions_added[] = $question->id;
       // dd($request->get('filter'));
        if($request->get('filter') == 'all' || $request->get('filter') == null)
            $questions = Question::paginate(20);
        else if($request->get('filter') == 'multi')
            $questions = Question::where('type', 0)->paginate(20);
        else
            $questions = Question::where('type', 1)->paginate(20);

        $paper = Paper::find($id);
        $questions = $questions;
        $questions_count =  [
        'all' => Question::count(),
        'multi' => Question::where('type', 0)->count(),
        'judge' => Question::where('type', 1)->count()
    ];

        return view('admin.papers.edit' ,
        compact('paper', 'questions', 'questions_added', 'questions_count'));

    }

    public function update(Request $request,$id){
        $start_time = Carbon::parse($request->get('start_time'));
        $end_time = Carbon::parse($request->get('end_time'));
        $this->validate($request, [
            'name'=>'required|unique:papers,title,'.$id,
            'multi_score'=>'required|numeric',
            'judge_score'=>'required|numeric',
            'time'=>'required|numeric',
            'start_time'=>'required|date_format:Y-m-d\TG:i|before:'.$end_time->toDateTimeString(),
            'end_time'=>'required|date_format:Y-m-d\TG:i'
        ]);
        $paper = Paper::find($id);
        $paper->fill([
            'title' => $request->get('name'),
            'multi_score' => $request->get('multi_score'),
            'judge_score' => $request->get('judge_score'),
            'time' => $request->get('time'),
            'full_score' => $paper->questions->where('type', 0)->count() * $request->get('multi_score') + $paper->questions->where('type', 1)->count() * $request->get('judge_score'),
            'start_time' => $request->get('start_time'),
            'end_time' => $request->get('end_time')
        ]);
        if($paper->save())
            return redirect('admin/papers');
        else
            return redirect()->back()->withInput()->withErrors('保存失败！');
    }

    public function destroy($id){
        $paper = Paper::find($id);
        $paper->questions()->sync([]);
        $paper->delete();
        return redirect()->back();
    }

    public function listPapers()
    {

        $papers = Paper::where('full_score', 0)->orderBy('created_at', 'desc')->paginate(10);
        return view('paper.index', [
            'papers' => $papers,
        ]);
    }

    //传入是字符串的问题
    public function testing($id)
    {
        $paper = Paper::find($id);
        //$user  = Auth::user();
        $user = auth()->user();
        //dd($user->papers());
        //未完成 进行判断学生

        //如果是没有考过的
        $user_paper = $user->papers()->find($id);
        $now = Carbon::now();
        if ($now->lt(Carbon::parse($paper->start_time)))
            abort('403', '考试未开始！');

        if (!$user_paper) // 未考过
            $user->papers()->attach($id, [
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now()->addMinutes($paper->time)->min(Carbon::parse($paper->end_time)),
                'score' => -1,
            ]);
        //进行试卷和问题的关联 关联了中间表才会有数据
        $paper->questions()->attach(
            Question::find(1)
        );
        //dd($user_paper);//怎么有时候是null 有时候又不是null
        //dd($paper->questions()->where('type', 0)->count());
        return view('paper.testing', [
            'paper' => $paper,
            'user' => $user,
            'user_paper' => $user_paper,
        ]);
    }

}

