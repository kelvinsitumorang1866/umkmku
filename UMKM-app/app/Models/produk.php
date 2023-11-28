<?php

namespace App\Models;

use App\Models\umkmModel;
use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produk extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function umkm(){
        return $this->belongsTo(umkmModel::class);
    }
    public function transaction(){
        return $this->hasMany(transaction::class);
    }
}
