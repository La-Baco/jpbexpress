<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['nama_area', 'user_id'];

    public function kurir()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pelanggans()
    {
        return $this->hasMany(Pelanggan::class, 'area_id');
    }
}
