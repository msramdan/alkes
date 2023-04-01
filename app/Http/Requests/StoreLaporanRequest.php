<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaporanRequest extends FormRequest
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
            'no_laporan' => 'required|string|min:1|max:100',
			'user_created' => 'required|exists:App\Models\User,id',
			'tgl_laporan' => 'required',
			'status_laporan' => 'required|string|min:1|max:150',
			'user_review' => 'required|exists:App\Models\User,id',
			'tgl_review' => 'required',
        ];
    }
}
