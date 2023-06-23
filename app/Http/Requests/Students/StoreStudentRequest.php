<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'student_name_ar'=>'required|unique:students,student_name->ar',
            'student_name_en'=>'required|unique:students,student_name->en',
            'email'=>'required|email|unique:students,email',
            'grade_id'=>'required',
            'gender_id'=>'required',
            'nationality_id'=>'required',
            'blood_type_id'=>'required',
            'parent_id'=>'required',
            'password'=>'required|min:6',
            'birth_date'=>'required|date|date_format:Y-m-d',
            'academic_year'=>'required',
            'grade_class_id'=>'required',
            'section_id'=>'required',
            'photos'=>'nullable'
        ];
    }
}
