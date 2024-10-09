<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    //

    public function indexAlternatif()
    {
        $alternatif = Alternatif::all();
        return view('pages.data-alternatif', [
            'alternatifs' => $alternatif,
        ]);
    }

    public function tambahAlternatif(Request $request)
    {
        $request->validate([
            'kode_alternatif' => 'required',
            'nama_alternatif' => 'required',
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tahun_pemilihan' => 'required',
        ]);

        Alternatif::create([
            'kode_alternatif' => $request->kode_alternatif,
            'nama_alternatif' => $request->nama_alternatif,
            'c1' => $request->c1,
            'c2' => $request->c2,
            'c3' => $request->c3,
            'c4' => $request->c4,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tahun_pemilihan' => $request->tahun_pemilihan,
        ]);

        toast('Berhasil tambah data!', 'success');
        return redirect()->back();
    }

    public function editAlternatif(Request $request, $id)
    {
        $request->validate([
            'kode_alternatif' => 'required',
            'nama_alternatif' => 'required',
            'c1' => 'required',
            'c2' => 'required',
            'c3' => 'required',
            'c4' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'tahun_pemilihan' => 'required',
        ]);

        $alternatif = Alternatif::findOrFail($id);

        $alternatif->update([
            'kode_alternatif' => $request->kode_alternatif,
            'nama_alternatif' => $request->nama_alternatif,
            'c1' => $request->c1,
            'c2' => $request->c2,
            'c3' => $request->c3,
            'c4' => $request->c4,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'tahun_pemilihan' => $request->tahun_pemilihan,
        ]);

        toast('Berhasil ubah data!', 'success');
        return redirect()->back();
    }

    public function hapusAlternatif($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        toast('Berhasil hapus data!', 'success');
        return redirect()->back();
    }
}