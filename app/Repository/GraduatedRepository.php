<?php
namespace App\Repository;

use App\Models\BloodType;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Promotion;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

class GraduatedRepository implements GraduatedRepositoryInterface
{

public function getAllGraduated()
{
    return Student::onlyTrashed()->with(['grade','class','section','gender'])->get();
}

public function getData(){
    return $data=[
        'genders'=>Gender::all(),
        'nationalities'=>Nationality::all(),
        'parents'=>MyParent::all(),
        'blood_types'=>BloodType::all(),
        'grades'=>Grade::all()
    ];
}

public function storeGraduated($request)
{
     $students=Student::where('grade_id',$request->grade_id)->where('section_id',$request->section_id)->where('grade_class_id',$request->class_id)->get();
     $student_ids=$students->pluck('id')->toArray();
     if(count($students) >0){
        return Student::whereIn('id',$student_ids)->delete();
    }
    else{
        return false;
    }
}

public function returnStudent($id){
    return Student::onlyTrashed()->where('id',$id)->first()->restore();
}
public function deleteStudent($id){
    return Student::onlyTrashed()->where('id',$id)->first()->forceDelete();
}
}

    






















?>