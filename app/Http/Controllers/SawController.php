<?php

namespace App\Http\Controllers;

use App\Services\SawService;

class SawController extends Controller
{
    public function index(SawService $sawService)
    {
        $hasil = $sawService->hitung();

        // Untuk awal, tampilkan JSON saja dulu
        // nanti bisa kita ganti jadi tampilan Blade tabel
        return response()->json($hasil);
    }
}
