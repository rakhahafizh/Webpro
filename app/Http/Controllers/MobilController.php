<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Mobil;
use Illuminate\Http\Request;
use App\Models\Penjualan;
use Carbon\Carbon;

class MobilController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $mobils = Mobil::when($search, function ($query) use ($search) {
            $query->where('nama_mobil', 'like', "%{$search}%")
                ->orWhere('merek', 'like', "%{$search}%");
        })->get();

        return view('mobils.index', compact('mobils'));
    }


    public function create()
    {
        return view('mobils.create');
    }

    public function edit(Mobil $mobil)
    {
        return view('mobils.edit', compact('mobil'));
    }

    public function update(Request $request, $id)
    {
        $mobil = Mobil::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama_mobil' => 'required|string',
            'merek' => 'required|string',
            'tahun' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar.*' => 'image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar baru
        ]);

        // Update data mobil
        $mobil->update([
            'nama_mobil' => $request->nama_mobil,
            'merek' => $request->merek,
            'tahun' => $request->tahun,
            'harga' => $request->harga,
        ]);

        // Proses gambar baru jika ada
        $gambarPaths = $mobil->gambar ? json_decode($mobil->gambar, true) : [];
        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $path = $file->store('images', 'public'); // Simpan gambar ke storage
                $gambarPaths[] = $path; // Tambahkan path baru ke array
            }
        }

        // Simpan kembali gambar ke database
        $mobil->gambar = json_encode($gambarPaths);
        $mobil->save();

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'harga' => 'required|numeric',
            'gambar.*' => 'nullable|image|max:2048', // Validasi setiap gambar
        ]);

        // Ambil data input selain gambar
        $data = $request->except('gambar');

        // Simpan banyak gambar
        if ($request->hasFile('gambar')) {
            $gambarPaths = [];
            foreach ($request->file('gambar') as $gambar) {
                $path = $gambar->store('images', 'public'); // Simpan di storage
                $gambarPaths[] = $path; // Tambahkan ke array
            }
            $data['gambar'] = json_encode($gambarPaths); // Simpan array gambar sebagai JSON
        }

        // Simpan data ke database
        Mobil::create($data);

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        $mobil = Mobil::findOrFail($id);

        if ($mobil->gambar) {
            $gambarPaths = json_decode($mobil->gambar, true); // Ubah ke array asosiatif
            if (is_array($gambarPaths)) {
                foreach ($gambarPaths as $path) {
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
            }
        }

        $mobil->delete();

        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil dihapus.');
    }

    public function beliSekarang($id)
    {
        $mobil = Mobil::findOrFail($id);

        // Simpan data penjualan
        Penjualan::create([
            'mobil_id' => $mobil->id,
            'merek' => $mobil->merek,
            'tahun' => $mobil->tahun,
            'harga' => $mobil->harga,
            'tanggal_terjual' => Carbon::now(),
            'jumlah' => 1, // Default 1 jika hanya satu mobil
            'total_harga' => $mobil->harga, // harga * jumlah (default 1)
        ]);        
        
        return redirect()->route('mobils.index')->with('success', 'Mobil berhasil dibeli dan dicatat di penjualan.');
    }


}