<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WeekSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $weeknames = array('Saturday','Sunday','Monday','Tuesday','Wednesday','Thrusday','Friday');
       foreach ($weeknames as $value)
       {
            DB::table('weekdays')->insert([
            'day' => $value,
            'start' => '6:30',
            'end' =>   '00:30'
        ]); 
       }
       
       
    }
}
