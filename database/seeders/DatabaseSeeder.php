<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->delete();
        User::factory(10)->create();
        Post::query()->delete();
        Post::factory(10)->create();

        $this->call([
            RoleSeeder::class,
        ]);
    }
}
