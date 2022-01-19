<?php

namespace App\Http\Controllers;
use App\Models\Transaction;

use Illuminate\Http\Request;


class KasMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kasmasuk = Transaction::with(['food','user'])->paginate(10);
        $total = Transaction::sum('total');
        $total_modal = Transaction::sum('total_modal');
        $total_laba = Transaction::sum('total_laba');
        $quantity = Transaction::sum('quantity');
        

        // dd($total);

        return view('kasmasuk.index', [
        'kasmasuk' => $kasmasuk,
        'total' => $total,
        'total_modal' => $total_modal,
        'total_laba' => $total_laba,
        'quantity' => $quantity,
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
    public function show(Transaction $kasmasuk)
    {
        //
        return view('kasmasuk.detail',[
        'item' => $kasmasuk
        ]);
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
