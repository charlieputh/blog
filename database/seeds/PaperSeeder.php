<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Paper;
class PaperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generate the random papers
        for($i=1;$i<10;++$i) {
            $paper = Paper::create([
                'title' => '试卷' . $i,
                'multi_score' => 2,
                'judge_score' => 1,
                'time' => 30,
                'full_score' => 0,
                'start_time' => Carbon::createFromDate(2016, 12, 3)->toDateTimeString(),
                'end_time' => Carbon::createFromDate(2099, 8, 21)->toDateTimeString(),
            ]);

        }
    }
}
