<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'name.ar'=>'required|unique:teachers,name->ar',
            'name.en'=>'required|unique:teachers,name->en',
            'email'=>'required|email|unique:teachers,email',
            'address'=>'required',
            'specialization_id'=>'required',
            'gender_id'=>'required',
            'password'=>'required|min:6',
            'joining_date'=>'required|after_or_equal:today'
        ];
    }
}
