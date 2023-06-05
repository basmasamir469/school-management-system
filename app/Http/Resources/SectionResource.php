<?php

namespace App\Http\Resources;

use App\interfaces\GradeClassSectionStatus;
use App\Models\Grade;
use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $grade=Grade::where('id',$this->grade_id)->withCount('sections')->first();
        return [
            'id' => $this->id,
            'class_name' => $this->grade_class->class_name,
            'grade_id' => $this->grade_id,
            'section_name'=>$this->section_name,
            'section_name_ar'=>$this->getTranslation('section_name','ar'),
            'section_name_en'=>$this->getTranslation('section_name','en'),
            'status'=>$this->status,
            'sections_count'=>$grade->sections_count,
            'teachers'=>$this->teachers,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

    }
}
