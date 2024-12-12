<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Alternatif 1
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 1,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 2,
            'nilai' => 0.11,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 4,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 5,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 6,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 1,
            'id_kriteria' => 7,
            'nilai' => 0.26,
        ]);

        // Alternatif 2
        Penilaian::create([
            'id_alternatif' => 2,
            'id_kriteria' => 1,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 2,
            'id_kriteria' => 2,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 2,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 2,
            'id_kriteria' => 4,
            'nilai' => 0.51,
        ]);

        // Alternatif 3
        Penilaian::create([
            'id_alternatif' => 3,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 3,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 3,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 3,
            'id_kriteria' => 4,
            'nilai' => 0.51,
        ]);

        // Alternatif 4
        Penilaian::create([
            'id_alternatif' => 4,
            'id_kriteria' => 1,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 4,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 4,
            'id_kriteria' => 3,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 4,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 5
        Penilaian::create([
            'id_alternatif' => 5,
            'id_kriteria' => 1,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 5,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 5,
            'id_kriteria' => 3,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 5,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 6
        Penilaian::create([
            'id_alternatif' => 6,
            'id_kriteria' => 1,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 6,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 6,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 6,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 7
        Penilaian::create([
            'id_alternatif' => 7,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 7,
            'id_kriteria' => 2,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 7,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 7,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 8
        Penilaian::create([
            'id_alternatif' => 8,
            'id_kriteria' => 1,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 8,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 8,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 8,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 9
        Penilaian::create([
            'id_alternatif' => 9,
            'id_kriteria' => 1,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 9,
            'id_kriteria' => 2,
            'nilai' => 0.11,
        ]);
        Penilaian::create([
            'id_alternatif' => 9,
            'id_kriteria' => 3,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 9,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 10
        Penilaian::create([
            'id_alternatif' => 10,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 10,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 10,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 10,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 11
        Penilaian::create([
            'id_alternatif' => 11,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 11,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 11,
            'id_kriteria' => 3,
            'nilai' => 0.25,
        ]);
        Penilaian::create([
            'id_alternatif' => 11,
            'id_kriteria' => 4,
            'nilai' => 0.26,
        ]);

        // Alternatif 12
        Penilaian::create([
            'id_alternatif' => 12,
            'id_kriteria' => 1,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 12,
            'id_kriteria' => 2,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 12,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 12,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 13
        Penilaian::create([
            'id_alternatif' => 13,
            'id_kriteria' => 1,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 13,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 13,
            'id_kriteria' => 3,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 13,
            'id_kriteria' => 4,
            'nilai' => 0.51,
        ]);

        // Alternatif 14
        Penilaian::create([
            'id_alternatif' => 14,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 14,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 14,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 14,
            'id_kriteria' => 4,
            'nilai' => 0.26,
        ]);

        // Alternatif 15
        Penilaian::create([
            'id_alternatif' => 15,
            'id_kriteria' => 1,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 15,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 15,
            'id_kriteria' => 3,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 15,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 16
        Penilaian::create([
            'id_alternatif' => 16,
            'id_kriteria' => 1,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 16,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 16,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 16,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 17
        Penilaian::create([
            'id_alternatif' => 17,
            'id_kriteria' => 1,
            'nilai' => 0.25,
        ]);
        Penilaian::create([
            'id_alternatif' => 17,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 17,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 17,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 18
        Penilaian::create([
            'id_alternatif' => 18,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 18,
            'id_kriteria' => 2,
            'nilai' => 0.26,
        ]);
        Penilaian::create([
            'id_alternatif' => 18,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 18,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 19
        Penilaian::create([
            'id_alternatif' => 19,
            'id_kriteria' => 1,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 19,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 19,
            'id_kriteria' => 3,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 19,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);

        // Alternatif 20
        Penilaian::create([
            'id_alternatif' => 20,
            'id_kriteria' => 1,
            'nilai' => 0.45,
        ]);
        Penilaian::create([
            'id_alternatif' => 20,
            'id_kriteria' => 2,
            'nilai' => 0.11,
        ]);
        Penilaian::create([
            'id_alternatif' => 20,
            'id_kriteria' => 3,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 20,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 21
        Penilaian::create([
            'id_alternatif' => 21,
            'id_kriteria' => 1,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 21,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 21,
            'id_kriteria' => 3,
            'nilai' => 0.09,
        ]);
        Penilaian::create([
            'id_alternatif' => 21,
            'id_kriteria' => 4,
            'nilai' => 0.06,
        ]);

        // Alternatif 22
        Penilaian::create([
            'id_alternatif' => 22,
            'id_kriteria' => 1,
            'nilai' => 0.04,
        ]);
        Penilaian::create([
            'id_alternatif' => 22,
            'id_kriteria' => 2,
            'nilai' => 0.61,
        ]);
        Penilaian::create([
            'id_alternatif' => 22,
            'id_kriteria' => 3,
            'nilai' => 0.15,
        ]);
        Penilaian::create([
            'id_alternatif' => 22,
            'id_kriteria' => 4,
            'nilai' => 0.13,
        ]);
    }
}
