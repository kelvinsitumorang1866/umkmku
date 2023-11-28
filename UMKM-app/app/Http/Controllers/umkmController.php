<?php

namespace App\Http\Controllers;

use App\Models\umkmModel;
use Illuminate\Http\Request;

class umkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   $userID = auth()->user()->id;
        $umkmData = UmkmModel::where('User_id', $userID)->first();
        return view('UMKM.index', compact('umkmData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([

            'Nama_umkm' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'waktu_berdiri' => 'required',
            'pemilik' => 'required',
            'jenis' => 'required',
            'NIB' => 'required',
            'NPWP' => 'required',
            'Pirt' => 'required',
            'bpom' => 'required',
            'merek' => 'required',
            'halal' => 'required',
            'hak_cipta' => 'required',
            'no1' => 'required',
            'no2' => 'required',
            'email' => 'required',
            'website' => 'required',
            'ig' => 'required',
            'fb' => 'required',
            'tokped' => 'required',
            'bukalapak' => 'required',
            'shopee' => 'required',
            'Asset' => 'required',
            'omset' => 'required',
            'tenagaL' => 'required',
            'tenagaP' => 'required',
            'desa' => 'required',
            'kab' => 'required',
            'prov' => 'required',
            'nas' => 'required',
            'exp' => 'required',
            'kapasitas' => 'required',

        ]);
        $validated['User_id'] =  auth()->user()->id;
        umkmModel::create($validated);
        session()->flash('success', 'DATA BERHASIL DI TAMBAHKAN');
        return to_route('umkm.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(umkmModel $umkm)
    {
        
        $umkmData = UmkmModel::where('id', $umkm->id)->first();
        return view('UMKM.index', compact('umkmData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(umkmModel $umkmModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, umkmModel $umkm)
    {
        $validated = $request->validate([

            'Nama_umkm' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'waktu_berdiri' => 'required',
            'pemilik' => 'required',
            'jenis' => 'required',
            'NIB' => 'required',
            'NPWP' => 'required',
            'Pirt' => 'required',
            'bpom' => 'required',
            'merek' => 'required',
            'halal' => 'required',
            'hak_cipta' => 'required',
            'no1' => 'required',
            'no2' => 'required',
            'email' => 'required',
            'website' => 'required',
            'ig' => 'required',
            'fb' => 'required',
            'tokped' => 'required',
            'bukalapak' => 'required',
            'shopee' => 'required',
            'Asset' => 'required',
            'omset' => 'required',
            'tenagaL' => 'required',
            'tenagaP' => 'required',
            'desa' => 'required',
            'kab' => 'required',
            'prov' => 'required',
            'nas' => 'required',
            'exp' => 'required',
            'kapasitas' => 'required',

        ]);
      
        $umkm->update($validated);
        session()->flash('success', 'DATA BERHASIL DI UPDATE');
        return redirect()->route('umkm.index');

     
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(umkmModel $umkmModel)
    {
        //
    }
}
