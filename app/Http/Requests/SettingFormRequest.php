<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingFormRequest extends FormRequest
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
            'name' => $isRequired.'string',
			'description' => $isRequired.'string',
			'currency' => $isRequired.'string',
			'taxeRate' => $isRequired.'string',
			'imageUrl' => $isRequired.'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
			'street' => $isRequired.'string',
			'city' => $isRequired.'string',
			'state' => $isRequired.'string',
			'email' => $isRequired.'email',
			'phone' => $isRequired.'string',
			'codePostal' => $isRequired.'string',
			'copyright' => $isRequired.'string'
			
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            
        ]);
    }
}