<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //bind with the articke
    protected $table = 'article';

    public function user(){
        return $this->belongsTo('App\User','uid','id');
    }
    public function category() {
        return $this->belongsTo('App\Category', ' cid', 'id');
    }
}
