<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePosterRequest extends FormRequest
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
        $posterId = $this->route('poster');
        return [
            'title'         => [
                'required',
                Rule::unique('posters')->ignore($posterId)
            ],
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:500000000',
            'deskripsi'   => 'nullable|min:10',
        ];
    }
}
