<?php
/**
 * Created by PhpStorm.
 * User: CoooooL
 * Date: 2018/4/19
 * Time: 11:37
 */
use Faker\Generator as Faker;


$factory->define(\App\model\Seat::class, function (Faker $faker) {
    return [
        'sId' => $faker->sId,
        'row' => $faker->row,
        'column' => $faker->column,
        'status' => $faker->status,
    ];
});

