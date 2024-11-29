<?php

namespace App\Http\Requests;

// use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use League\CommonMark\Node\Inline\Newline;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required'
        ];
    }
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator){
        throw new ValidationException($validator);
    }

    public function attributes(){
        return [
            'name'=>'user name',
            'email'=>'user email',
            'password'=>'user password'
        ];
    }
    public function messages(){
        return [
            'required'=>'The :attribute field is required',
            'unique'=>'The :attribute field value must be a unique'
        ];
    }
}
