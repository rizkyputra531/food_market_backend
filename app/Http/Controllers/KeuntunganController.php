<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Transaction;
use App\Exports\KeuntunganExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class KeuntunganController extends Controller
{
    public function excel(Request $request)
    {
        $tahun = $request->post("tahun1");
        $bulan = $request->post("bulan1");
        $nama = empty($tahun) && empty($bulan) ? "allTime.xlsx" : $tahun.'-'. $bulan .'-'.'keuntungan.xlsx';
        return Excel::download(new KeuntunganExport($bulan,$tahun), $nama);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // transaction query
        $query = Transaction::query();
        $query->when($request->get("bulan",false), function ($q, $bulan) { 
            return $q->whereMonth('created_at', $bulan);
        });
        $query->when($request->get("tahun",false), function ($q, $tahun) { 
            return $q->whereYear('created_at', $tahun);
        });
        $keuntungan = $query->with(['food','user'])->paginate(10);

        $total = $keuntungan->sum("total");
        $total_modal = $keuntungan->sum('total_modal');
        $total_laba = $keuntungan->sum('total_laba');
        $quantity = $keuntungan->sum('quantity');

        // kas query
        $query_kas = KasKeluar::query();
        $query_kas->when($request->get("bulan",false), function ($q, $bulan) { 
            return $q->whereMonth('created_at', $bulan);
        });
        $query_kas->when($request->get("tahun",false), function ($q, $tahun) { 
            return $q->whereYear('created_at', $tahun);
        });
        $kasKeluar = $query_kas->get();

        $jumlah_pembelian = $kasKeluar->sum('quantity');
        $total_pengeluaran = $kasKeluar->sum('total');
        $laba_bersih = $total_laba - $total_pengeluaran;

        $bulan = ['januari','februari','maret','april','mei','juli','juni','agustus','september','oktober','november','desember'];
        
        return view('keuntungan.index',compact("keuntungan","total","total_modal","total_laba","quantity","jumlah_pembelian","total_pengeluaran","laba_bersih","bulan"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
