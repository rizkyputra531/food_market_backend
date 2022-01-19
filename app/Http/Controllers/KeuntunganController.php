<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\Transaction;
use Illuminate\Http\Request;

class KeuntunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $keuntungan = Transaction::with(['food','user'])->paginate(10);
        $total = Transaction::sum('total');
        $total_modal = Transaction::sum('total_modal');
        $total_laba = Transaction::sum('total_laba');
        $quantity = Transaction::sum('quantity');

        $jumlah_pembelian = KasKeluar::sum('quantity');
        $total_pengeluaran = KasKeluar::sum('total');

        $laba_bersih = $total_laba - $total_pengeluaran;

        // dd($total);

        return view('keuntungan.index', [
        'keuntungan' => $keuntungan,
        'total' => $total,
        'total_modal' => $total_modal,
        'total_laba' => $total_laba,
        'quantity' => $quantity,
        'jumlah_pembelian' => $jumlah_pembelian,
        'total_pengeluaran' => $total_pengeluaran,
        'laba_bersih' => $laba_bersih,
        ]);

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
