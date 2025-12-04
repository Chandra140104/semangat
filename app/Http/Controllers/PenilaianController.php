<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenilaianController extends Controller
{
    /**
     * Tampilkan form matriks penilaian.
     */
    public function create()
    {
        $alternatifs = Alternatif::orderBy('id')->get();
        $kriterias   = Kriteria::orderBy('id')->get();

        // Ambil penilaian yang sudah ada, supaya kalau mau edit bisa muncul angkanya
        $existingPenilaian = Penilaian::get()
            ->groupBy('alternatif_id')
            ->map(function ($items) {
                return $items->keyBy('kriteria_id');
            });

        return view('penilaian.input', compact('alternatifs', 'kriterias', 'existingPenilaian'));
    }

    /**
     * Simpan matriks penilaian ke database.
     */
    public function store(Request $request)
    {
        // Validasi basic: nilai harus array
        $request->validate([
            'nilai'   => 'required|array',
            'nilai.*' => 'array',
        ]);

        DB::transaction(function () use ($request) {
            foreach ($request->nilai as $alternatifId => $nilaiPerKriteria) {
                foreach ($nilaiPerKriteria as $kriteriaId => $nilai) {
                    // Kalau inputnya kosong, lewati saja
                    if ($nilai === null || $nilai === '') {
                        continue;
                    }

                    Penilaian::updateOrCreate(
                        [
                            'alternatif_id' => $alternatifId,
                            'kriteria_id'   => $kriteriaId,
                        ],
                        [
                            'nilai' => (float) $nilai,
                        ]
                    );
                }
            }
        });

        return redirect()
            ->route('penilaian.create')
            ->with('success', 'Penilaian berhasil disimpan.');
    }
}
