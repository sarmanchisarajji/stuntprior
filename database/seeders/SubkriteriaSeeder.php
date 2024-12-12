<?php

namespace Database\Seeders;

use App\Models\Subkriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubkriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kriteria 1
        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Tinggi > 40%',
            'nilai' => 0.45,
            'id_kriteria' => 1,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi 30% - 40%',
            'nilai' => 0.25,
            'id_kriteria' => 1,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 20% - 30%',
            'nilai' => 0.15,
            'id_kriteria' => 1,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah 10% - 20%',
            'nilai' => 0.09,
            'id_kriteria' => 1,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Rendah < 10%',
            'nilai' => 0.04,
            'id_kriteria' => 1,
        ]);

        // Kriteria 2
        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi > 50%',
            'nilai' => 0.61,
            'id_kriteria' => 2,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 30% - 50%',
            'nilai' => 0.26,
            'id_kriteria' => 2,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah < 30%',
            'nilai' => 0.11,
            'id_kriteria' => 2,
        ]);

        // Kriteria 3
        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Tinggi > 40%',
            'nilai' => 0.51,
            'id_kriteria' => 3,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi 30% - 40%',
            'nilai' => 0.26,
            'id_kriteria' => 3,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 20% - 30%',
            'nilai' => 0.13,
            'id_kriteria' => 3,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah < 20%',
            'nilai' => 0.06,
            'id_kriteria' => 3,
        ]);

        // Kriteria 4
        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi > 50%',
            'nilai' => 0.61,
            'id_kriteria' => 4,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 30% - 50%',
            'nilai' => 0.26,
            'id_kriteria' => 4,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah < 30%',
            'nilai' => 0.11,
            'id_kriteria' => 4,
        ]);

        // Kriteria 5
        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi > 50%',
            'nilai' => 0.61,
            'id_kriteria' => 5,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 30% - 50%',
            'nilai' => 0.26,
            'id_kriteria' => 5,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah < 30%',
            'nilai' => 0.11,
            'id_kriteria' => 5,
        ]);

        // Kriteria 6
        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Tinggi > 50%',
            'nilai' => 0.45,
            'id_kriteria' => 6,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi 40% - 50%',
            'nilai' => 0.25,
            'id_kriteria' => 6,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 30% - 40%',
            'nilai' => 0.15,
            'id_kriteria' => 6,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah 20% - 30%',
            'nilai' => 0.09,
            'id_kriteria' => 6,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Rendah < 20%',
            'nilai' => 0.04,
            'id_kriteria' => 6,
        ]);

        // Kriteria 7
        Subkriteria::create([
            'nama_subkriteria' => 'Sangat Tinggi > 30 Ahli Gizi',
            'nilai' => 0.51,
            'id_kriteria' => 7,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Tinggi 20 - 30 Ahli Gizi',
            'nilai' => 0.26,
            'id_kriteria' => 7,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Sedang 10 - 20 Ahli Gizi',
            'nilai' => 0.13,
            'id_kriteria' => 7,
        ]);

        Subkriteria::create([
            'nama_subkriteria' => 'Rendah < 10 Ahli Gizi',
            'nilai' => 0.06,
            'id_kriteria' => 7,
        ]);
    }
}
