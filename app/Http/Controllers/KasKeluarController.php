<?php

namespace App\Http\Controllers;

use App\Exports\KasKeluarExport;
use App\Http\Requests\KasKeluarRequest;
use App\Models\KasKeluar;
use Illuminate\Http\Request;

class KasKeluarController extends Controller
{
    public function excel(Request $request)
    {
        $type = $request->get("type1");
        if ($type) {
            return (new KasKeluarExport)->forType($type)->download('KasKeluar-'.$type."-".date("d-m-Y").".xlsx");
        }
        return (new KasKeluarExport)->download("KasKeluar-allType-".date("d-m-Y").".xlsx");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = KasKeluar::query();
        $query->when($request->get("name",false), function ($q, $name) { 
            return $q->where('name', 'like',"%{$name}%");
        });
        $query->when($request->get("type",false), function ($q, $type) { 
            return $q->where('jenis_pengeluaran',$type);
        });
        $kaskeluar = $query->paginate(10);
        return view('kaskeluar.index', compact("kaskeluar"));
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
