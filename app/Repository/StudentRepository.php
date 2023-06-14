<?php
namespace App\Repository;

use App\Models\BloodType;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;

class StudentRepository implements StudentRepositoryInterface
{

public function getAllStudents()
{
    return Student::with(['grade','class','section','parent','gender'])->get();
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

public function getSpecializations()
{
    return Specialization::all();
}

public function getGenders()
{
    return Gender::all();
}

public function getStudentById($studentId)
{
    return Student::with(['grade','class','section','parent','gender'])->findOrFail($studentId);
}

public function createStudent($request)
{
    return Student::create($request);
}

public function updateStudent($id,$request)
{
    return Student::find($id)->update($request);
}
public function destroyStudent($id)
{
    return Student::find($id)->delete();
}




}

















?>