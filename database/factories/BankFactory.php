<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bank;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Bank::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
