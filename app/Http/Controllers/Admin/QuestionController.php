<?php
/**
 * Created by PhpStorm.
 * User: charlie
 * Date: 2017/1/5
 * Time: 20:30
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Question;
use Symfony\Component\HttpFoundation\Request;
class QuestionController extends Controller
{
    //GET THE QUESTION'S TYPE
    public static function getType($type){
        return Question::$Type[$type];
    }
    //GET THE QUESTION'S ANS
    public static function getAns($type, $ans) {
        return Question::$Ans[$type*4 + $ans];
    }
    public function index(Request $request){
        if($request->has('query'))
            $questions = Question::where('content','like','%'.$request->get('query').'%')->paginate(20);
        else if($request->get('filter') == 'all' || $request->get('filter'))
            $questions = Question::paginate(20);
        else if($request->get('filter') == 'multi')
            $questions = Question::where('type',0)->paginate(29);
        else
            $questions = Question::where('type',1)->paginate(20);
        return view('admin.questions.index',[
            'questions' =>$questions,
            'questions_count' => [
                'all' => Question::count(),
                'multi' => Question::where('type',0)->count(),
                'judge' => Question::where('type',1)->count(),
            ]
        ]);
    }
}