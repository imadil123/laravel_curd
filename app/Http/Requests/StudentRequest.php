<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
class StudentRequest extends FormRequest
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
    
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email has already been taken',
            'age.required' => 'Age is required',
            'age.numeric' => 'Age must be numeric',
            'age.min' => 'Age must be greater than 18',
            'city.required' => 'City is required'
        ];
    }
    protected $stopOnFirstFailure = true;

    public function prepareForValidation()
    {
        $this->merge([
            'email' => Str::lower($this->email),
            'password' => bcrypt($this->password)
        ]);
    }

}
