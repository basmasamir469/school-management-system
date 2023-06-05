<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class MyParent extends Model
{
    use HasFactory;
    use HasTranslations;

    protected $guarded=[];
    public $translatable = ['father_name','mather_name','mather_job','father_job'];
    public function attachments(){
    return $this->hasMany(ParentAttachment::class,'parent_id');
    }   
}
