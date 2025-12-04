<?php

namespace App\Services;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Support\Collection;

class SawService
{
    /**
     * Hitung SAW dan kembalikan ranking alternatif.
     *
     * @return \Illuminate\Support\Collection
     */
    public function hitung(): Collection
    {
        $kriterias   = Kriteria::orderBy('id')->get();
        $alternatifs = Alternatif::orderBy('id')->get();

        // Ambil semua penilaian dalam bentuk matriks [alternatif][kriteria] = nilai
        $matrix = [];

        foreach ($alternatifs as $alt) {
            foreach ($kriterias as $krit) {
                $nilai = Penilaian::where('alternatif_id', $alt->id)
                    ->where('kriteria_id', $krit->id)
                    ->value('nilai');

                $matrix[$alt->id][$krit->id] = $nilai ?? 0;
            }
        }

        // Hitung max/min tiap kriteria untuk normalisasi
        $pembagi = [];

        foreach ($kriterias as $krit) {
            $values = collect($matrix)
                ->pluck($krit->id)
                ->filter(fn ($v) => $v !== null);

            if ($values->isEmpty()) {
                $pembagi[$krit->id] = 1; // supaya tidak bagi 0
                continue;
            }

            if ($krit->tipe === 'benefit') {
                $pembagi[$krit->id] = $values->max();
            } else { // cost
                $pembagi[$krit->id] = $values->min();
            }
        }

        // Normalisasi & hitung nilai akhir
        $hasil = collect();

        foreach ($alternatifs as $alt) {
            $nilaiAkhir = 0;
            $detail = [];

            foreach ($kriterias as $krit) {
                $xij = $matrix[$alt->id][$krit->id] ?? 0;
                $pj  = $pembagi[$krit->id] ?: 1;

                if ($krit->tipe === 'benefit') {
                    $rij = $pj != 0 ? $xij / $pj : 0;
                } else { // cost
                    $rij = $xij != 0 ? $pj / $xij : 0;
                }

                $vj = $krit->bobot * $rij;

                $nilaiAkhir += $vj;

                $detail[] = [
                    'kriteria' => $krit->nama,
                    'tipe'     => $krit->tipe,
                    'bobot'    => $krit->bobot,
                    'xij'      => $xij,
                    'rij'      => $rij,
                    'skor'     => $vj,
                ];
            }

            $hasil->push([
                'alternatif_id'   => $alt->id,
                'kode'            => $alt->kode,
                'nama'            => $alt->nama,
                'nilai_akhir'     => $nilaiAkhir,
                'detail_kriteria' => $detail,
            ]);
        }

        // Urutkan dari nilai akhir terbesar
        return $hasil->sortByDesc('nilai_akhir')->values();
    }
}
