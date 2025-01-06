<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{

    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'harga_produk', 'harga_diskon', 'qty_produk', 'deskripsi', 'best_seller', 'foto1', 'foto2', 'foto3', 'foto4', 'foto5'];
}
