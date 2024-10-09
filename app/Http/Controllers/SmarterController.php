<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class SmarterController extends Controller
{
    public function indexPerhitungan(Request $request)
    {
        // Ambil tahun yang dipilih, defaultnya tahun sekarang
        $tahun_pemilihan = $request->input('tahun_pemilihan', date('Y'));

        // Ambil semua kriteria dan alternatif berdasarkan tahun pemilihan
        $kriterias = Kriteria::all();
        $alternatifs = Alternatif::where('tahun_pemilihan', $tahun_pemilihan)->get();

        // Ambil semua tahun pemilihan yang ada
        $tahunList = Alternatif::select('tahun_pemilihan')->distinct()->get();

        // Mengelompokan proses perhitungan berdasarkan tahun pemilihan
        $penilaians = Penilaian::with(['alternatif', 'kriteria'])
            ->whereHas('alternatif', function ($query) use ($tahun_pemilihan) {
                $query->where('tahun_pemilihan', $tahun_pemilihan);
            })->get();

        // Langkah 1: Matriks Keputusan
        $matriksKeputusan = [];
        foreach ($alternatifs as $alternatif) {
            foreach ($kriterias as $kriteria) {
                $value = Penilaian::where('id_alternatif', $alternatif->id)
                    ->where('id_kriteria', $kriteria->id)
                    ->first();
                $matriksKeputusan[$alternatif->id][$kriteria->id] = $value;
            }
        }

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
                $nilai = $penilaians->where('id_alternatif', $alternatif->id)
                    ->where('id_kriteria', $kriteria->id)
                    ->first()->nilai;

                // Langkah 3: Hitung utility
                if ($max == $min) {
                    $utility = 100;
                } else {
                    $utility = 100 * ($nilai - $min) / ($max - $min);
                }

                $normalizedMatrix[$alternatif->id][$kriteria->id] = [
                    'max' => $max,
                    'min' => $min,
                    'utility' => round($utility, 3),
                    'bobot' => $kriteria->bobot,
                    'jenis_kriteria' => $kriteria->jenis_kriteria
                ];
            }
        }

        // Langkah 4 dan 5: Menghitung nilai akhir dan melakukan pengelompokan
        $finalScores = [];
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
                $nilaiAkhirPerKriteria[$kriteria->id] = $nilaiAkhir;  // Simpan nilai akhir per kriteria

                // Kelompokkan nilai berdasarkan benefit atau cost
                if ($jenis_kriteria == 'benefit') {
                    $totalBenefit += $nilaiAkhir;
                } else {
                    $totalCost += $nilaiAkhir;
                }
            }

            // Simpan hasil nilai akhir per kriteria dan score
            $finalScores[] = [
                'alternatif' => $alternatif->nama_alternatif,
                'kode_alternatif' => $alternatif->kode_alternatif,
                'tahun_pemilihan' => $alternatif->tahun_pemilihan,
                'nilaiAkhirPerKriteria' => $nilaiAkhirPerKriteria,  // Simpan nilai akhir per kriteria
                'score' => $totalBenefit - $totalCost // Simpan score akhir
            ];
        }

        // Urutkan hasil skor dari yang tertinggi ke yang terendah
        usort($finalScores, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });

        // Tampilkan hasilnya ke view
        return view('pages.data-perhitungan', [
            'tahun_pemilihan' => $tahun_pemilihan,
            'tahunList' => $tahunList,
            'kriterias' => $kriterias,
            'alternatifs' => $alternatifs,
            'matriksKeputusan' => $matriksKeputusan,
            'normalizedMatrix' => $normalizedMatrix,
            'finalScores' => $finalScores,
            'maxValues' => $maxValues,
            'minValues' => $minValues
        ]);
    }
}
