<?php

namespace App\Http\Requests\GradeClasses;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClassRequest extends FormRequest
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
            'class_name_ar'=>'required|unique:grade_classes,class_name->ar,'.$this->id,
            'class_name_en'=>'required|unique:grade_classes,class_name->en,'.$this->id,
            'grade_id'=>'required'
        ];
    }
}
