<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = kategori::orderBy('nama_kategori')->get();
        return view('manager.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('manager.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
            'deskripsi_kategori' => 'nullable'
        ]);

        kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi_kategori' => $request->deskripsi_kategori
        ]);

        return redirect()
            ->route('manager.kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(kategori $kategori)
    {
        return view('manager.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' 
                . $kategori->id_kategori . ',id_kategori',
            'deskripsi_kategori' => 'nullable'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi_kategori' => $request->deskripsi_kategori
        ]);

        return redirect()
            ->route('manager.kategori.index')
            ->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(kategori $kategori)
    {
        // cegah hapus kalau masih ada produk
        if ($kategori->produk()->count() > 0) {
            return back()->with('error', 'Kategori masih digunakan oleh produk');
        }

        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
