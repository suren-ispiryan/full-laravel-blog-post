<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'password' => 'required|min:5|max:10'
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'password is required',
            'password.min' => 'password must be minimum 5 symbol',
            'password.max' => 'password must be maximum 10 symbol'
        ];
    }
}
