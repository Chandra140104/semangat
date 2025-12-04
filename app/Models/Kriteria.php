<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    protected $fillable = [
        'kode',
        'nama',
        'tipe',
        'bobot',
        'keterangan',
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
