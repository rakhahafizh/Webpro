<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    // Menampilkan halaman rekap penjualan
    public function index()
    {
        $penjualans = Penjualan::all(); // Ambil semua data penjualan
        return view('sales.index', compact('penjualans'));
    }
}
