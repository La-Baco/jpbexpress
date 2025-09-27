<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengirimans';
    protected $fillable = ['tanggal_keberangkatan', 'tanggal_distribusi', 'status'];
    protected $casts = [
        'tanggal_keberangkatan' => 'date',
        'tanggal_distribusi' => 'date',
    ];
    public function barangs()
    {
        return $this->hasMany(Barang::class, 'pengiriman_id');
    }

    }
