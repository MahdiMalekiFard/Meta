<?php

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

use App\Enums\RoleEnum;
use App\Http\Middleware\ForceLanguageMiddleware;
use App\Http\Middleware\LanguageMiddleware;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Config;

uses(
    Tests\FeatureTestCase::class,
    Illuminate\Foundation\Testing\DatabaseTransactions::class,
    WithFaker::class
)
    ->beforeEach(function () {
        Config::set('database.default', 'mysql');
        Config::set('database.connections.mysql.database', 'metanext_backend_test');
        Config::set('database.connections.mysql.username', 'root');
        Config::set('database.connections.mysql.password', '');
        //ensure this is only run once in hole test life cycle.
        if (!Tests\FeatureTestCase::$setUpRunOnce) {
            var_dump('before each just run once');
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed RolePermissionSeeder');
            Artisan::call('db:seed UserSeeder');
            test()->withoutMiddleware([LanguageMiddleware::class, ForceLanguageMiddleware::class]);
            Tests\FeatureTestCase::$setUpRunOnce = true;
        }
    })
    ->in('Feature');

uses(
    Tests\TestCase::class,
    Illuminate\Foundation\Testing\RefreshDatabase::class,
)->in('Unit');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function loginWithAdmin()
{
    $user = User::factory()->create();
    $user->assignRole(RoleEnum::ADMIN->value);
    return test()->actingAs($user);
}

function login(User $user = null)
{
    $user = $user ?: User::factory()->create();
    return test()->actingAs($user);
}