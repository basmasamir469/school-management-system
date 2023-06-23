<?php

namespace App\Http\Requests\Promotions;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
            'from_class_id'=>'required',
            'from_grade_id'=>'required',
            'from_section_id'=>'required',
            'to_class_id'=>'required',
            'to_grade_id'=>'required',
            'to_section_id'=>'required',
            'from_academic_year'=>'required',
            'to_academic_year'=>'required'

        ];
    }
}
