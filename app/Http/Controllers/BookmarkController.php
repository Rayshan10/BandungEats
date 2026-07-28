<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->bookmarks();

        if ($request->filled('search')) {

            $query->where('judul', 'like', '%' . $request->search . '%');

        }

        $bookmarkedReseps = $query
            ->latest()
            ->paginate(6);

        if ($request->ajax()) {

            return view(
                'bookmarks.partials.bookmark-list',
                compact('bookmarkedReseps')
            );

        }

        return view(
            'bookmarks.index',
            compact('bookmarkedReseps')
        );
    }

    public function store(Request $request, $id)
    {
        auth()->user()->bookmarks()->syncWithoutDetaching([$id]);

        if ($request->ajax()) {

            return response()->json([
                'success' => true,
                'action'  => 'added',
                'message' => 'Resep berhasil ditambahkan ke favorit.',
                'total'   => auth()->user()->bookmarks()->count()
            ]);

        }

        return back()->with('success', 'Resep berhasil ditambahkan ke favorit');
    }

    public function destroy(Request $request, $id)
    {
        auth()->user()->bookmarks()->detach($id);

        if ($request->ajax()) {

            return response()->json([

                'success' => true,

                'message' => 'Bookmark berhasil dihapus.',

                'total' => auth()->user()->bookmarks()->count()

            ]);

        }

        return back()->with('success','Bookmark berhasil dihapus');
    }
}