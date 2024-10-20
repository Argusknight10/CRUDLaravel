<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBeritaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $beritaId = $this->route('berita');
        return [
            'title'         => [
                'required',
                Rule::unique('beritas')->ignore($beritaId)
            ],
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:500000000',
            'kategori'    => 'nullable',
            'deskripsi'   => 'required|min:10',
        ];
    }
}
