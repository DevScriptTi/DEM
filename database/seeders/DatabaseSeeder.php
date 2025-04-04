<?php

namespace Database\Seeders;

use App\Models\Api\Extra\Baladya;
use App\Models\Api\Extra\Wilaya;
use App\Models\Api\User\Admin;
use App\Models\Api\User\Gurdian;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            WilayasSeeders::class,
            AlgerianDatabaseSeeder::class,
        ]);
    }
}
