<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\hewan;
use App\Models\umkmModel;
use Illuminate\Http\Request;
use App\Models\gagalHewanBiasa;
use App\Models\gagalPanenTelur;
use App\Models\peternakanT;
use App\Models\suksesHewanBiasa;
use App\Models\suksesPanen;
use App\Models\suksesPanenTelur;
use Psy\Command\WhereamiCommand;
use Illuminate\Support\Facades\DB;

class peternakanController extends Controller
{
    public function index(Request $request){
        $id = $request->route('id');
        $url = "/manageUmkm/Peternakan/";

        if ($request->has('productName')) {
            $productName = $request->productName;
    
            $gagals = gagalHewanBiasa::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('nama', 'like', "%$productName%");
                })
                ->paginate(10);
            $suksess = suksesHewanBiasa::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('nama', 'like', "%$productName%");
                })
                ->paginate(10);
            $gagalT = gagalPanenTelur::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('nama', 'like', "%$productName%");
                })
                ->paginate(10);
            $suksessT = gagalPanenTelur::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('nama', 'like', "%$productName%");
                })
                ->paginate(10);
            $sales = gagalPanenTelur::with('produk')
                ->where('Umkm_id', $id)
                ->whereHas('produk', function ($query) use ($productName) {
                    $query->where('nama', 'like', "%$productName%");
                })
                ->paginate(10);
        }else{

        //gagal Start
        if (request('week')) {
            $weekNumber = $request->week;
            // Fetch sales data with the associated product for the specified week
            $gagals = gagalHewanBiasa::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);
        
           
        }else{
            $gagals = gagalHewanBiasa::where('Umkm_id', $id)->paginate(10);
        } 
        if (request('weekS')) {
            $weekNumber = $request->weekS;
            // Fetch sales data with the associated product for the specified week
            $suksess = suksesHewanBiasa::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);
        }else{
            $suksess = suksesHewanBiasa::where('Umkm_id', $id)->paginate(10);
        } if (request('weekJ')) {
            $weekNumber = $request->weekJ;
            // Fetch sales data with the associated product for the specified week
            $gagalT = gagalPanenTelur::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);
        }else{
            $gagalT = gagalPanenTelur::where('Umkm_id', $id)->paginate(10);
        } if (request('weekK')) {
            $weekNumber = $request->weekK;
            // Fetch sales data with the associated product for the specified week
            $suksessT = suksesPanenTelur::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);
        }else{
            $suksessT = suksesPanenTelur::where('Umkm_id', $id)->paginate(10);
        }if(request('weekZ')){
            $weekNumber = $request->weekZ;
            
            // Fetch sales data with the associated product for the specified week
            $sales = peternakanT::with('produk')
                ->where('Umkm_id', $id)
                ->whereBetween('created_at', $this->getWeekDateRange($weekNumber))
                ->paginate(10);

        } else{
            $sales = peternakanT::where('Umkm_id', $id)->paginate(10);

        }
    }
        $GagalForChart = gagalHewanBiasa::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $GagalForChartMonth = gagalHewanBiasa::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();
        $GagalForDonut = gagalHewanBiasa::with('produk')
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
        //salebiasa
       
        $SuksesForChart = suksesHewanBiasa::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $SuksesForChartMonth = suksesHewanBiasa::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();
        //gagalTelur
        
        $GagalTForChart = gagalPanenTelur::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $GagalTForChartMonth = gagalPanenTelur::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_gagal) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();
        //sukses telur
       
        $SuksesTForChart = suksesPanenTelur::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        $SuksesTForChartMonth = suksesPanenTelur::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, SUM(jumlah_sukses) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year')
        ->get();
        //sales
        // sales start
        
        $salesForChart = peternakanT::with('produk')
        ->select(DB::raw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(Ammount) as total'))
        ->where('Umkm_id', $id)
        ->groupBy('year', 'month')
        ->get();
        
        //sales end
    

        $produks = hewan::where('Umkm_id', $id)->paginate(10);
        
        return view('umkmManage.peternakan',compact('produks','id','gagals','GagalForChart','GagalForChartMonth'
        ,'uniqueYearsCount','GagalForDonut','suksess','SuksesForChart','SuksesForChartMonth',
        'gagalT','GagalTForChart','GagalTForChartMonth','SuksesTForChartMonth','SuksesTForChart','suksessT'
        , 'sales','salesForChart','url'));

    }
    public function addProduct(Request $request, umkmModel $id){
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'group' => 'required'

        ]);
        $validated['Umkm_id'] = $id->id;
        hewan::create($validated);
        return redirect()->back()->with('success', 'succsess add');

    }
    public function addGagal(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_gagal' => 'required',
            'keterangan'=>'required' 
        ]);
        $validated['Umkm_id'] = $id->id;
        gagalHewanBiasa::create($validated);
        return redirect()->back()->with('success', 'succsess add');

    }
    private function getWeekDateRange($weekNumber)
    {
        $searchDate = Carbon::now()->startOfMonth();
        
        
        
        if($weekNumber > 1){
            $searchDate->addWeeks($weekNumber - 1);
            

        }


        

        // Calculate the start and end dates for the specified week
        $startDate = $searchDate->copy()->startOfWeek();
        $endDate = $searchDate->copy()->endOfWeek();
       
        

        return [$startDate, $endDate];
    }
    public function addSukses(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_sukses' => 'required',
             
        ]);
        $validated['Umkm_id'] = $id->id;

        
        suksesHewanBiasa::create($validated);
        return redirect()->back()->with('success', 'succsess add');

    }
    public function addGagalT(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_gagal' => 'required',
        ]);
        $validated['Umkm_id'] = $id->id;
        gagalPanenTelur::create($validated);
        return redirect()->back()->with('success', 'succsess add');

    }
    public function addSuksesT(Request $request, umkmModel $id){
        
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah_sukses' => 'required',
             
        ]);
        $validated['Umkm_id'] = $id->id;

        
        suksesPanenTelur::create($validated);
        return redirect()->back()->with('success', 'succsess add');

    }
    public function addSale(Request $request, umkmModel $id){
        $validated = $request->validate([
            'Produk_id' => 'required',
            'jumlah' => 'required',
            'ammount'=>'required' 
        ]);

        $validated['Umkm_id'] = $id->id;
        peternakanT::create($validated);
        return redirect()->back()->with('success', 'succsess add');



    }
    public function editProduct(Request $request, umkmModel $id){
        $validated = $request->validate([
            'nama' => 'required',
            'harga' => 'required',
            'group' => 'required'
           
        ]); 
        $produk = $request->produk;
        hewan::where('id', $produk) // Assuming $id is the ID of the record you want to update
        ->update($validated);
        return redirect()->back()->with('success', 'succsess Update');

    }
    public function deleteProduct(hewan $produk){
        
        $produk->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteGagal(gagalHewanBiasa $gagal){
        
        $gagal->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteSukses(suksesHewanBiasa $sukses){
        
        $sukses->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteGagalT(gagalPanenTelur $gagalT){
        
        $gagalT->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteSuksesT(suksesPanenTelur $suksesT){
        
        $suksesT->delete();
        return redirect()->back()->with('success', 'Deleted');

    }
    public function deleteSale(peternakanT $sale){
        
        $sale->delete();
        return redirect()->back()->with('success', 'Deleted');

    }

}
