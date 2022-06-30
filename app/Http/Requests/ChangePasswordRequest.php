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
            'oldPassword' => 'required|min:5|max:10',
            'password' => 'required|min:5|max:10'
        ];
    }

    public function messages()
    {
        return [
            'oldPassword.required' => 'old password is required',
            'oldPassword.min' => 'old password must be minimum 5 symbol',
            'oldPassword.max' => 'old password must be maximum 10 symbol',
            'password.required' => 'new password is required',
            'password.min' => 'new password must be minimum 5 symbol',
            'password.max' => 'new password must be maximum 10 symbol'
        ];
    }
}
