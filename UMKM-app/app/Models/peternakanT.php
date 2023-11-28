<?php

namespace App\Models;

use App\Models\hewan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class peternakanT extends Model
{
    use HasFactory;
    protected $guarded =['id'];
   
    public function produk(){
        return $this->belongsTo(hewan::class, 'Produk_id');
        
    }
    public function umkm(){
        return $this->belongsTo(umkmModel::class, 'Umkm_id');
        
    }
}
