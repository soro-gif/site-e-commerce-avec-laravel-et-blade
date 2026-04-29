<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageFormRequest extends FormRequest
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
        $isRequired = request()->isMethod("POST") ?"required|": "";
        return [
            //
            'title' => $isRequired.'string',
			'slug' => $isRequired.'',
			'content' => $isRequired.'string',
			'isHead' => $isRequired.'in:true,false|nullable',
			'isFoot' => $isRequired.'in:true,false|nullable'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'slug' => \Illuminate\Support\Str::slug($this->input('title')),
			'isHead' => $this->input('isHead') ? 'true' : 'false',
			'isFoot' => $this->input('isFoot') ? 'true' : 'false',
			
        ]);
    }
}