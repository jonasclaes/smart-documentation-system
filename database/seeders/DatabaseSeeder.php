<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\File;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         User::factory(30)->create();
         Client::factory(30)->create();
         File::factory(100)->create();
    }
}
