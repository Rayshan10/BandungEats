<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index()
    {
        // Ambil semua resep yang di-bookmark oleh user yang sedang login
        $bookmarkedReseps = auth()->user()->bookmarks;
        return view('bookmarks.index', compact('bookmarkedReseps'));
    }

    public function store(Request $request, $id)
    {
        auth()->user()->bookmarks()->attach($id);
        return back()->with('success', 'Resep berhasil ditambahkan ke favorit');
    }

    public function destroy($id)
    {
        auth()->user()->bookmarks()->detach($id);
        return back()->with('success', 'Resep dihapus dari favorit');
    }
}