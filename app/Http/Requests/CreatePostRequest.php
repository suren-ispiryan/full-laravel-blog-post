<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
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
            'heading' => 'required|min:3|max:15',
            'content' => 'required|min:5|max:500'
        ];
    }

    public function messages()
    {
        return [
            'heading.required' => 'heading is required',
            'heading.min' => 'heading must be minimum 3 symbol',
            'heading.max' => 'heading must be maximum 15 symbol',
            'content.required' => 'content is required',
            'content.min' => 'content must be minimum 5 symbol',
            'content.max' => 'content must be maximum 500 symbol',
        ];
    }
}
