<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Subkriteria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AlternatifSeeder::class,
            KriteriaSeeder::class,
            SubkriteriaSeeder::class,
            PenilaianSeeder::class,
            UserSeeder::class,
        ]);
    }
}
