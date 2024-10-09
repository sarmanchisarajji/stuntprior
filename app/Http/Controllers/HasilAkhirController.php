<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class HasilAkhirController extends Controller
{
    public function indexHasilAkhir()
    {
        // Ambil semua kriteria dan alternatif
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        // Ambil penilaian dari database dan kelompokkan berdasarkan tahun pemilihan
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])
            ->get()
            ->groupBy(function ($item) {
                return $item->alternatif->tahun_pemilihan; // Mengelompokkan berdasarkan tahun pemilihan
            });

        // Langkah 2: Normalisasi Matriks
        $normalizedMatrix = [];
        $maxValues = [];
        $minValues = [];

        // Proses normalisasi untuk setiap tahun
        foreach ($penilaians as $tahun => $nilaiPerTahun) {
            foreach ($kriterias as $kriteria) {
                $nilaiKriteria = $nilaiPerTahun->where('id_kriteria', $kriteria->id);
                $min = $nilaiKriteria->min('nilai');
                $max = $nilaiKriteria->max('nilai');

                $maxValues[$tahun][$kriteria->id] = $max;
                $minValues[$tahun][$kriteria->id] = $min;

                foreach ($alternatifs as $alternatif) {
                    // Ambil nilai berdasarkan alternatif dan kriteria
                    $nilai = $nilaiKriteria->where('id_alternatif', $alternatif->id)->first();

                    if ($nilai) {
                        // Langkah 3: Hitung utility
                        if ($max == $min) {
                            $utility = 100;
                        } else {
                            $utility = 100 * ($nilai->nilai - $min) / ($max - $min);
                        }

                        // Simpan hasil normalisasi
                        $normalizedMatrix[$tahun][$alternatif->id][$kriteria->id] = [
                            'max' => $max,
                            'min' => $min,
                            'utility' => $utility,
                            'bobot' => $kriteria->bobot,
                            'jenis_kriteria' => $kriteria->jenis_kriteria
                        ];
                    }
                }
            }
        }

        // Langkah 4 dan 5: Menghitung nilai akhir dan melakukan pengelompokan
        $groupedScoresByYear = [];
        foreach ($penilaians as $tahun => $penilaianPerTahun) {
            foreach ($penilaianPerTahun as $penilaian) {
                $alternatif = $penilaian->alternatif;
                // Pastikan alternatif hanya dihitung satu kali per tahun
                if (!isset($groupedScoresByYear[$tahun][$alternatif->id])) {
                    $totalBenefit = 0;
                    $totalCost = 0;
                    $nilaiAkhirPerKriteria = [];

                    foreach ($kriterias as $kriteria) {
                        // Ambil nilai utility berdasarkan tahun
                        $utility = $normalizedMatrix[$tahun][$alternatif->id][$kriteria->id]['utility'] ?? 0;
                        $bobot = $normalizedMatrix[$tahun][$alternatif->id][$kriteria->id]['bobot'] ?? 0;
                        $jenis_kriteria = $normalizedMatrix[$tahun][$alternatif->id][$kriteria->id]['jenis_kriteria'] ?? 'benefit';

                        // Hitung nilai akhir per kriteria
                        $nilaiAkhir = $utility * $bobot;
                        $nilaiAkhirPerKriteria[$kriteria->id] = $nilaiAkhir;

                        // Kelompokkan nilai berdasarkan benefit atau cost
                        if ($jenis_kriteria == 'benefit') {
                            $totalBenefit += $nilaiAkhir;
                        } else {
                            $totalCost += $nilaiAkhir;
                        }
                    }

                    // Simpan hasil nilai akhir per kriteria dan score untuk setiap tahun
                    $groupedScoresByYear[$tahun][$alternatif->id] = [
                        'alternatif' => $alternatif->nama_alternatif,
                        'tahun' => $tahun,
                        'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,
                        'score' => $totalBenefit - $totalCost
                    ];
                }
            }
        }

        // Ubah menjadi array biasa agar mudah diurutkan
        foreach ($groupedScoresByYear as $tahun => $scores) {
            $groupedScoresByYear[$tahun] = array_values($scores); // Mengubah ke array biasa
            usort($groupedScoresByYear[$tahun], function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });
        }

        // Tampilkan hasilnya ke view
        return view('pages.data-akhir', [
            'kriterias' => $kriterias,
            'alternatifs' => $alternatifs,
            'normalizedMatrix' => $normalizedMatrix,
            'groupedScoresByYear' => $groupedScoresByYear,  // Kirim hasil yang dikelompokkan ke view
            'maxValues' => $maxValues,
            'minValues' => $minValues
        ]);
    }



    public function indexGuestHasilAkhir()
    {
        // Ambil semua kriteria dan alternatif
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        // Ambil penilaian dari database
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])->get();

        // Langkah 2: Normalisasi Matriks
        $normalizedMatrix = [];
        $maxValues = [];
        $minValues = [];
        foreach ($kriterias as $kriteria) {
            $nilaiPenilaians = $penilaians->where('id_kriteria', $kriteria->id);
            // dd($nilaiPenilaians);
            $min = $nilaiPenilaians->min('nilai');
            $max = $nilaiPenilaians->max('nilai');

            $maxValues[$kriteria->id] = $max;
            $minValues[$kriteria->id] = $min;

            foreach ($alternatifs as $alternatif) {
                $nilai = $penilaians->where('id_alternatif', $alternatif->id)
                    ->where('id_kriteria', $kriteria->id)
                    ->first()->nilai;
                // dd($nilai);

                // Langkah 3: Hitung utility
                if ($max == $min) {
                    $utility = 100;
                } else {
                    $utility = 100 * ($nilai - $min) / ($max - $min);
                }

                // Simpan hasil normalisasi
                $normalizedMatrix[$alternatif->id][$kriteria->id] = [
                    'max' => $max,
                    'min' => $min,
                    'utility' => $utility,
                    'bobot' => $kriteria->bobot,
                    'jenis_kriteria' => $kriteria->jenis_kriteria
                ];
            }
            // dd($nilai);
        }
        // dd($normalizedMatrix);

        // Langkah 4 dan 5: Menghitung nilai akhir dan melakukan pengelompokan
        $groupedScoresByYear = [];
        foreach ($alternatifs as $alternatif) {
            $totalBenefit = 0;
            $totalCost = 0;
            $nilaiAkhirPerKriteria = [];

            foreach ($kriterias as $kriteria) {
                $utility = $normalizedMatrix[$alternatif->id][$kriteria->id]['utility'];
                $bobot = $normalizedMatrix[$alternatif->id][$kriteria->id]['bobot'];
                $jenis_kriteria = $normalizedMatrix[$alternatif->id][$kriteria->id]['jenis_kriteria'];

                // Hitung nilai akhir per kriteria
                $nilaiAkhir = $utility * $bobot;
                $nilaiAkhirPerKriteria[$kriteria->id] = $nilaiAkhir;

                // Kelompokkan nilai berdasarkan benefit atau cost
                if ($jenis_kriteria == 'benefit') {
                    $totalBenefit += $nilaiAkhir;
                } else {
                    $totalCost += $nilaiAkhir;
                }
            }

            // Simpan hasil nilai akhir per kriteria dan score untuk setiap tahun
            $tahun = $alternatif->tahun_pemilihan;  // Ambil tahun pemilihan dari alternatif
            $groupedScoresByYear[$tahun][] = [
                'alternatif' => $alternatif->nama_alternatif,
                'tahun' => $tahun,
                'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,
                'score' => $totalBenefit - $totalCost
            ];
        }

        // Urutkan skor tiap tahun dari yang tertinggi ke yang terendah
        foreach ($groupedScoresByYear as $tahun => $scores) {
            usort($scores, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            $groupedScoresByYear[$tahun] = $scores;  // Simpan kembali hasil yang sudah diurutkan
        }

        // Tampilkan hasilnya ke view
        return view('pages.data-akhir', [
            'kriterias' => $kriterias,
            'alternatifs' => $alternatifs,
            'normalizedMatrix' => $normalizedMatrix,
            'groupedScoresByYear' => $groupedScoresByYear,  // Kirim hasil yang dikelompokkan ke view
            'maxValues' => $maxValues,
            'minValues' => $minValues
        ]);
    }
}
