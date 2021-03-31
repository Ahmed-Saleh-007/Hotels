<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();

        //creating four roles
        $roles = [
            'admin',
            'manager',
            'receptionist',
            'client',
         ];
      
         foreach ($roles as $role) {
              Role::create(['name' => $role]);
         }

         $user = User::where('level','admin')->first();
         $user->assignRole('admin');

    }
}
