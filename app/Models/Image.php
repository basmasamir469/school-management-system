<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function imageable()
    {
        return $this->morphTo();
    }
    public function getCreatedAtAttribute(){
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
    }

}
