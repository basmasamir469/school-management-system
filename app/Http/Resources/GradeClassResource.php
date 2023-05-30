<?php

namespace App\Http\Resources;

use App\Models\Grade;
use Illuminate\Http\Resources\Json\JsonResource;

class GradeClassResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $grade=Grade::find($this->grade_id);
        return [
            'id' => $this->id,
            'class_name' => $this->class_name,
            'grade_id' => $this->grade_id,
            'grade_name'=>$grade?$grade->name:'',
            'class_name_ar'=>$this->getTranslation('class_name','ar'),
            'class_name_en'=>$this->getTranslation('class_name','en'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
