<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{

    public function indexPenilaian(Request $request)
    {
        // Mengambil daftar tahun yang unik
        $years = Alternatif::select('tahun_pemilihan')->distinct()->pluck('tahun_pemilihan');

        // Query untuk alternatif yang unik berdasarkan nama dan tahun
        $alternatifsQuery = Alternatif::select('id', 'nama_alternatif', 'tahun_pemilihan')
            ->groupBy('nama_alternatif', 'tahun_pemilihan', 'id');

        // Filter berdasarkan tahun_pemilihan jika diatur
        if ($request->has('tahun_pemilihan') && $request->input('tahun_pemilihan') != '') {
            $alternatifsQuery->where('tahun_pemilihan', $request->input('tahun_pemilihan'));
        }

        // Ambil data alternatif
        $alternatifs = $alternatifsQuery->get();

        // Filter alternatif berdasarkan pilihan
        $selectedAlternatifId = $request->input('id_alternatif');
        $selectedYear = $request->input('tahun_pemilihan');

        // Query dasar untuk penilaian dengan relasi alternatif dan kriteria
        $penilaiansQuery = Penilaian::with(['alternatif', 'kriteria']);

        // Filter penilaian berdasarkan alternatif dan tahun jika keduanya dipilih
        if ($selectedAlternatifId && $selectedYear) {
            $penilaiansQuery->whereHas('alternatif', function ($query) use ($selectedAlternatifId, $selectedYear) {
                $query->where('id', $selectedAlternatifId)
                    ->where('tahun_pemilihan', $selectedYear);
            });
        }

        // Mengambil hasil penilaian
        $penilaians = $penilaiansQuery->get();

        // Jika tidak ada penilaian, tetap ambil kriteria yang ada
        if ($penilaians->isEmpty() && $selectedAlternatifId) {
            $kriteria = Kriteria::with('subKriteria')->get();
            $penilaians = $kriteria->map(function ($kriteria) {
                return (object)[
                    'kriteria' => $kriteria,
                    'nilai' => null,
                    'id' => null
                ];
            });
        }

        return view('pages.data-penilaian', [
            'kriterias' => Kriteria::with('subKriteria')->get(),
            'alternatifs' => $alternatifs,
            'penilaians' => $penilaians,
            'years' => $years,
        ]);
    }


    public function editPenilaian(Request $request, $id)
    {
        // Cari data penilaian berdasarkan ID
        $penilaian = Penilaian::findOrFail($id);

        // Update nilai
        $penilaian->nilai = $request->input('nilai');
        $penilaian->save();

        // Ambil tahun pemilihan dan id alternatif dari request
        $tahunPemilihan = $request->input('tahun_pemilihan');
        $idAlternatif = $request->input('id_alternatif');

        // Redirect ke halaman data-penilaian dengan query string tahun_pemilihan dan id_alternatif
        toast('Berhasil melakukan penilaian!', 'success');
        return redirect('/admin/data-penilaian?_token=WDC03ojTxhPP5ppjLyzVeDYw1NpAWBlQpVc1ShRH&tahun_pemilihan=' . $tahunPemilihan . '&id_alternatif=' . $idAlternatif);
    }
}
