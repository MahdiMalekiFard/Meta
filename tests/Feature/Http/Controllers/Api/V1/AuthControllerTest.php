<?php

namespace Http\Controllers\Api\V1;

use App\Models\ActivationCode;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\postJson;
use function PHPUnit\Framework\assertTrue;

test('register', function (array $userData, int $expectedStatusCode) {
    $response = postJson('/api/v1/register', $userData);
    $user = User::where('email', $userData['email'])->first();
    $activationCode = ActivationCode::where('user_id', $user->id)->first();
    if ($expectedStatusCode === 422) {
        $response->assertJsonStructure([
            'message',
            'errors' => [
                'email',
            ],
        ]);
        return;
    }
    $response
        ->assertStatus($expectedStatusCode)
        ->assertJsonStructure([
            'message',
            'data' => [
                'id',
                'name',
                'family',
                'email',
            ],
        ])
        ->assertJson([
            'data' => [
                'email' => $userData['email'],
            ],
        ]);
    
    assertDatabaseHas('users', ['email' => $user->email]);
    assertDatabaseHas('activation_codes', [
        'user_id' => $user->id,
        'code'    => $activationCode->code,
    ]);
    
    expect($user->email)->toBe($userData['email']);
    
    assertTrue(Hash::check('password', $user->password));
    
})->with(function (): array {
    return [
        [
            [
                'name'                  => 'John Doe',
                'family'                => 'Doe',
                'email'                 => 'john@example.com',
                'password'              => 'password',
                'password_confirmation' => 'password',
                'terms'                 => true,
            ],
            200,
        ],
        [
            [
                'name'                  => 'Jane Doe',
                'family'                => 'Doe',
                'email'                 => 'admin@gmail.com',
                'password'              => 'password',
                'password_confirmation' => 'password',
                'terms'                 => true,
            ],
            422,
        ],
    ];
});

test('forget password', function () {
    $user = User::factory()->create([
        'email' => 'example@example.com',
    ]);
    $email = 'test@example.com';
    
    $response = $this->postJson('/api/v1/forget-password', ['email' => $user->email]);
    
    $response->assertStatus(200);
});

test('logout', function () {
    $user = User::factory()->create();
    
    $response = login($user)->postJson('/api/v1/logout');
    
    $response->assertStatus(200);
});

test('set password', function () {
    $user = User::factory()->create(['password' => Hash::make('old_password')]);
    $token = 'your_password_reset_token';
    
    $response = login($user)->postJson('/api/v1/set-password', [
        'password'              => 'password@New1',
        'password_confirmation' => 'password@New1',
    ]);
    $response->assertStatus(200);
    $this->assertTrue(Hash::check('password@New1', $user->fresh()->password));
});

test('login', function () {
    $user = User::factory()->create(['password' => Hash::make('password')]);
    
    $response = $this->postJson('/api/v1/login', [
        'email'    => $user->email,
        'password' => 'password',
    ]);
    $response->assertJsonStructure([
        'message',
        'data' => [
            'token',
            'user' => [
                'id',
                'name',
                'family',
                'email',
                'mobile',
                'created_at',
                'updated_at',
            ],
        ],
    ]);
    $response->assertStatus(200);
});

test('me', function () {
    $response = login()->getJson('/api/v1/me');
    $request = request();
    $url = $request->fullUrl();
    $headers = $request->headers->all();
    $response->assertStatus(200);
});

test('confirm', function () {
    $user = User::factory()->create([
        'email' => 'test2@example.com',
    ]);
    $activationCode = ActivationCode::factory()->create([
        'user_id' => $user->id,
        'code'    => 1111,
    ]);
    $response = $this->postJson('/api/v1/confirm', [
        'code'  => $activationCode->code,
        'email' => $user->email,
    ]);
    $response->assertStatus(200);
});