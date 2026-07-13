<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Resep;
use App\Models\Bookmark;

class DashboardController extends Controller
{
    public function index()
    {
        $totalResep = Resep::count();
        $totalUser = User::count();
        $totalBookmark = Bookmark::count();

        $totalKategori = Resep::distinct('kategori')->count('kategori');

        $latestRecipes = Resep::latest()->take(5)->get();

        $kategori = Resep::selectRaw('kategori, COUNT(*) as total')
        ->groupBy('kategori')
        ->get();

        return view('dashboard.dashboard', compact(
            'totalResep',
            'totalUser',
            'totalBookmark',
            'totalKategori',
            'latestRecipes',
            'kategori'
        ));
    }
}