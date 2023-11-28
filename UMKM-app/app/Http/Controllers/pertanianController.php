<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\umkmModel;
use App\Models\gagalPanen;
use App\Models\pertanianT;
use App\Models\suksesPanen;
use Illuminate\Http\Request;
use App\Models\produkPertanian;
use App\Models\transaction;
use Illuminate\Support\Facades\DB;

class pertanianController extends Controller
{
    public function index(Request $request){
        $id = $request->route('id');
        $url= "/manageUmkm/Pertanian/";
        $produk =""  ;

        if ($request->has('productName')) {
            $productName = $request->productName;
    
            $gagals = gagalPanen::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('Nama_produk', 'like', "%$productName%");
                })
                ->paginate(10);
            $suksess = suksesPanen::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('Nama_produk', 'like', "%$productName%");
                })
                ->paginate(10);
            $sales = pertanianT::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('Nama_produk', 'like', "%$productName%");
                })
                ->paginate(10);
        } else{
            if (request('week')) {
                $weekNumber = $request->week;
               
        
                // Fetch sales data with the associated product for the specified week
                $gagals = gagalPanen::with('produk')
                    ->where('Umkm_id', $id)
                    ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                    ->paginate(10);
            }else{
                $gagals = gagalPanen::where('Umkm_id', $id)->paginate(10);
    
            } if (request('weekS')) {
                $weekNumber = $request->weekS;
                
               
        
                // Fetch sales data with the associated product for the specified week
                $suksess = suksesPanen::with('produk')
                    ->where('Umkm_id', $id)
                    ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                    ->paginate(10);
            }else{
                $suksess = suksesPanen::where('Umkm_id', $id)->paginate(10);
            }   if(request('weekJ')){
                $weekNumber = $request->weekJ;
                
                // Fetch sales data with the associated product for the specified week
                $sales = pertanianT::with('produk')
                    ->where('Umkm_id', $id)
                    ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                    ->paginate(10);
    
            } else{
                $sales = pertanianT::where('Umkm_id', $id)->paginate(10);
    
            }

            
        }
       
     
        $produks = produkPertanian::where('Umkm_id', $id)->get();
       
        //start gagal data
        
        $GagalForChartMonth = gagalPanen::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();
        $GagalForChart = gagalPanen::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $GagalForDonut = GagalPanen::with('produk')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                'keterangan',
                DB::raw('COUNT(*) as total')
            )
            ->where('Umkm_id', $id)
            ->groupBy('year', 'month', 'keterangan')
            ->get();
        $uniqueYearsCount = $GagalForChart->groupBy('year');
        //end gagal data
        //start sukses data
        
        
        $suksesForChart = suksesPanen::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $suksesForChartMonth = suksesPanen::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();





        //end sukses data
        // sales start
      
        $salesForChart = pertanianT::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(Ammount) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        
        //sales end
        return view("umkmManage.pertanian",compact('id','produks','gagals','suksess','sales','uniqueYearsCount','GagalForChart','GagalForDonut','GagalForChartMonth',
        'suksesForChart','salesForChart','suksesForChartMonth','url','produk'));
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

    public function addProduct (Request $request, umkmModel $id ){
        $validated = $request->validate([
            'Nama_produk' => 'required',
            'harga' => 'required'
            
        ]);

        $validated['Umkm_id'] = $id->id;
        produkPertanian::create($validated);
        
        return redirect()->back()->with('success', 'succsess add');


    }
    public function addGagal(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_gagal' => 'required',
            'keterangan'=>'required' 
        ]);
        $validated['Umkm_id'] = $id->id;

        
        gagalPanen::create($validated);
        return redirect()->back()->with('success', 'succsess add');



    }
    public function addSukses(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_sukses' => 'required',
             
        ]);
        $validated['Umkm_id'] = $id->id;

        
        suksesPanen::create($validated);
        return redirect()->back()->with('success', 'succsess add');



    }
    public function addSale(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah' => 'required',
            'ammount'=>'required' 
        ]);

        $validated['Umkm_id'] = $id->id;
        pertanianT::create($validated);
        return redirect()->back()->with('success', 'succsess add');



    }
    public function editProduct(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Nama_produk' => 'required',
            'harga' => 'required',
           
        ]); 
        $produk = $request->produk;
        produkPertanian::where('id', $produk) // Assuming $id is the ID of the record you want to update
        ->update($validated);
        return redirect()->back()->with('success', 'succsess Update');

    }
    public function deleteProduct(produkPertanian $produk){
        
        $produk->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteGagal(gagalPanen $gagal){
        
        $gagal->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteSukses(suksesPanen $sukses){
        
        $sukses->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteSale(pertanianT $sale){
        
        $sale->delete();
        return redirect()->back()->with('success', 'Deleted');

    }

}
