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
        'name' => $faker->unique()->name,
        'description' => $faker->sentence(),
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
