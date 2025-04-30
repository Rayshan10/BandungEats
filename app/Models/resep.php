<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    // Pastikan nama tabel sesuai dengan yang ada di database
    protected $table = 'reseps'; // Pastikan ini sesuai dengan nama tabel yang benar

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'kategori',
        'judul',
        'gambar',
        'deskripsi',
        'link',
        'waktu',
        'kesulitan',
        'porsi',
        'bahan',
        'langkah',
    ];

    /**
     * Relasi dengan User melalui tabel bookmarks
     * Seorang resep bisa dibookmark oleh banyak user
     */
    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, 'bookmarks', 'recipe_id', 'user_id')->withTimestamps();
    }
}
