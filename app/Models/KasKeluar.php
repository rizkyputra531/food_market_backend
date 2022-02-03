<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KasKeluar extends Model
{
    use HasFactory;
    public $table = "kaskeluar";

    protected $fillable = [
        'name', 'jenis_pengeluaran', 'supplier', 'tanggal', 'quantity', 'harga', 'total', 
    ];

    // public function food()
    // {
    //     return $this->hasOne(Food::class, 'id', 'food_id');
    // }

    // public function user()
    // {
    //     return $this->hasOne(User::class, 'id', 'user_id');
    // }
}
