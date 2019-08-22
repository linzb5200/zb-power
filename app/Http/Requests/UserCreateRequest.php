<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|unique:users|email',
            'mobile'   => 'required|numeric|regex:/^1[3456789][0-9]{9}$/|unique:users,mobile',
            'name'  => 'required|min:4|max:14|unique:users,mobile',
            'password'  => 'required|confirmed|min:6|max:14'
        ];
    }
}
