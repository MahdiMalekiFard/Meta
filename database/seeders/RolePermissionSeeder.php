<?php

namespace Database\Seeders;

use App\Enums\PermissionsEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach (RoleEnum::values() as $iValue) {
            Role::create([
                'name' => $iValue,
            ]);
        }
        
        foreach (PermissionsEnum::values() as $iValue) {
            Permission::create(['name' => $iValue]);
        }
        
        //syncPermissions
        $admin_role = Role::whereName('admin')->first();
        $admin_role->syncPermissions(Permission::pluck('name'));
        
    }
}
