<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $fillable = [
        'mobil_id',
        'merek',
        'tahun',
        'harga',
        'tanggal_terjual',
    ];
}
