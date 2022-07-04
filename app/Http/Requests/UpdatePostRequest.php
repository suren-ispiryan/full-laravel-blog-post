<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'postHeading' => 'required|min:3|max:15',
            'postContent' => 'required|min:5|max:500'
        ];
    }

    public function messages()
    {
        return [
            'postHeading.required' => 'heading is required',
            'postHeading.min' => 'heading must be minimum 3 symbol',
            'postHeading.max' => 'heading must be maximum 15 symbol',
            'postContent.required' => 'content is required',
            'postContent.min' => 'content must be minimum 5 symbol',
            'postContent.max' => 'content must be maximum 500 symbol',
        ];
    }
}
