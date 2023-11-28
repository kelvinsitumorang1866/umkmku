<?php

namespace App\Models;

use App\Models\produk;
use App\Models\transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class umkmModel extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function produk(){
        return $this->hasMany(produk::class);
    }
   

}
