<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'user')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $user = new User();
        $user->name = 'User';
        $user->email = 'user@sinci.com';
        $user->password = bcrypt('Server2106');
        $user->idgroup = 1;
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@sinci.com';

        
        $user->password = bcrypt('Server2106');
        $user->idgroup = 1;
        $user->save();
        $user->roles()->attach($role_admin);
     }
}
