<?php

namespace App\Http\Requests\GradeClasses;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
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

    public function validator($factory)
    {
    return $factory->make(
        $this->sanitize(), $this->container->call([$this, 'rules']), $this->messages()
    );
    }


    public function sanitize()
    {
        $this->merge([
            'data' => json_decode($this->data, true)
        ]);
        return $this->all();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.classes_list.*.class_name_ar'=>'required|unique:grade_classes,class_name->ar',
            'data.classes_list.*.class_name_en'=>'required|unique:grade_classes,class_name->en',
            'data.classes_list.*.grade_id'=>'required'
        ];
    }
}
