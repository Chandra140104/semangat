<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    // Nama tabel (boleh dihapus kalau pakai konvensi 'alternatifs')
    protected $table = 'alternatifs';

    // Kolom yang boleh diisi mass-assignment
    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
    ];

    /**
     * Relasi: satu Alternatif punya banyak Penilaian
     */
    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }

    /**
     * Relasi many-to-many ke Kriteria via tabel penilaians
     */
    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'penilaians')
            ->withPivot('nilai')
            ->withTimestamps();
    }
}
