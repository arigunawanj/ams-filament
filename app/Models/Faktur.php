<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faktur extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function penjualan()
    {
        return $this->hasMany(Penjualan::class);
    }

    public function detail_faktur()
    {
        return $this->hasMany(DetailFaktur::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
