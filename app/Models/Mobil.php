<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    // Tambahkan atribut yang diperbolehkan untuk mass assignment
    protected $fillable = [
        'nama_mobil',
        'merek',
        'tahun',
        'harga',
        'gambar',
    ];
}