<?php

namespace Database\Seeders;

use App\Models\Api\Users\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Admin::create([
            'username' => 'admin_admin_skjsaf',
            'name' => 'Admin',
            'last' => 'Admin',
        ]);

        $key = $admin->key()->create([
            'value' => str()->random(10),
        ]);

        $key->user()->create([
            'email' => 'Admin@gmail.com',
            'password' => 'password',
        ]);
        
        // $this->call([
        //     WilayasSeeders::class,
        //     AlgerianDatabaseSeeder::class,
        // ]);
    }
}
