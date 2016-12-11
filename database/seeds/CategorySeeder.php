<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

            foreach (Category::$base as $name) {
                Category::create([
                    'name' => $name,
                ]);

            }

    }
}
