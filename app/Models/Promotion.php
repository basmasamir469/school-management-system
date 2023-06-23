<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function student(){
        return $this->belongsTo(Student::class,'student_id');
    }
    public function fromGrade(){
        return $this->belongsTo(Grade::class,'from_grade_id');
    }
    public function fromClass(){
        return $this->belongsTo(GradeClass::class,'from_class_id');
    }
    public function fromSection(){
        return $this->belongsTo(Section::class,'from_section_id');
    }
    public function toGrade(){
        return $this->belongsTo(Grade::class,'to_grade_id');
    }
    public function toClass(){
        return $this->belongsTo(GradeClass::class,'to_class_id');
    }
    public function toSection(){
        return $this->belongsTo(Section::class,'to_section_id');
    }
}
