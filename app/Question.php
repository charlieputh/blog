<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    public static $Ans = ['A','B','C','D','正确','错误'];
    public static $Type=['单选','判断'];

    protected $fillable = [
        'content','type','A','B','C','D','ans'
    ];
    public function papers() {
        return $this->belongsToMany('App\Paper', 'paper_question', 'qid', 'pid');
    }

}
