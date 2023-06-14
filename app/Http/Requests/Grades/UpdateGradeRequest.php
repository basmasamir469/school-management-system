<?php

namespace App\Http\Requests\Grades;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGradeRequest extends FormRequest
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
            'name_ar'=>'required|unique:grades,name->ar,'.$this->id,
            'name_en'=>'required|unique:grades,name->en,'.$this->id
        ];
    }
}
