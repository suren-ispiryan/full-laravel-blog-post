<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required|min:2|max:18',
            'surname' => 'required|min:3|max:18',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:10'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required',
            'name.min' => 'name must be minimum 2 symbol',
            'name.max' => 'name must be maximum 18 symbol',
            'surname.required' => 'surname is required',
            'surname.min' => 'name must be minimum 3 symbol',
            'surname.max' => 'name must be maximum 18 symbol',
            'email.required' => 'email is required',
            'email.unique:users' => 'email must be unique',
            'password.required' => 'password is required',
            'password.min' => 'name must be minimum 5 symbol',
            'password.max' => 'name must be maximum 10 symbol',
        ];
    }
}
