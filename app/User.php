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
        '管理员',          //ManageUser
        '教师',            //manage
        '学生'             //guest
    ];

    //getthe admin type
    public function getIsAdminAttribute(){
        return $this->isAdmin();
    }

    public function isAdmin(){
        return $this->type ==  User::$type['admin'];
    }

    public function isTeacher(){

         return $this->type == User::$type['teacher'];
    }

    public function isStudent(){
        return $this->type == User::$type['student'];
    }

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

    public static function getType($type){
        return User::$typeName[$type];
    }
}

