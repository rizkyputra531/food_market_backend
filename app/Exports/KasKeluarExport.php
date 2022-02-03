<?php

namespace App\Exports;

use App\Models\KasKeluar;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;

class KasKeluarExport implements FromView
{
    use Exportable;

    public function forType(String $type)
    {
        $this->type = $type;   
        return $this;
    }

    /**
    * @return \Illuminate\Support\view
    */
    public function view() :View
    {
        $query = KasKeluar::query()->select(['id','name','jenis_pengeluaran','supplier','tanggal','quantity','harga','total']);
        if (empty($this->type)) {
            $kaskeluar = $query->get();
            return view("exports.kaskeluar",compact("kaskeluar"));
        }
        $query->when($this->type,function($q,$type)
        {
            return $q->where("jenis_pengeluaran",$this->type);
        });
        $kaskeluar = $query->get();
        return view("exports.kaskeluar",compact("kaskeluar"));
    }
}
