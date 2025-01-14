<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $fillable = ['email', 'nama_pelanggan', 'tlp_pelanggan', 'alamat_pelanggan'];
}
