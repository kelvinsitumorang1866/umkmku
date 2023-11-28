<?php

namespace App\Models;

use App\Models\produkPertanian;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gagalPanen extends Model
{
    use HasFactory;
    protected $guarded =['id'];
   
    public function produk(){
        return $this->belongsTo(produkPertanian::class, 'Produk_id');
        
    }

}
