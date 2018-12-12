<?php

use App\Rarity;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Rarity::class, function (Faker $faker) {
    // $rarities = [['Common', 1], ['Uncommon', 2], ['Rare', 3], ['Epic', 4], ['Legendary', 5]];
    // $r = array_random($rarities);
    $rarities = ['Common', 'Uncommon', 'Rare', 'Epic', 'Legendary'];
    return [
        'name' => $faker->unique()->randomElement($rarities),
        'level' => $faker->numberBetween(1, 5)
    ];
});

$factory->define(App\Power::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->unique()->name,
        'description' => $faker->sentence(),
        'active' => true
    ];
});

$factory->define(App\Card::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $faker->name,
        'power_id' => function () {
            return factory('App\Power')->create()->id;
        },
        'rarity_id' => function () {
            return factory('App\Rarity')->create()->id;
        },
        'health' => $faker->numberBetween(1, 1000),
        'damage' => $faker->numberBetween(1, 1000),
        'image' => '',
        'active' => true
    ];
});

$factory->state(App\Card::class, 'mysql', function ($faker) {
    $rarities = Rarity::all()->toArray();
    $k = rand(0, (count($rarities) - 1));

    return [
        'rarity_id' => $rarities[$k]['id']
    ];
});

$factory->define(App\Game::class, function (Faker $faker) {
    // 2 player game meta
    $p1 = factory('App\User')->create();
    $p2 = factory('App\User')->create();
    $meta = [
        'rules' => [
            'min_players' => config('susan.min_players'),
            'max_players' => config('susan.max_players'),
            'starting_card_count' => config('susan.starting_card_count')
        ],
        'players' => [
            $p1->id => [
                'name' => $p1->name,
                'starting_cards' => [
                ]
            ],
            $p2->id => [
                'name' => $p2->name,
                'starting_cards' => [
                ]
            ]
        ]
    ];

    $now = \Carbon\Carbon::now();

    return [
        'name' => $p1->name.' vs. '.$p2->name.' - '.$now->format('D, M jS, Y h:i A'),
        'user_id' => $p1->id,
        'meta' => $meta,
        'winner_id' => null,
        'completed' => false,
        'archived' => false
    ];
});

$factory->state(App\Game::class, 'completed', function ($faker) {
    return [
        'completed' => true
    ];
});
