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

class QuestionController extends Controller
{
    //GET THE QUESTION'S TYPE
    public static function getType($type){
        return Question::$Type[$type];
    }
}