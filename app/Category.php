<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /*Original Starter Page Data Informaition*/
    protected $table = 'category';
    protected $fillable = ['name'];
    public function article(){
        return $this->hasMany('App\Article','cid','id');
    }
    public static $base = [
        '系统提示',
        '最新公告',
    ];
}
