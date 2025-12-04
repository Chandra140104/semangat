<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatifs';

    protected $fillable = [
        'kode',
        'nama',
        'keterangan',
    ];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}
