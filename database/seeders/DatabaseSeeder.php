<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\File;
use App\Models\Revision;
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
        User::factory(60)->create();
        Client::factory(60)->create();
        File::factory(100)->create();
        Revision::factory(500)->create();
    }
}
