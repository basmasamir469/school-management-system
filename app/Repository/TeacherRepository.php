<?php
namespace App\Repository;

use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Teacher;

class TeacherRepository implements TeacherRepositoryInterface
{

public function getAllTeachers()
{
    return Teacher::all();
}

public function getSpecializations()
{
    return Specialization::all();
}

public function getGenders()
{
    return Gender::all();
}

public function getTeacherById($teacherId)
{
    return Teacher::findOrFail($teacherId);
}

public function createTeacher($request)
{
    return Teacher::create($request);
}

public function updateTeacher($id,$request)
{
    return Teacher::find($id)->update($request);
}
public function destroyTeacher($id)
{
    return Teacher::find($id)->delete();
}




}

















?>