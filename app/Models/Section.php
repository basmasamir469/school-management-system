<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['section_name'];
    public $timestamps = true;

    public function grade_class(){
        return $this->belongsTo(GradeClass::class,'gradeClass_id');
    }

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class,'section_teacher');
    }


}
