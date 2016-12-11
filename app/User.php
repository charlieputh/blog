<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    protected $table = 'user';
    /**
     * The attributes that are mass assignab
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'name', 'password','type',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static $type = [
        'admin' => 0,
        'teacher' => 1,
        'student' => 2
    ];

    public static $typeName = [
        '管理员',
        '教师',
        '学生'
    ];

    public function papers() {
        return $this->belongsToMany('App\Paper', 'user_paper', 'uid', 'pid')
            ->withPivot('start_time', 'end_time', 'score');
    }

    public function questions() {
        return $this->belongsToMany('App\Question', 'user_question', 'uid', 'qid')
            ->withPivot('qid', 'ans');
    }
    public function questions_pid() {
        return $this->belongsToMany('App\Question', 'user_question', 'uid', 'pid')
            ->withPivot('qid', 'ans');
    }
}

