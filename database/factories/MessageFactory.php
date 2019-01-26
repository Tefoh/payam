<?php

use App\User;
use Faker\Generator as Faker;
use App\Qasedak\Message\Message;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'user_id' => function() { return Factory(User::class)->create()->id; },
        'author' => function() { return Factory(User::class)->create()->id; },
        'body' => $faker->text()
    ];
});
