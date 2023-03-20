<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKabkotRequest extends FormRequest
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
            'provinsi_id' => 'required|exists:App\Models\Province,id',
			'kabupaten_kota' => 'required|string|min:1|max:100',
			'ibukota' => 'required|string|min:1|max:100',
			'k_bsni' => 'required|string|min:1|max:3',
        ];
    }
}
