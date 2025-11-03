<?php

namespace Tests;

use App\Http\Middleware\ForceLanguageMiddleware;
use App\Http\Middleware\LanguageMiddleware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

abstract class FeatureTestCase extends TestCase
{
    public static $setUpRunOnce = false;
//    use RefreshDatabase;
    use ActingAsTrait;

    protected static function assertArrayHasKeys(array $keys, array $subject): void
    {
        foreach ($keys as $key) {
            self::assertArrayHasKey($key, $subject);
        }
    }

    protected static function assertArrayHasKeysAndValues(array $keysAndValues, array $subject): void
    {
        foreach ($keysAndValues as $key => $value) {
            self::assertArrayHasKey($key, $subject);
            self::assertEquals($value, $subject[$key]);
        }
    }

    protected function assertArrayIsSimilar(array $expected, ?array $actual): void
    {
        if ($actual === null) {
            static::assertTrue(false, sprintf('The expected array %s does not similar to actual %s', '[' . implode(', ', $expected) . ']', 'null'));
        } else {
            static::assertEmpty(
                array_diff($expected, $actual), sprintf('The expected array %s does not similar to actual %s', '[' . implode(', ', $expected) . ']', '[' . implode(', ', $actual) . ']')
            );
        }
    }

    protected function assertResponseMessageContains(string $actual, array $expected): void
    {
        static::assertContains(
            $actual, $expected, "The message is \"{$actual}\" but should contain one of these messages: " . implode(' | ', $expected)
        );
    }

//    public function beforeRefreshingDatabase(): void
//    {
//        Config::set('database.default', 'metanext_backend_test');
//        Artisan::call('route:cache');
//        Artisan::call('db:seed RolePermissionSeeder');
//        Artisan::call('db:seed UserSeeder');
//        $this->withoutMiddleware([LanguageMiddleware::class, ForceLanguageMiddleware::class]);
//    }


}
