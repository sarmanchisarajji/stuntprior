<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class SubKriteriaController extends Controller
{
    public function indexSubkriteria()
    {
        $kriteria = Kriteria::with('subKriteria')->get();
        // dd($kriteria);
        return view('pages.data-subkriteria', [
            'kriterias' => $kriteria,
        ]);
    }

    public function tambahSubkriteria(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_subkriteria' => 'required',
            'nilai' => 'required',
        ]);

        SubKriteria::create([
            'nama_subkriteria' => $validate['nama_subkriteria'],
            'nilai' => $validate['nilai'],
            'id_kriteria' => $id,
        ]);

        toast('Berhasil tambah data!', 'success');
        return redirect()->back();
    }

    public function editSubkriteria(Request $request, $id)
    {
        $validate = $request->validate([
            'nama_subkriteria' => 'required',
            'nilai' => 'required',
        ]);

        $subkriteria = Subkriteria::findOrFail($id);
        $subkriteria->update([
            'nama_subkriteria' => $validate['nama_subkriteria'],
            'nilai' => $validate['nilai'],
            // 'id_kriteria' => $id,
        ]);

        toast('Berhasil ubah data!', 'success');
        return redirect()->back();
    }

    public function hapusSubkriteria($id)
    {
        $kriteria = SubKriteria::find($id);
        $kriteria->delete();

        toast('Berhasil hapus data!', 'success');
        return redirect()->back();
    }
}
