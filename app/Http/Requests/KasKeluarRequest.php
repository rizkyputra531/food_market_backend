<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KasKeluarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|max:255',
            'jenis_pengeluaran' => 'required|max:255',
            'supplier' => 'required|max:255',
            'tanggal' => 'required',
            'quantity' => 'required|integer',
            'harga' => 'required|integer',
            'total' => 'integer',
        ];
    }
}
