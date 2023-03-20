<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaskeRequest extends FormRequest
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
            'nama_faskes' => 'required|string|min:1|max:200',
			'jenis_faskes_id' => 'required|exists:App\Models\JenisFaske,id',
			'provinsi_id' => 'required|exists:App\Models\Province,id',
			'kabkot_id' => 'required|exists:App\Models\Kabkot,id',
			'kecamatan_id' => 'required|exists:App\Models\Kecamatan,id',
			'kelurahan_id' => 'required|exists:App\Models\Kelurahan,id',
			'alamat' => 'required|string',
        ];
    }
}
