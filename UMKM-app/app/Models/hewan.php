<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hewan extends Model
{
    use HasFactory;
    protected $guarded =['id'];

    public function umkm(){
        return $this->belongsTo(umkmModel::class);
    }
    public function gagalHewanBiasa(){
        return $this->hasMany(gagalHewanBiasa::class);
    }
    
    
}
