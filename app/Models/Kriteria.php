<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Nama tabel (boleh dihapus kalau pakai konvensi 'kriterias')
    protected $table = 'kriterias';

    protected $fillable = [
        'kode',
        'nama',
        'tipe',   // 'benefit' atau 'cost'
        'bobot',  // bobot kriteria
        'keterangan',
    ];

    /**
     * Relasi: satu Kriteria punya banyak Penilaian
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Relasi many-to-many ke Alternatif via penilaians
     */
    public function alternatifs()
    {
        return $this->belongsToMany(Alternatif::class, 'penilaians')
            ->withPivot('nilai')
            ->withTimestamps();
    }
}
