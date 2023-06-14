<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['student_name'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function section(){
        return $this->belongsTo(Section::class);
    }
    public function parent(){
        return $this->belongsTo(MyParent::class);
    }
    public function class(){
        return $this->belongsTo(GradeClass::class,'grade_class_id');
    }
    public function grade(){
        return $this->belongsTo(Grade::class);
    }

}
