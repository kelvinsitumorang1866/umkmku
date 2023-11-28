<?php

namespace App\Models;

use App\Models\produk;
use App\Models\umkmModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaction extends Model
{
    use HasFactory;
    protected $guarded =['id'];
   
    public function produk(){
        return $this->belongsTo(produk::class, 'Produk_id');
        
    }
    public function umkm(){
        return $this->belongsTo(umkmModel::class, 'Umkm_id');
        
    }
}
