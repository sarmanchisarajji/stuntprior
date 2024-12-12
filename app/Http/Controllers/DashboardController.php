<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function indexDashboard()
    // {
    //     $alter = Alternatif::count();
    //     $kriter = Kriteria::count();

    //     // Ambil semua kriteria dan alternatif
    //     $kriterias = Kriteria::all();
    //     $alternatifs = Alternatif::all();

    //     // Ambil penilaian dari database
    //     $penilaians = Penilaian::with(['alternatif', 'kriteria'])->get();

    //     // Langkah 2: Normalisasi Matriks
    //     $normalizedMatrix = [];
    //     $maxValues = [];
    //     $minValues = [];
    //     foreach ($kriterias as $kriteria) {
    //         $nilaiPenilaians = $penilaians->where('id_kriteria', $kriteria->id);
    //         // dd($nilaiPenilaians);
    //         $min = $nilaiPenilaians->min('nilai');
    //         $max = $nilaiPenilaians->max('nilai');

    //         $maxValues[$kriteria->id] = $max;
    //         $minValues[$kriteria->id] = $min;

    //         foreach ($alternatifs as $alternatif) {
    //             $nilai = $penilaians->where('id_alternatif', $alternatif->id)
    //                 ->where('id_kriteria', $kriteria->id)
    //                 ->first()->nilai;

    //             // Langkah 3: Hitung utility
    //             if ($max == $min) {
    //                 $utility = 100;
    //             } else {
    //                 $utility = 100 * ($nilai - $min) / ($max - $min);
    //             }

    //             // Simpan hasil normalisasi
    //             $normalizedMatrix[$alternatif->id][$kriteria->id] = [
    //                 'max' => $max,
    //                 'min' => $min,
    //                 'utility' => $utility,
    //                 'bobot' => $kriteria->bobot,
    //                 'jenis_kriteria' => $kriteria->jenis_kriteria
    //             ];
    //         }
    //     }

    //     $groupedScoresByYear = [];
    //     foreach ($alternatifs as $alternatif) {
    //         $totalBenefit = 0;
    //         $totalCost = 0;
    //         $nilaiAkhirPerKriteria = [];

    //         foreach ($kriterias as $kriteria) {
    //             $utility = $normalizedMatrix[$alternatif->id][$kriteria->id]['utility'];
    //             $bobot = $normalizedMatrix[$alternatif->id][$kriteria->id]['bobot'];
    //             $jenis_kriteria = $normalizedMatrix[$alternatif->id][$kriteria->id]['jenis_kriteria'];

    //             // Hitung nilai akhir per kriteria
    //             $nilaiAkhir = $utility * $bobot;
    //             $nilaiAkhirPerKriteria[$kriteria->id] = $nilaiAkhir;

    //             // Kelompokkan nilai berdasarkan benefit atau cost
    //             if ($jenis_kriteria == 'benefit') {
    //                 $totalBenefit += $nilaiAkhir;
    //             } else {
    //                 $totalCost += $nilaiAkhir;
    //             }
    //         }

    //         // Ambil tahun pemilihan, latitude, dan longitude dari alternatif
    //         $tahun = $alternatif->tahun_pemilihan;
    //         $groupedScoresByYear[$tahun][] = [
    //             'alternatif' => $alternatif->nama_alternatif,
    //             'latitude' => $alternatif->latitude,  // Titik latitude
    //             'longitude' => $alternatif->longitude,  // Titik longitude
    //             'tahun' => $tahun,
    //             'c1' => $alternatif->c1,
    //             'c2' => $alternatif->c2,
    //             'c3' => $alternatif->c3,
    //             'c4' => $alternatif->c4,
    //             'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,
    //             'score' => $totalBenefit - $totalCost
    //         ];
    //     }
    //     // dd($groupedScoresByYear);

    //     // Urutkan skor tiap tahun dari yang tertinggi ke yang terendah
    //     foreach ($groupedScoresByYear as $tahun => $scores) {
    //         usort($scores, function ($a, $b) {
    //             return $b['score'] <=> $a['score'];
    //         });
    //         $groupedScoresByYear[$tahun] = $scores;
    //     }

    //     // dd($groupedScoresByYear);


    //     return view('pages.index1', [
    //         'alternatif' => $alter,
    //         'kriteria' => $kriter,
    //         'groupedScoresByYear' => $groupedScoresByYear
    //     ]);
    // }

    public function indexDashboard(Request $request)
    {
        // Ambil tahun dari request
        $inputYear = $request->input('tahun');

        // Hitung jumlah alternatif dan kriteria
        $alter = Alternatif::count();
        $kriter = Kriteria::count();

        // Ambil semua kriteria dan alternatif
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        $tahunList = Alternatif::select('tahun_pemilihan')->distinct()->get();

        // Ambil penilaian dari database dan filter berdasarkan tahun
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])
            ->when($inputYear, function ($query) use ($inputYear) {
                return $query->whereHas('alternatif', function ($query) use ($inputYear) {
                    $query->where('tahun_pemilihan', $inputYear);
                });
            })
            ->get();

        // Langkah 2: Normalisasi Matriks
        $normalizedMatrix = [];
        $maxValues = [];
        $minValues = [];

        foreach ($kriterias as $kriteria) {
            $nilaiPenilaians = $penilaians->where('id_kriteria', $kriteria->id);
            $min = $nilaiPenilaians->min('nilai');
            $max = $nilaiPenilaians->max('nilai');

            $maxValues[$kriteria->id] = $max;
            $minValues[$kriteria->id] = $min;

            foreach ($alternatifs as $alternatif) {
                // Ambil nilai penilaian untuk alternatif dan kriteria saat ini
                $nilaiPenilaian = $nilaiPenilaians->where('id_alternatif', $alternatif->id)->first();

                // Check if the value exists
                if ($nilaiPenilaian) {
                    $nilai = $nilaiPenilaian->nilai;

                    // Langkah 3: Hitung utility
                    if ($max == $min) {
                        $utility = 100; // Jika min == max, utility adalah 100
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
                } else {
                    // Handle missing nilai case if needed
                    $normalizedMatrix[$alternatif->id][$kriteria->id] = [
                        'max' => $max,
                        'min' => $min,
                        'utility' => 0, // or any default value
                        'bobot' => $kriteria->bobot,
                        'jenis_kriteria' => $kriteria->jenis_kriteria
                    ];
                }
            }
        }

        // Hitung total score per alternatif berdasarkan kriteria
        $groupedScoresByYear = [];
        foreach ($alternatifs as $alternatif) {
            // Cek apakah alternatif sesuai dengan tahun input
            if ($alternatif->tahun_pemilihan != $inputYear) {
                continue; // Lewati alternatif yang tidak sesuai tahun
            }

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

                // Kelompokkan nilai berdasarkan jenis kriteria
                if ($jenis_kriteria == 'benefit') {
                    $totalBenefit += $nilaiAkhir;
                } else {
                    $totalCost += $nilaiAkhir;
                }
            }

            // Ambil informasi dari alternatif untuk hasil akhir
            $tahun = $alternatif->tahun_pemilihan;
            $groupedScoresByYear[$tahun][] = [
                'alternatif' => $alternatif->nama_alternatif,
                // 'latitude' => $alternatif->latitude,
                // 'longitude' => $alternatif->longitude,
                'file_lokasi' => $alternatif->file_lokasi,
                'tahun' => $tahun,
                'c1' => $alternatif->c1,
                'c2' => $alternatif->c2,
                'c3' => $alternatif->c3,
                'c4' => $alternatif->c4,
                'c5' => $alternatif->c5,
                'c6' => $alternatif->c6,
                'c7' => $alternatif->c7,
                'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,
                'score' => $totalBenefit - $totalCost // Hitung score akhir
            ];
        }

        // Urutkan skor tiap tahun dari yang tertinggi ke yang terendah
        foreach ($groupedScoresByYear as $tahun => $scores) {
            usort($scores, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            $groupedScoresByYear[$tahun] = $scores; // Simpan hasil urutan
        }

        // Kembalikan view dengan data yang sudah diproses
        return view('pages.index', [
            'alternatif' => $alter,
            'kriteria' => $kriter,
            'groupedScoresByYear' => $groupedScoresByYear,
            'tahunList' => $tahunList,
        ]);
    }

    public function indexGuestDashboard(Request $request)
    {
        // Ambil tahun dari request
        $inputYear = $request->input('tahun');

        // Hitung jumlah alternatif dan kriteria
        $alter = Alternatif::count();
        $kriter = Kriteria::count();

        // Ambil semua kriteria dan alternatif
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::all();

        $tahunList = Alternatif::select('tahun_pemilihan')->distinct()->get();

        // Ambil penilaian dari database dan filter berdasarkan tahun
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])
            ->when($inputYear, function ($query) use ($inputYear) {
                return $query->whereHas('alternatif', function ($query) use ($inputYear) {
                    $query->where('tahun_pemilihan', $inputYear);
                });
            })
            ->get();

        // Langkah 2: Normalisasi Matriks
        $normalizedMatrix = [];
        $maxValues = [];
        $minValues = [];

        foreach ($kriterias as $kriteria) {
            $nilaiPenilaians = $penilaians->where('id_kriteria', $kriteria->id);
            $min = $nilaiPenilaians->min('nilai');
            $max = $nilaiPenilaians->max('nilai');

            $maxValues[$kriteria->id] = $max;
            $minValues[$kriteria->id] = $min;

            foreach ($alternatifs as $alternatif) {
                // Ambil nilai penilaian untuk alternatif dan kriteria saat ini
                $nilaiPenilaian = $nilaiPenilaians->where('id_alternatif', $alternatif->id)->first();

                // Check if the value exists
                if ($nilaiPenilaian) {
                    $nilai = $nilaiPenilaian->nilai;

                    // Langkah 3: Hitung utility
                    if ($max == $min) {
                        $utility = 100; // Jika min == max, utility adalah 100
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
                } else {
                    // Handle missing nilai case if needed
                    $normalizedMatrix[$alternatif->id][$kriteria->id] = [
                        'max' => $max,
                        'min' => $min,
                        'utility' => 0, // or any default value
                        'bobot' => $kriteria->bobot,
                        'jenis_kriteria' => $kriteria->jenis_kriteria
                    ];
                }
            }
        }

        // Hitung total score per alternatif berdasarkan kriteria
        $groupedScoresByYear = [];
        foreach ($alternatifs as $alternatif) {
            // Cek apakah alternatif sesuai dengan tahun input
            if ($alternatif->tahun_pemilihan != $inputYear) {
                continue; // Lewati alternatif yang tidak sesuai tahun
            }

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

                // Kelompokkan nilai berdasarkan jenis kriteria
                if ($jenis_kriteria == 'benefit') {
                    $totalBenefit += $nilaiAkhir;
                } else {
                    $totalCost += $nilaiAkhir;
                }
            }

            // Ambil informasi dari alternatif untuk hasil akhir
            $tahun = $alternatif->tahun_pemilihan;
            $groupedScoresByYear[$tahun][] = [
                'alternatif' => $alternatif->nama_alternatif,
                // 'latitude' => $alternatif->latitude,
                // 'longitude' => $alternatif->longitude,
                'file_lokasi' => $alternatif->file_lokasi,
                'tahun' => $tahun,
                'c1' => $alternatif->c1,
                'c2' => $alternatif->c2,
                'c3' => $alternatif->c3,
                'c4' => $alternatif->c4,
                'c5' => $alternatif->c5,
                'c6' => $alternatif->c6,
                'c7' => $alternatif->c7,
                'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,
                'score' => $totalBenefit - $totalCost // Hitung score akhir
            ];
        }

        // Urutkan skor tiap tahun dari yang tertinggi ke yang terendah
        foreach ($groupedScoresByYear as $tahun => $scores) {
            usort($scores, function ($a, $b) {
                return $b['score'] <=> $a['score'];
            });
            $groupedScoresByYear[$tahun] = $scores; // Simpan hasil urutan
        }

        // Kembalikan view dengan data yang sudah diproses
        return view('pages.guest', [
            'alternatif' => $alter,
            'kriteria' => $kriter,
            'groupedScoresByYear' => $groupedScoresByYear,
            'tahunList' => $tahunList,
        ]);
    }
}
