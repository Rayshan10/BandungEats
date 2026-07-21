<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    /**
     * Menampilkan semua resep
     */
    public function tampil(Request $request)
    {
        $resep = Resep::latest()->get();
        return view('dashboard.resep.tampil', compact('resep'));
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
        return view('dashboard.resep.tambah');
    }

    /**
     * Simpan resep baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'category' => 'required|string|max:255',

            'title' => 'required|string|max:255',

            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'description' => 'required|string',

            'video' => [
                'nullable',
                'regex:/^(https?\:\/\/)?(www\.)?(youtube\.com\/watch\?v=|youtu\.be\/).+$/'
            ],

            'time' => 'required|string|max:255',

            'difficulty' => 'required|string|max:255',

            'servings' => 'required|string|max:255',

            'ingredients' => 'required|string',

            'steps' => 'required|string',

        ],[

            'video.regex' => 'Link harus berasal dari YouTube.'

        ]);

        $resep = new Resep();

        // Mapping Frontend → Database
        $resep->kategori   = $validated['category'];
        $resep->judul      = $validated['title'];
        $resep->deskripsi  = $validated['description'];
        $resep->link       = $validated['video'];
        $resep->waktu      = $validated['time'];
        $resep->kesulitan  = $validated['difficulty'];
        $resep->porsi      = $validated['servings'];
        $resep->bahan      = $validated['ingredients'];
        $resep->langkah    = $validated['steps'];

        if($request->hasFile('image')){

            $path = $request
                ->file('image')
                ->store('resep','public');

            $resep->gambar = $path;

        }

        $resep->save();

        return redirect()
                ->route('dashboard.resep')
                ->with('success','Resep berhasil ditambahkan.');
    }

    /**
     * Form edit resep.
     */
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);
        $youtubeId=$this->getYoutubeIdFromUrl($resep->link);

        return view('dashboard.resep.edit', compact('resep','youtubeId'));
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
            'video' => ['nullable','regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'],
            'difficulty' => 'required|string',
            'servings' => 'required|string',
            'time' => 'required|string',
            'ingredients' => 'required|string',
            'steps' => 'required|string',
            'image' => 'nullable|image|max:2048',
            ],[
                'video.regex' => 'Link harus berasal dari YouTube.'
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

        return redirect()->route('dashboard.resep')->with('success', 'Resep berhasil diperbarui!');
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

        return view('dashboard.resep.show', compact('resep'));
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
        return view('landing.home', compact('rekomendasiResep'));
    }

    protected function getYoutubeIdFromUrl(?string $link)
    {
        if (!$link) {
            return null;
        }

        preg_match(
            '/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
            $link,
            $matches
        );

        return $matches[1] ?? null;
    }
}