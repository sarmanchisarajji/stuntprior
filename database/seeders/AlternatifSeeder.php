<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tahun 2023
        Alternatif::create([
            'kode_alternatif' => 'A1',
            'nama_alternatif' => 'Kecamatan Mandonga',
            'c1' => 9,
            'c2' => 348,
            'c3' => 1552,
            'c4' => 22,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.948536594383073',
            'longitude' => '122.52121426571229'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A2',
            'nama_alternatif' => 'Kecamatan Baruga',
            'c1' => 25,
            'c2' => 585,
            'c3' => 842,
            'c4' => 34,
            'tahun_pemilihan' => '2023',
            'latitude' => '-4.023701767155827',
            'longitude' => '122.49532680680899'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A3',
            'nama_alternatif' => 'Kecamatan Puuwatu',
            'c1' => 62,
            'c2' => 838,
            'c3' => 1062,
            'c4' => 31,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.9603943626297347',
            'longitude' => '122.46823252376932'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A4',
            'nama_alternatif' => 'Kecamatan Kadia',
            'c1' => 11,
            'c2' => 1036,
            'c3' => 5496,
            'c4' => 11,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.9901032590038716',
            'longitude' => '122.50893689782357'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A5',
            'nama_alternatif' => 'Kecamatan Wua - Wua',
            'c1' => 27,
            'c2' => 943,
            'c3' => 2771,
            'c4' => 11,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.999712476919161',
            'longitude' => '122.49828629600496'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A6',
            'nama_alternatif' => 'Kecamatan Poasia',
            'c1' => 18,
            'c2' => 853,
            'c3' => 1131,
            'c4' => 8,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.9971219374983216',
            'longitude' => '122.54178830379779'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A7',
            'nama_alternatif' => 'Kecamatan Abeli',
            'c1' => 42,
            'c2' => 475,
            'c3' => 1102,
            'c4' => 5,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.979214180497728',
            'longitude' => '122.58357090136964'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A8',
            'nama_alternatif' => 'Kecamatan Kambu',
            'c1' => 30,
            'c2' => 676,
            'c3' => 942,
            'c4' => 15,
            'tahun_pemilihan' => '2023',
            'latitude' => '-4.014244828460889',
            'longitude' => '122.53012006735561'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A9',
            'nama_alternatif' => 'Kecamatan Nambo',
            'c1' => 5,
            'c2' => 202,
            'c3' => 466,
            'c4' => 3,
            'tahun_pemilihan' => '2023',
            'latitude' => '-4.003396272006417',
            'longitude' => '122.61215401118976'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A10',
            'nama_alternatif' => 'Kecamatan Kendari',
            'c1' => 79,
            'c2' => 779,
            'c3' => 1643,
            'c4' => 7,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.9702866082897144',
            'longitude' => '122.5993089505773'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A11',
            'nama_alternatif' => 'Kecamatan Kendari Barat',
            'c1' => 107,
            'c2' => 1226,
            'c3' => 1941,
            'c4' => 25,
            'tahun_pemilihan' => '2023',
            'latitude' => '-3.957519160404018',
            'longitude' => '122.53280558030384'
        ]);

        // Tahun 2022
        Alternatif::create([
            'kode_alternatif' => 'A12',
            'nama_alternatif' => 'Kecamatan Mandonga',
            'c1' => 12,
            'c2' => 343,
            'c3' => 1611,
            'c4' => 12,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.948536594383073',
            'longitude' => '122.52121426571229'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A13',
            'nama_alternatif' => 'Kecamatan Baruga',
            'c1' => 19,
            'c2' => 532,
            'c3' => 796,
            'c4' => 36,
            'tahun_pemilihan' => '2022',
            'latitude' => '-4.023701767155827',
            'longitude' => '122.49532680680899'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A14',
            'nama_alternatif' => 'Kecamatan Puuwatu',
            'c1' => 81,
            'c2' => 827,
            'c3' => 1050,
            'c4' => 21,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.9603943626297347',
            'longitude' => '122.46823252376932'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A15',
            'nama_alternatif' => 'Kecamatan Kadia',
            'c1' => 29,
            'c2' => 781,
            'c3' => 5715,
            'c4' => 10,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.9901032590038716',
            'longitude' => '122.50893689782357'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A16',
            'nama_alternatif' => 'Kecamatan Wua - Wua',
            'c1' => 8,
            'c2' => 856,
            'c3' => 2933,
            'c4' => 11,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.999712476919161',
            'longitude' => '122.49828629600496'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A17',
            'nama_alternatif' => 'Kecamatan Poasia',
            'c1' => 37,
            'c2' => 807,
            'c3' => 1148,
            'c4' => 7,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.9971219374983216',
            'longitude' => '122.54178830379779'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A18',
            'nama_alternatif' => 'Kecamatan Abeli',
            'c1' => 48,
            'c2' => 458,
            'c3' => 1095,
            'c4' => 6,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.979214180497728',
            'longitude' => '122.58357090136964'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A19',
            'nama_alternatif' => 'Kecamatan Kambu',
            'c1' => 16,
            'c2' => 596,
            'c3' => 993,
            'c4' => 13,
            'tahun_pemilihan' => '2022',
            'latitude' => '-4.014244828460889',
            'longitude' => '122.53012006735561'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A20',
            'nama_alternatif' => 'Kecamatan Nambo',
            'c1' => 61,
            'c2' => 199,
            'c3' => 432,
            'c4' => 3,
            'tahun_pemilihan' => '2022',
            'latitude' => '-4.003396272006417',
            'longitude' => '122.61215401118976'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A21',
            'nama_alternatif' => 'Kecamatan Kendari',
            'c1' => 27,
            'c2' => 729,
            'c3' => 1687,
            'c4' => 7,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.9702866082897144',
            'longitude' => '122.5993089505773'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A22',
            'nama_alternatif' => 'Kecamatan Kendari Barat',
            'c1' => 9,
            'c2' => 1004,
            'c3' => 2021,
            'c4' => 11,
            'tahun_pemilihan' => '2022',
            'latitude' => '-3.957519160404018',
            'longitude' => '122.53280558030384'
        ]);
    }
}
