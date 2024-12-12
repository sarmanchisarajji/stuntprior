<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';

    protected $fillable = [
        'nama_alternatif',
        'kode_alternatif',
        'c1',
        'c2',
        'c3',
        'c4',
        'c5',
        'c6',
        'c7',
        'tahun_pemilihan',
        'file_lokasi',
        // 'latitude',
        // 'longitude'
    ];

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_alternatif');
    }

    public static function boot()
    {
        parent::boot();

        // Hook into the created event
        static::created(function ($alternatif) {
            $alternatif->addDefaultPenilaian();
        });
    }

    public function addDefaultPenilaian()
    {
        $kriterias = Kriteria::all();

        foreach ($kriterias as $kriteria) {
            Penilaian::create([
                'id_alternatif' => $this->id,
                'id_kriteria' => $kriteria->id,
                'nilai' => null
            ]);
        }
    }
}
