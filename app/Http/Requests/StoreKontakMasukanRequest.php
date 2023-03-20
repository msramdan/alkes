<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKontakMasukanRequest extends FormRequest
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
            'pelaksana_teknis_id' => 'required|exists:App\Models\PelaksanaTekni,id',
			'judul' => 'required|string|min:1|max:255',
			'deksiprsi' => 'required|string',
        ];
    }
}
