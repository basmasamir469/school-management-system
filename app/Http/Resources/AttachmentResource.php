<?php

namespace App\Http\Resources;

use App\Models\Student;
use Illuminate\Http\Resources\Json\JsonResource;

class AttachmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'file_name' => $this->file_name,
            'imageable_type' => $this->imeageable_type,
            'imageable_id' => $this->imeageable_id,
            'student_name' => Student::findOrFail($this->imageable_id)->student_name,
            'created_at'=>$this->created_at,
        ];
    }
}
