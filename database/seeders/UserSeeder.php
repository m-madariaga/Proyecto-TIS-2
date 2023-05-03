<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'admin']);
        $permission1 = Permission::create(['name' => 'vista admin']);
        $role1->givePermissionTo($permission1);
        $role2 = Role::create(['name' => 'analista']);
        $permission2 = Permission::create(['name' => 'vista analista']);
        $role2->givePermissionTo($permission2);
        $role3 = Role::create(['name' => 'cliente']);
        $permission3 = Permission::create(['name' => 'vista cliente']);
        $role3->givePermissionTo($permission3);

        $user = new User();
            $user->name             = 'admin demo';
            $user->email            = 'admin@test.cl';
            $user->password         = bcrypt('asdf1234');
        $user->save();
        $user->assignRole($role1);

        $user = new User();
            $user->name             = 'analista demo';
            $user->email            = 'analista@test.cl';
            $user->password         = bcrypt('asdf1234');
        $user->save();
        $user->assignRole($role2);

        $user = new User();
            $user->name             = 'cliente demo';
            $user->email            = 'cliente@test.cl';
            $user->password         = bcrypt('asdf1234');
        $user->save();
        $user->assignRole($role3);

    }
}