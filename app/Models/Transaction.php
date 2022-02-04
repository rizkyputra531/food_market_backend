<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'food_id', 'user_id', 'quantity', 'total', 'status', 'payment_url', 'food_price', 'food_modal', 'food_laba',
        'total_modal', 'total_laba',
    ];

    public function food()
    {
        return $this->hasOne(Food::class, 'id', 'food_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    // public function harga()
    // {
    // return $this->hasOne(Food::class, 'price', 'food_price');
    // }

    // public function modal()
    // {
    // return $this->hasOne(Food::class, 'modal', 'food_modal');
    // }

    // public function laba()
    // {
    // return $this->hasOne(Food::class, 'laba', 'food_laba');
    // }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)
            ->getPreciseTimestamp(3);
    }

    public function getUpdateAtAttribute($value)
    {
        return Carbon::parse($value)
            ->getPreciseTimestamp(3);
    }

}
