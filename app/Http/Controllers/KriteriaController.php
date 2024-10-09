<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function indexKriteria()
    {
        $kriteria = Kriteria::all();
        return view('pages.data-kriteria', [
            'kriterias' => $kriteria,
        ]);
    }

    public function tambahKriteria(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis_kriteria' => 'required|in:benefit,cost'
        ]);

        Kriteria::create([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_kriteria' => $request->jenis_kriteria,
        ]);

        toast('Berhasil tambah data!', 'success');
        return redirect()->back();
    }

    public function editKriteria(Request $request, $id)
    {
        $request->validate([
            'kode_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'jenis_kriteria' => 'required|in:benefit,cost'
        ]);

        // Cari kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Update data kriteria
        $kriteria->update([
            'kode_kriteria' => $request->kode_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'jenis_kriteria' => $request->jenis_kriteria,
        ]);

        toast('Berhasil ubah data!', 'success');
        return redirect()->back();
    }

    public function hapusKriteria($id)
    {
        // Cari kriteria berdasarkan ID
        $kriteria = Kriteria::findOrFail($id);

        // Hapus data kriteria
        $kriteria->delete();

        toast('Berhasil hapus data!', 'success');
        return redirect()->back();
    }
}
