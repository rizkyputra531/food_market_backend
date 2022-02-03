<?php

namespace App\Http\Controllers;
use App\Models\Transaction;
use App\Exports\KasMasukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;


class KasMasukController extends Controller
{
    public function excel(Request $request)
    {
        return (new KasMasukExport)->download("KasMasuk-".date("d-m-Y").".xlsx");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Transaction::query();
        $query->when($request->get("name",false), function ($q, $name) { 
            return $q->where('user.name', 'like',"%{$name}%");
        });
        $query->when($request->get("type",false), function ($q, $type) { 
            return $q->where('status',$type);
        });
        $kasmasuk = $query->with(['food','user'])->paginate(10);
        return view('kasmasuk.index',compact("kasmasuk"));
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
