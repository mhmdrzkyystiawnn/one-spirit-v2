<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supir;
use Illuminate\Http\Request;

class SupirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaSupir = Supir::latest()->get();
        return view('admin.supir.index', [
            'daftar_supir' => $semuaSupir
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.supir.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nomor_hp'     => 'required|string|unique:supir,nomor_hp',
            'nomor_sim'    => 'required|string|unique:supir,nomor_sim',
            'alamat'       => 'nullable|string',
        ]);

        // 2. Jika validasi berhasil, simpan data ke database
        Supir::create($request->all());

        // 3. Alihkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('supir.index')->with('success', 'Data supir baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supir $supir)
{
    // Langsung kirim data supir yang sesuai ID ke view
    return view('admin.supir.edit', [
        'supir' => $supir
    ]);
}

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Supir $supir)
{
    // 1. Aturan validasi
    $rules = [
        'nama_lengkap' => 'required|string|max:255',
        'alamat'       => 'nullable|string',
        'status'       => 'required|in:tersedia,bertugas,libur',
    ];

    // Validasi nomor HP unik hanya jika diubah
    if ($request->nomor_hp != $supir->nomor_hp) {
        $rules['nomor_hp'] = 'required|string|unique:supir,nomor_hp';
    }

    // Validasi nomor SIM unik hanya jika diubah
    if ($request->nomor_sim != $supir->nomor_sim) {
        $rules['nomor_sim'] = 'required|string|unique:supir,nomor_sim';
    }

    $validatedData = $request->validate($rules);

    // 2. Update data ke database
    $supir->update($validatedData);

    // 3. Redirect kembali ke halaman index
    return redirect()->route('supir.index')->with('success', 'Data supir berhasil diperbarui!');
}

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Supir $supir)
{
    // Hapus data dari database
    $supir->delete();

    // Redirect kembali dengan pesan sukses
    return redirect()->route('supir.index')->with('success', 'Data supir berhasil dihapus!');
}
    }

