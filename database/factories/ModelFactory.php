<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Task::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->name,
        'category' => $faker->randomElement($array = array ('cat a','cat b','cat c')),
        'state' => $faker->boolean,
        
    ];
});
$factory->define(App\Label::class, function (Faker\Generator $faker) {

    $name=$faker->domainWord;
    return [
        'name' => $name,
        'slug' => str_slug($name, '-')
    ];
});
$factory->define(App\Track::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->name,
        'release_date' => $faker->dateTime,
        'label_id' => function () {
            return factory(App\Label::class)->create()->id;
        }
    ];
});
