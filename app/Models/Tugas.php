<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kelas',
        'mapel',
        'judul',
        'file',
        'nama_asli',
    ];
}
