<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the admin user and assign the 'Administrateur' role
        $adminUser = User::factory()->create([
            'firstname' => 'reda',
            'lastname' => 'cherfaoui',
            'username' => 'reda21',
            'email' => 'redacherfaoui@gmail.com',
            'password' => bcrypt('bejaia21'),
        ]);

        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUser->roles()->attach($adminRole);
        }

        // Create 10 additional users
        User::factory()->count(10)->create();
    }
}
