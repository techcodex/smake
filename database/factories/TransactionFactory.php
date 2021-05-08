<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
        'bank_id' => 1,
        'amount' => 100,
        'description' => 'Transaction Decription',
        'date' => '2020-05-08'
    ];
});
