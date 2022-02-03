<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use App\Models\Transaction;
use App\Models\KasKeluar;

class KeuntunganExport implements FromView
{
    // use Exportable;
    protected $bulan,$tahun;

    public function __construct($bulan = null,$tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function view():View
    {
        $query = Transaction::query();
        $query->when(!empty($this->bulan) ?? $this->bulan, function ($q, $bulan) { 
            return $q->whereMonth('created_at', $bulan);
        });
        $query->when(!empty($this->tahun) ?? $this->tahun, function ($q, $tahun) { 
            return $q->whereYear('created_at', $tahun);
        });
        $keuntungan = $query->with(['food','user'])->paginate(10);

        $total = $keuntungan->sum("total");
        $total_modal = $keuntungan->sum('total_modal');
        $total_laba = $keuntungan->sum('total_laba');
        $quantity = $keuntungan->sum('quantity');

        // kas query
        $query_kas = KasKeluar::query();
        $query_kas->when(!empty($this->bulan) ?? $this->bulan, function ($q, $bulan) { 
            return $q->whereMonth('created_at', $bulan);
        });
        $query_kas->when(!empty($this->tahun) ?? $this->tahun, function ($q, $tahun) { 
            return $q->whereYear('created_at', $tahun);
        });
        $kasKeluar = $query_kas->get();

        $jumlah_pembelian = $kasKeluar->sum('quantity');
        $total_pengeluaran = $kasKeluar->sum('total');
        $laba_bersih = $total_laba - $total_pengeluaran;

        return view('exports.keuntungan',compact("keuntungan","total","total_modal","total_laba","quantity","jumlah_pembelian","total_pengeluaran","laba_bersih"));
    }
}
