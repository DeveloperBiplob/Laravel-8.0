<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        for($i = 1; $i <10; $i++){
            Skill::create([
                'name' => Str::random(5),
                'user_id' => rand(1, 3)
            ]);
        }
    }
}
