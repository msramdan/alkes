<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePelaksanaTeknisiRequest extends FormRequest
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
            'nama' => 'required|string|min:1|max:200',
			'jenis_kelamin' => 'required|boolean',
			'no_telpon' => 'required|string|min:1|max:15',
			'email' => 'required|string|min:1|max:200',
			'tempat_lahir' => 'required|string|min:1|max:100',
			'tangal_lahir' => 'required|date',
			'photo' => 'required|string|min:1|max:200',
			'password' => 'required|string|min:1|max:200',
        ];
    }
}
