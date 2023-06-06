<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bank extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
    public function transaksidetail()
    {
        return $this->hasMany(TransaksiDetail::class);
    }
}
