<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Http\Controllers\BookmarkController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo', // Tambahkan di sini, hapus deklarasi duplikat
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->profile_photo
            ? asset('storage/' . $this->profile_photo)
            : asset('assets/img/default-profile.png');
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Resep::class, 'bookmarks', 'user_id', 'recipe_id')->withTimestamps();
    }
}