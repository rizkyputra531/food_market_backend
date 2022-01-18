<?php

namespace App\Http\Controllers;

use App\Http\Requests\KasKeluarRequest;
use App\Models\KasKeluar;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $kaskeluar = KasKeluar::paginate(10);
        $quantity = KasKeluar::sum('quantity');
        $total = KasKeluar::sum('total');

        return view('kaskeluar.index', [
        'kaskeluar' => $kaskeluar,
        'quantity' => $quantity,
        'total' => $total
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
        return view('kaskeluar.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KasKeluarRequest $request)
    {
        //
         $data = $request->all();
        //  $a = $request['price'];
        //  $b = $request['modal'];
        //  $data['laba'] = $a-$b;

         KasKeluar::create($data);

         return redirect()->route('kaskeluar.index')->with('success', 'Data Berhasil Ditambahkan!!');
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
    public function edit(KasKeluar $kaskeluar)
    {
        //
        return view('kaskeluar.edit',[
        'item' => $kaskeluar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KasKeluar $kaskeluar)
    {
        //
        $data = $request->all();

       
        $kaskeluar->update($data);

        return redirect()->route('kaskeluar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(KasKeluar $kaskeluar)
    {
        //
        $kaskeluar->delete();

        return redirect()->route('kaskeluar.index');
    }
}
