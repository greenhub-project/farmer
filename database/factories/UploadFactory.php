<?php

use Faker\Generator as Faker;
use App\Farmer\Models\Upload;

$factory->define(Upload::class, function (Faker $faker) {
    return [
        'data' => $faker->text
    ];
});
