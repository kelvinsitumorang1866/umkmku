<?php

namespace App\Models;

use App\Models\produkPertanian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pertanianT extends Model
{
    use HasFactory;
    protected $guarded =['id'];
   
    public function produk(){
        return $this->belongsTo(produkPertanian::class, 'Produk_id');
        
    }
    public function umkm(){
        return $this->belongsTo(umkmModel::class, 'Umkm_id');
        
    }
}
