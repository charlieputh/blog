<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Create The User Table
        Schema::create('user',function (Blueprint $table){
            $table->increments('id');
            $table->integer('uid')->unsigned()->unique();
            $table->string('name');
            $table->tinyInteger('type');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Drop the Table
        Schema::drop('users');
    }
}
