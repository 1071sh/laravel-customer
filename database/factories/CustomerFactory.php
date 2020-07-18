<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'shop_id' => mt_rand(1, 3),  // ショップIDは１が本店、２が名古屋、３が大阪
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'postal' => $faker->postcode,
        'address' => $faker->address,
        'birthdate' => $faker->dateTimeBetween('-90 years', '-18 years'), // 18歳から90歳までの誕生日を生成
        'phone'=> $faker->phoneNumber,
        'kramer_flag' => 0,  // クレーマーフラグ とりあえず全員 0 にしておく
    ];
});
