<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventariRequest extends FormRequest
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
            'kode_inventaris' => 'required|string|min:1|max:150',
			'kode' => 'required|string|min:1|max:50',
			'tahun_pembelian' => 'required|numeric',
			'ruangan_id' => 'required|exists:App\Models\Room,id',
			'jenis_alat_id' => 'required|exists:App\Models\Type,id',
			'merk_id' => 'required|exists:App\Models\Brand,id',
			'tipe' => 'required|string|min:1|max:255',
			'serial_number' => 'required|string|min:1|max:255',
			'vendor_id' => 'required|exists:App\Models\Vendor,id',
        ];
    }
}
