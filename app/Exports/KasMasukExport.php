<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;

class KasMasukExport implements FromView
{
    use Exportable;
    public function view():View
    {
        $query = Transaction::query();
        $query->join('food', 'transactions.food_id', '=', 'food.id')
              ->join('users', 'transactions.user_id', '=', 'users.id')
              ->orderBy("transactions.total_laba","desc")
              ->select(['transactions.id','food.name','users.email','quantity','food_price','total_modal','total_laba','total','status']);
        $kasmasuk = $query->get();
        return view("exports.kasmasuk",compact("kasmasuk"));
    }
}
