<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class GradeClass extends Model 
{
    use HasFactory;
    use HasTranslations;

    protected $table = 'grade_classes';
    protected $guarded=[];
    public $translatable = ['class_name'];
    public $timestamps = true;

    public function grade(){
        return $this->belongsTo(Grade::class);
    }

}