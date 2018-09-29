<?php

use App\Farmer\Models\Upload;
use Faker\Generator as Faker;

$factory->define(Upload::class, function (Faker $faker) {
    return [
        'data' => $faker->text,
    ];
});
