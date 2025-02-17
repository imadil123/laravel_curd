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
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'age.required' => 'Age is required.',
            'age.numeric' => 'Age must be a number.',
            'age.min' => 'Age must be at least 18.',
            'gender.required' => 'Gender is required.',
            'city.required' => 'City is required.',
            'image.required' => 'Image is required.',
            'image.image' => 'Please upload a valid image.',
            'image.mimes' => 'Allowed image formats are jpeg, png, jpg, gif, and svg.',
            'image.max' => 'The image size must not exceed 3MB.',
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
