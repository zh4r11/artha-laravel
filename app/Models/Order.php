<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'pelanggan_id',
        'nama',
        'telepon',
        'no_order',
        'status',
        'prov',
        'kota',
        'kecamatan',
        'kelurahan',
        'kode_pos',
        'alamat',
        'total',
        'tracking_number',
        'catatan'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'id_order', 'id');
    }
}
