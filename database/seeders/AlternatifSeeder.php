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
            'c2' => 293,
            'c3' => 280,
            'c4' => 267,
            'c5' => 3,
            'c6' => 1552,
            'c7' => 22,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.948536594383073',
            // 'longitude' => '122.52121426571229'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A2',
            'nama_alternatif' => 'Kecamatan Baruga',
            'c1' => 25,
            'c2' => 691,
            'c3' => 650,
            'c4' => 628,
            'c5' => 7,
            'c6' => 842,
            'c7' => 34,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-4.023701767155827',
            // 'longitude' => '122.49532680680899'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A3',
            'nama_alternatif' => 'Kecamatan Puuwatu',
            'c1' => 62,
            'c2' => 824,
            'c3' => 770,
            'c4' => 748,
            'c5' => 18,
            'c6' => 1062,
            'c7' => 31,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.9603943626297347',
            // 'longitude' => '122.46823252376932'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A4',
            'nama_alternatif' => 'Kecamatan Kadia',
            'c1' => 11,
            'c2' => 1073,
            'c3' => 1012,
            'c4' => 976,
            'c5' => 13,
            'c6' => 5496,
            'c7' => 11,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.9901032590038716',
            // 'longitude' => '122.50893689782357'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A5',
            'nama_alternatif' => 'Kecamatan Wua - Wua',
            'c1' => 27,
            'c2' => 823,
            'c3' => 780,
            'c4' => 746,
            'c5' => 18,
            'c6' => 2771,
            'c7' => 11,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.999712476919161',
            // 'longitude' => '122.49828629600496'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A6',
            'nama_alternatif' => 'Kecamatan Poasia',
            'c1' => 18,
            'c2' => 842,
            'c3' => 790,
            'c4' => 765,
            'c5' => 29,
            'c6' => 1131,
            'c7' => 8,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.9971219374983216',
            // 'longitude' => '122.54178830379779'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A7',
            'nama_alternatif' => 'Kecamatan Abeli',
            'c1' => 42,
            'c2' => 404,
            'c3' => 380,
            'c4' => 370,
            'c5' => 11,
            'c6' => 1102,
            'c7' => 5,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.979214180497728',
            // 'longitude' => '122.58357090136964'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A8',
            'nama_alternatif' => 'Kecamatan Kambu',
            'c1' => 30,
            'c2' => 502,
            'c3' => 470,
            'c4' => 458,
            'c5' => 14,
            'c6' => 940,
            'c7' => 15,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-4.014244828460889',
            // 'longitude' => '122.53012006735561'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A9',
            'nama_alternatif' => 'Kecamatan Nambo',
            'c1' => 5,
            'c2' => 173,
            'c3' => 165,
            'c4' => 157,
            'c5' => 12,
            'c6' => 466,
            'c7' => 3,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-4.003396272006417',
            // 'longitude' => '122.61215401118976'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A10',
            'nama_alternatif' => 'Kecamatan Kendari',
            'c1' => 79,
            'c2' => 581,
            'c3' => 550,
            'c4' => 530,
            'c5' => 2,
            'c6' => 1643,
            'c7' => 7,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.9702866082897144',
            // 'longitude' => '122.5993089505773'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A11',
            'nama_alternatif' => 'Kecamatan Kendari Barat',
            'c1' => 107,
            'c2' => 858,
            'c3' => 800,
            'c4' => 782,
            'c5' => 7,
            'c6' => 1941,
            'c7' => 25,
            'tahun_pemilihan' => '2023',
            // 'latitude' => '-3.957519160404018',
            // 'longitude' => '122.53280558030384'
        ]);

        // Tahun 2022
        Alternatif::create([
            'kode_alternatif' => 'A12',
            'nama_alternatif' => 'Kecamatan Mandonga',
            'c1' => 12,
            'c2' => 729,
            'c3' => 580,
            'c4' => 599,
            'c5' => 13,
            'c6' => 1611,
            'c7' => 7,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.948536594383073',
            // 'longitude' => '122.52121426571229'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A13',
            'nama_alternatif' => 'Kecamatan Baruga',
            'c1' => 19,
            'c2' => 596,
            'c3' => 530,
            'c4' => 542,
            'c5' => 12,
            'c6' => 796,
            'c7' => 13,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-4.023701767155827',
            // 'longitude' => '122.49532680680899'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A14',
            'nama_alternatif' => 'Kecamatan Puuwatu',
            'c1' => 81,
            'c2' => 827,
            'c3' => 740,
            'c4' => 751,
            'c5' => 11,
            'c6' => 1050,
            'c7' => 21,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.9603943626297347',
            // 'longitude' => '122.46823252376932'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A15',
            'nama_alternatif' => 'Kecamatan Kadia',
            'c1' => 74,
            'c2' => 781,
            'c3' => 750,
            'c4' => 746,
            'c5' => 0,
            'c6' => 5715,
            'c7' => 10,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.9901032590038716',
            // 'longitude' => '122.50893689782357'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A16',
            'nama_alternatif' => 'Kecamatan Wua - Wua',
            'c1' => 48,
            'c2' => 807,
            'c3' => 750,
            'c4' => 765,
            'c5' => 17,
            'c6' => 2933,
            'c7' => 7,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.999712476919161',
            // 'longitude' => '122.49828629600496'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A17',
            'nama_alternatif' => 'Kecamatan Poasia',
            'c1' => 16,
            'c2' => 199,
            'c3' => 210,
            'c4' => 190,
            'c5' => 19,
            'c6' => 1148,
            'c7' => 3,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.9971219374983216',
            // 'longitude' => '122.54178830379779'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A18',
            'nama_alternatif' => 'Kecamatan Abeli',
            'c1' => 61,
            'c2' => 856,
            'c3' => 820,
            'c4' => 801,
            'c5' => 15,
            'c6' => 1095,
            'c7' => 11,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.979214180497728',
            // 'longitude' => '122.58357090136964'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A19',
            'nama_alternatif' => 'Kecamatan Kambu',
            'c1' => 27,
            'c2' => 458,
            'c3' => 460,
            'c4' => 454,
            'c5' => 20,
            'c6' => 993,
            'c7' => 6,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-4.014244828460889',
            // 'longitude' => '122.53012006735561'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A20',
            'nama_alternatif' => 'Kecamatan Nambo',
            'c1' => 9,
            'c2' => 1004,
            'c3' => 810,
            'c4' => 828,
            'c5' => 2,
            'c6' => 432,
            'c7' => 11,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-4.003396272006417',
            // 'longitude' => '122.61215401118976'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A21',
            'nama_alternatif' => 'Kecamatan Kendari',
            'c1' => 131,
            'c2' => 343,
            'c3' => 310,
            'c4' => 328,
            'c5' => 10,
            'c6' => 1687,
            'c7' => 12,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.9702866082897144',
            // 'longitude' => '122.5993089505773'
        ]);
        Alternatif::create([
            'kode_alternatif' => 'A22',
            'nama_alternatif' => 'Kecamatan Kendari Barat',
            'c1' => 105,
            'c2' => 532,
            'c3' => 520,
            'c4' => 506,
            'c5' => 6,
            'c6' => 2021,
            'c7' => 36,
            'tahun_pemilihan' => '2022',
            // 'latitude' => '-3.957519160404018',
            // 'longitude' => '122.53280558030384'
        ]);
    }
}
