<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kriteria::create([
            'kode_kriteria' => 'C1',
            'nama_kriteria' => 'Jumlah Stunting Per Kecamatan',
            'bobot' => 0.37,
            'jenis_kriteria' => 'cost',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C2',
            'nama_kriteria' => 'Jumlah Ibu Hamil Per Kecamatan',
            'bobot' => 0.22,
            'jenis_kriteria' => 'benefit',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C3',
            'nama_kriteria' => 'Jumlah Ibu Menyusui Per Kecamatan',
            'bobot' => 0.15,
            'jenis_kriteria' => 'benefit',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C4',
            'nama_kriteria' => 'Anak Berusia 0 - 23 Bulan',
            'bobot' => 0.10,
            'jenis_kriteria' => 'benefit',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C5',
            'nama_kriteria' => 'Berat Badan Lahir Rendah (BBLR)',
            'bobot' => 0.07,
            'jenis_kriteria' => 'cost',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C6',
            'nama_kriteria' => 'Kepadatan Penduduk Per KM² ',
            'bobot' => 0.04,
            'jenis_kriteria' => 'cost',
        ]);
        
        Kriteria::create([
            'kode_kriteria' => 'C7',
            'nama_kriteria' => 'Banyak Tenaga Ahli Gizi Per Puskesmas',
            'bobot' => 0.02,
            'jenis_kriteria' => 'benefit',
        ]);
    }
}
