<?php

namespace Tests;

use App\Enums\PermissionsEnum;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Throwable;

trait ActingAsTrait
{
    protected ?UserContract $loggedIn = null;

    protected array $availableActs = [User::class];

    /**
     * @throws Exception|Throwable
     */
    public function actingAsUser(bool $create = false, array $attributes = [])
    {
        return $this->loginWith(User::class, 'api', $create, $attributes);
    }

    public function getLoggedIn(): ?UserContract
    {
        return $this->loggedIn;
    }

    public function getLoggedInId()
    {
        return $this->loggedIn->getAuthIdentifier();
    }

    /**
     * @throws Exception|Throwable
     */
    public function loginWith(
        string $userClass,
        ?string $guard = null,
        bool $create = false,
        array $attributes = []
    ) {
        throw_if(
            !in_array($userClass, $this->availableActs),
            Exception::class,
            'There is no valid user.'
        );

        $user = $create ?
            $userClass::factory()->create($attributes) :
            $userClass::factory()->make($attributes);

        $this->loggedIn = $user;

        foreach (PermissionsEnum::cases() as $case) {
            Permission::firstOrCreate([
                'name' => $case->value
            ]);
        }
        $role = Role::create([
            'name' => 'user'
        ]);
        $role->syncPermissions(Permission::all()->pluck('name')->toArray());
        $user->syncRoles($role);

        return $this->actingAs($user, $guard);
    }
}
