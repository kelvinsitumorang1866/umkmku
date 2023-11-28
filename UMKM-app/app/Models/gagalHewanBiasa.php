<?php

namespace App\Models;

use App\Models\hewan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class gagalHewanBiasa extends Model
{
    use HasFactory;
    protected $guarded =['id'];
   
    public function produk(){
        return $this->belongsTo(hewan::class, 'Produk_id');
    }
}
