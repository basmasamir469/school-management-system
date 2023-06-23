<?php

namespace App\Http\Requests\Graduated;

use Illuminate\Foundation\Http\FormRequest;

class StoreGraduatedRequest extends FormRequest
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
            'class_id'=>'required',
            'grade_id'=>'required',
            'section_id'=>'required',
        ];
    }
}
