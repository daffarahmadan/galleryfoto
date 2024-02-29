<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'judul_album',
        'deskripsi',
        'foto',
        'status',
    ];

    // Relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
