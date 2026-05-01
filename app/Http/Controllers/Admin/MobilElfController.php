<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MobilElf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MobilElfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semuaMobil = MobilElf::latest()->get();
        return view('admin.mobil.index', [
            'daftar_mobil' => $semuaMobil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.mobil.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_mobil'          => 'required|string|max:255',
        'plat_nomor'          => 'required|string|unique:mobil_elf,plat_nomor',
        'kapasitas_penumpang' => 'required|integer',
        'harga_sewa_per_hari' => 'required|integer',
        'transmisi'           => 'required|in:Manual,Otomatis',
        'foto_mobil'          => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk gambar
        'deskripsi'           => 'nullable|string',
    ]);

    // Proses upload file
    if ($request->hasFile('foto_mobil')) {
        // Simpan gambar dan dapatkan path-nya
        $path = $request->file('foto_mobil')->store('mobil_photos', 'public');
        $validatedData['foto_mobil'] = $path;
    }

    MobilElf::create($validatedData);

    return redirect()->route('mobil.index')->with('success', 'Data mobil elf baru berhasil ditambahkan!');
}

    /**
     * Display the specified resource.
     */
    public function show(MobilElf $mobil)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MobilElf $mobil)
    {
        return view('admin.mobil.edit', [
        'mobil' => $mobil
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MobilElf $mobil)
    {
        $rules = [
            'nama_mobil'          => 'required|string|max:255',
            'plat_nomor'          => 'required|string|unique:mobil_elf,plat_nomor,' . $mobil->id,
            'kapasitas_penumpang' => 'required|integer',
            'harga_sewa_per_hari' => 'required|integer',
            'transmisi'           => 'required|in:Manual,Otomatis',
            'foto_mobil'          => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'deskripsi'           => 'nullable|string',
            'status'              => 'required|in:tersedia,tidak_tersedia',
        ];

        $validatedData = $request->validate($rules);

        // Proses update file jika ada file baru yang diupload
        if ($request->hasFile('foto_mobil')) {
            // 1. Hapus foto lama jika ada
            if ($mobil->foto_mobil) {
                Storage::disk('public')->delete($mobil->foto_mobil);
            }
            // 2. Upload foto baru dan dapatkan path-nya
            $path = $request->file('foto_mobil')->store('mobil_photos', 'public');
            $validatedData['foto_mobil'] = $path;
        }

        $mobil->update($validatedData);

        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil diperbarui!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MobilElf $mobil)
    {
        $mobil->delete();
        return redirect()->route('mobil.index')->with('success', 'Data mobil berhasil dihapus!');
    }
}
