<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use HasFactory;
    use HasTranslations;
    use SoftDeletes;

    protected $guarded=[];
    public $translatable = ['student_name'];

    public function gender(){
        return $this->belongsTo(Gender::class);
    }
    public function nationality(){
        return $this->belongsTo(Nationality::class);
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
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function promotion(){
        return $this->hasOne(Promotion::class);
    }

}
