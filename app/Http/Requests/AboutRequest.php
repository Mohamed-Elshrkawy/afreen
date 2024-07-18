<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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

        return [
            'en.welcome'=>'required|string|max:20',
            'en.head'=>'required|string|max:50',
            'en.text'=>'required|string|max:100',
            'ar.welcome'=>'required|string|max:20',
            'ar.head'=>'required|string|max:50',
            'ar.text'=>'required|string|max:100',
            'l_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            's_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ];
    }
}
