<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';
    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot', 'jenis_kriteria'];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class, 'id_kriteria');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class, 'id_kriteria');
    }
}
