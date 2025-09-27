<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'telpon', 'alamat', 'area_id'];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class, 'pelanggan_id');
    }
}
