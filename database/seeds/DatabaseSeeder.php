<?php

use Illuminate\Database\Seeder;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ArticleSeeder::class);
        //$this->call(CategorySeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(QuestionSeeder::class);
        $this->call(PaperSeeder::class);
    }
}
