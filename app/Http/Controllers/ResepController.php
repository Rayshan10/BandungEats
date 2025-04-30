<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    /**
     * Menampilkan semua resep
     */
    public function tampil(Request $request)
    {
        $resep = Resep::latest()->get();
        return view('resep.tampil', compact('resep'));
    }

    /**
     * Menampilkan resep berdasarkan kategori
     */
    public function kategori($kategori)
    {
        // Ubah dari LIKE menjadi exact match
        $resep = Resep::where('kategori', $kategori)->get();
        // dd($resep);
        return view('resep.kategori', [
            'resep' => $resep,
            'kategori' => $kategori
        ]);
    }

    /**
     * Form tambah resep baru.
     */
    public function tambah()
    {
        return view('resep.tambah');
    }

    /**
     * Simpan resep baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'video' => 'nullable|url',
            'time' => 'required|string|max:255',
            'difficulty' => 'required|string|max:255',
            'servings' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'steps' => 'required|string'
        ]);

        $imagePath = $request->hasFile('image') ? $request->file('image')->store('resep-images', 'public') : null;

        Resep::create([
            'kategori' => $validated['category'],
            'judul' => $validated['title'],
            'gambar' => $imagePath,
            'deskripsi' => $validated['description'],
            'link' => $validated['video'],
            'waktu' => $validated['time'],
            'kesulitan' => $validated['difficulty'],
            'porsi' => $validated['servings'],
            'bahan' => $validated['ingredients'],
            'langkah' => $validated['steps']
        ]);

        return redirect()->route('resep.tampil')->with('success', 'Resep berhasil ditambahkan!');
    }

    /**
     * Form edit resep.
     */
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        return view('resep.edit', compact('resep'));
    }

    /**
     * Update resep.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'video' => 'nullable|url',
            'difficulty' => 'required|string',
            'servings' => 'required|string',
            'time' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $resep = Resep::findOrFail($id);
        $resep->update([
            'kategori' => $validated['category'],
            'judul' => $validated['title'],
            'deskripsi' => $validated['description'],
            'link' => $validated['video'],
            'kesulitan' => $validated['difficulty'],
            'porsi' => $validated['servings'],
            'waktu' => $validated['time'],
            'bahan' => $validated['ingredients'],
            'langkah' => $validated['steps'],
        ]);

        if ($request->hasFile('image')) {
            if ($resep->gambar) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $path = $request->file('image')->store('resep-images', 'public');
            $resep->update(['gambar' => $path]);
        }

        return redirect()->route('resep.tampil')->with('success', 'Resep berhasil diperbarui!');
    }

    /**
     * Hapus resep.
     */
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);
        if ($resep->gambar) {
            Storage::disk('public')->delete($resep->gambar);
        }
        $resep->delete();

        return redirect()->route('resep.tampil')->with('success', 'Resep berhasil dihapus!');
    }
        public function show($id)
    {
        $resep = Resep::findOrFail($id);
        
        if (!$resep) {
            return abort(404, 'Resep tidak ditemukan');
        }

        return view('resep.detail', compact('resep'));
    }
        public function search(Request $request)
    {
        $keyword = $request->get('keyword');
        
        $resep = Resep::where('judul', 'LIKE', "%{$keyword}%")
                    ->orWhere('deskripsi', 'LIKE', "%{$keyword}%")
                    ->orWhere('kategori', 'LIKE', "%{$keyword}%")
                    ->get();

        return response()->json($resep);
    }
        public function home()
    {
        $rekomendasiResep = Resep::latest()->take(4)->get();
        return view('home', compact('rekomendasiResep'));
    }
}