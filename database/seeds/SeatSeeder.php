<?php

use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1;$i<=2;$i++)
        {
            for ($row=1;$row<=7;$row++)
            {
                for ($column=1;$column<=12;$column++)
                {
                    DB:table('seats')->insert([
                        'sId' => $i,
                        'row' => $row,
                        'column' => $column,
                        'status' => 0,
                    ]);
                }
            }
        }
//        $seats = factory(\App\model\Seat::class,function (){
//
//        })->create();


    }
}
