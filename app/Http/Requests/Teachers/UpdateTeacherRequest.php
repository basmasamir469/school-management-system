<?php

namespace App\Http\Requests\Teachers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTeacherRequest extends FormRequest
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
            'name.ar'=>'required|unique:teachers,name->ar,'.$this->id,
            'name.en'=>'required|unique:teachers,name->en,'.$this->id,
            'email'=>'required|email|unique:teachers,email,'.$this->id,
            'address'=>'required',
            'specialization_id'=>'required',
            'gender_id'=>'required',
            'joining_date'=>'required|after_or_equal:today'
        ];
    }
}
