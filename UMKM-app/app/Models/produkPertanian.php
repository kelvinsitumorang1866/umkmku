<?php

namespace App\Models;

use App\Models\umkmModel;
use App\Models\gagalPanen;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class produkPertanian extends Model
{
    use HasFactory;
    protected $guarded =['id'];
    public function umkm(){
        return $this->belongsTo(umkmModel::class);
    }
    public function gagal(){
        return $this->hasMany(gagalPanen::class);
    }
}
