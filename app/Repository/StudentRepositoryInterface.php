<?php
namespace App\Repository;

interface StudentRepositoryInterface
{

public function getAllStudents();
public function getSpecializations();
public function getGenders();
public function getStudentById($teacherId);
public function createStudent($request);
public function updateStudent($id,$request);
public function destroyStudent($id);
public function getData();


}

















?>