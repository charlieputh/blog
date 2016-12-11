<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //generate 10 random data for the articles
        for($i=0;$i<10;++$i){
            Article::create(array(
                'uid'=>rand(1,3),
                'cid'=>rand(1,6),
                'title'=>'标题'.$i,
                'content'=>'内容'.$i,
            ));
        }
    }
}
