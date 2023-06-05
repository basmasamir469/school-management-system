<?php
namespace App\Repository;

interface TeacherRepositoryInterface
{

public function getAllTeachers();
public function getSpecializations();
public function getGenders();
public function getTeacherById($teacherId);
public function createTeacher($request);
public function updateTeacher($id,$request);
public function destroyTeacher($id);


}

















?>