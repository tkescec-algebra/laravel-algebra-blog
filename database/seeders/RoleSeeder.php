<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::query()->delete();
        Role::insert([
            ['name' => 'Admin'],
            ['name' => 'User'],
            ['name' => 'Author'],
        ]);

        User::all()->each(function ($user) {
            $user->roles()->attach(Role::inRandomOrder()->first());
        });
    }
}
