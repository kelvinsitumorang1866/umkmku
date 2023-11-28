<?php

namespace App\Http\Controllers;

use App\Models\hewan;
use App\Models\produk;
use App\Models\produkPertanian;
use App\Models\umkmModel;

use Illuminate\Http\Request;

class indexController extends Controller
{
    public function index(){
        $maknan = umkmModel::where('jenis','Makanan Olahan')->count();
        $Peternakan = umkmModel::where('jenis','Peternakan')->count();
        $Pertanian = umkmModel::where('jenis','Pertanian')->count();
        $produkMakan = produk::all()->count();
        $produkPertanian = produkPertanian::all()->count();
        $hewan = hewan::all()->count();
        $umkms = umkmModel::all();
        


        
       
        return view('admin.index',compact('maknan','Peternakan','Pertanian',
        'produkMakan','produkPertanian','hewan','umkms'));
    }
}
