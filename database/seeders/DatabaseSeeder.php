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

        $admins = User::where('level', 'admin')->get();
        foreach($admins as $admin){

            $admin->assignRole('admin');

        }

        $managers = User::where('level', 'manager')->get();
        foreach($managers as $manager){

            $manager->assignRole('manager');

        }

        $receptionists = User::where('level', 'receptionist')->get();
        foreach($receptionists as $receptionist){

            $receptionist->assignRole('receptionist');

        }

        $clients = User::where('level', 'client')->get();
        foreach($clients as $client){

            $client->assignRole('client');

        }


    }
}
