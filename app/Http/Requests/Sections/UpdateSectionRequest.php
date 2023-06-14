<?php

namespace App\Http\Requests\Sections;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSectionRequest extends FormRequest
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
            'section_name_ar'=>'required|unique:sections,section_name->ar,'.$this->id,
            'section_name_en'=>'required|unique:sections,section_name->en,'.$this->id,
            'grade_id'=>'required',
            'gradeClass_id'=>'required',
            'teachers'=>'required'
        ];
    }
}
