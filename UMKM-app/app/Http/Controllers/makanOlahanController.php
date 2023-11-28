<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\produk;
use App\Models\umkmModel;
use App\Models\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class makanOlahanController extends Controller
{
    public function index(Request $request){
        $id = $request->route('id');
        $url = "/manageUmkm/MakananOlahan/";
        $produk =""  ;
        $produks = Produk::where('Umkm_id', $id)->get();
        
        if (request('week')) {
            $weekNumber = $request->week;
           
    
            // Fetch sales data with the associated product for the specified week
            $sales = Transaction::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);
        } else {
            // If "search" parameter is not provided, fetch sales data without filtering
            $sales = Transaction::with('produk')
                ->where('Umkm_id', $id)
                ->paginate(10);
        }
        $salesForChart = Transaction::with('produk')
                ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(ammount) as total'))
                ->where('Umkm_id', $id)
                ->groupBy('year', 'month')
                ->get();
        $uniqueYearsCount = $salesForChart->groupBy('year');
        return view('umkmManage.makanan', compact('id', 'produks', 'sales','salesForChart','uniqueYearsCount','url','produk'));
        
    }
    private function getWeekDateRange($weekNumber)
    {
        $searchDate = Carbon::now()->startOfMonth();

        if ($weekNumber > 1) {
            // Move to the start of the next week
            $searchDate->addWeeks($weekNumber - 1);
        }

        // Calculate the start and end dates for the specified week
        $startDate = $searchDate->copy()->startOfWeek();
        $endDate = $searchDate->copy()->endOfWeek();

        return [$startDate, $endDate];
    }
    public function addProduct(Request $request, umkmModel $id){
        
        $validated = $request->validate([
            'Nama_produk' => 'required',
            'harga' => 'required',
            'kode_barang'=>'required' 
        ]);

        $validated['Umkm_id'] = $id->id;
        produk::create($validated);
        
        return redirect()->back()->with('message', 'succsess add');


        
        
    }
    public function addSale(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah' => 'required',
            'ammount'=>'required' 
        ]);

        $validated['Umkm_id'] = $id->id;
        transaction::create($validated);
        return redirect()->back()->with('message', 'succsess add');



    }
    public function editProduct(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Nama_produk' => 'required',
            'harga' => 'required',
            'kode_barang'=>'required' 
        ]); 
        $produk = $request->produk;
        Produk::where('id', $produk) // Assuming $id is the ID of the record you want to update
        ->update($validated);
        return redirect()->back()->with('message', 'succsess Update');

    }
}
