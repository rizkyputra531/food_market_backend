<?php

namespace App\Http\Controllers\API;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
    public function all(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit');
        $food_id = $request->input('food_id');
        $status = $request->input('status');
        // $food_modal = $request->input('food_modal');
        // $food_laba = $request->input('food_laba');
        // $total_modal = $request->input('total_modal');
        // $total_laba = $request->input('total_labaa');



        if ($id) {
            $transaction = Transaction::with(['food', 'user'])->find($id);

            if ($transaction) {
                return ResponseFormatter::success(
                    $transaction,
                    'Data produk berhasil diambil'
                );
            } else {
                return ResponseFormatter::error(
                    null,
                    'Data produk tidak ada',
                    404
                );
            }
        }
        $transaction = Transaction::with(['food', 'user'])
            ->where('user_id', Auth::user()->id);

        if ($food_id) {
            $transaction->where('food_id', $food_id);
        }

        if ($status) {
            $transaction->where('status', $status);
        }

        return ResponseFormatter::success(
            $transaction->paginate($limit),
            'Data list transaksi berhasil diambil'
        );
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $transaction->update($request->all());

        return ResponseFormatter::success($transaction, 'Transaksi berhasil diperbarui');
    }


    public function checkout(Request $request)
    {
        $request->validate([
            'food_id' => 'required|exists:food,id',
            // 'food_price' => 'required|exists:food,price',
            // 'food_modal' => 'required|exists:food,modal',
            // 'food_laba' => 'required|exists:food,laba',
            'user_id' => 'required|exists:users,id',
            'quantity' => 'required',
            'total' => 'required',
            'status' => 'required'
        ]);

        $transaction = Transaction::create([
            'food_id' => $request->food_id,
            'food_price' => $request->food_price,
            'food_modal' => $request->food_modal,
            'food_laba' => $request->food_laba,
            'total_modal' => $request->total_modal,
            'total_laba' => $request->total_laba,

            'user_id' => $request->user_id,
            'quantity' => $request->quantity,
            $a = $request->food_modal,
            $b = $request->food_laba,
            $c = $request->quantity,


            'total_modal' => $a * $c,
            'total_laba' => $b * $c,
            'total' => $request->total,
            'status' => $request->status,
            'payment_url' => '',
        ]);

        //konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');

        //panggil transaksi yg tdi dibuat
        $transaction = Transaction::with(['food', 'user'])->find($transaction->id);

        //membuat transaksi midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $transaction->id,
                'gross_amount' => (int) $transaction->total,
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email,
            ],
            'enabled_payments' => ['gopay', 'bank_transfer'],
            'vtweb' => []
        ];

        //memanggil midtrans
        try {
            //ambil halaman payment midtrans
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            $transaction->payment_url = $paymentUrl;
            $transaction->save();

            //mengembalikan data ke API
            return ResponseFormatter::success($transaction, 'Transaksi berhasil');
        } catch (Exception $e) {
            return ResponseFormatter::error($e->getMessage(), 'Transaksi Gagal');
        }
    }

}