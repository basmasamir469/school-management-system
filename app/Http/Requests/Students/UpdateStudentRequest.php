<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'student_name_ar'=>'required|unique:students,student_name->ar,'.$this->id,
            'student_name_en'=>'required|unique:students,student_name->en,'.$this->id,
            'email'=>'required|email|unique:students,email,'.$this->id,
            'grade_id'=>'required',
            'gender_id'=>'required',
            'nationality_id'=>'required',
            'blood_type_id'=>'required',
            'parent_id'=>'required',
            'birth_date'=>'required',
            'academic_year'=>'required',
            'grade_class_id'=>'required',
            'section_id'=>'required'
        ];
    }
}
