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
            'bobot' => 0.521,
            'jenis_kriteria' => 'benefit',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C2',
            'nama_kriteria' => 'Jumlah Ibu Hamil Per Kecamatan',
            'bobot' => 0.271,
            'jenis_kriteria' => 'benefit',
        ]);

        Kriteria::create([
            'kode_kriteria' => 'C3',
            'nama_kriteria' => 'Kepadatan Penduduk Per KM² ',
            'bobot' => 0.15,
            'jenis_kriteria' => 'benefit',
        ]);
        
        Kriteria::create([
            'kode_kriteria' => 'C4',
            'nama_kriteria' => 'Banyak Tenaga Ahli Gizi di Puskesmas',
            'bobot' => 0.06,
            'jenis_kriteria' => 'benefit',
        ]);
    }
}
