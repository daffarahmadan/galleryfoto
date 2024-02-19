<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'foto';
    protected $guarded = ['id'];
    protected $fillable = ['judul', 'deskripsi', 'tanggalunggah', 'lokasifile', 'albumid', 'userid'];


    public function album()
    {
        return $this->belongsTo(Album::class, 'albumid'); // Sesuaikan nama kolom yang digunakan untuk mengaitkan foto dengan album
    }

    public function likeFoto()
    {
        return $this->hasMany(LikeFoto::class, 'fotoid');
    }

    public function likeCount()
    {
        return $this->likefoto()->count();
    }

    public function komentarfoto()
    {
        return $this->hasMany(Komentarfoto::class, 'fotoid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

}
