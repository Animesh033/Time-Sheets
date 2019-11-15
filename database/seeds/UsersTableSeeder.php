<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 1)->create();
        $roleId = 1;
        $user = App\User::findOrFail(1);

        $role = App\Role::find($roleId);

        $user->role()->associate($role);

        $user->save();
    }
}
