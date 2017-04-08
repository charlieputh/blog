<?php
use App\Category;
use App\Article;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

// Route::get('/', function () {
//     return view('app');
// });

//about Basic
Auth::routes();
Route::get('/','HomeController@index');
Route::get('/logout','Auth\LoginController@logout');
Route::get('user/{id}/resetPwd','Admin\UserController@changePwd');
Route::put('user/{id}/resetPwd', 'Admin\UserController@updatePwd');

//about Paper
Route::get('papers', 'Admin\PaperController@listPapers');
Route::get('paper/attachQuestionToPaper', 'Admin\PaperController@attachQuestionToPage');
Route::get('paper/{id}', 'Admin\PaperController@testing');


Route::resource('admin/papers', 'Admin\PaperController');

//about Question
Route::resource('admin/questions','Admin\QuestionController');

//about scoreMgr
Route::get('admin/scoreMgr', 'Admin\PaperController@scoreIndex');
//以上利用用户组和middleware进行测试和修改

