<?php
namespace App\Repository;

interface StudentRepositoryInterface
{

public function getAllStudents();
public function getSpecializations();
public function getGenders();
public function getStudentById($studentId);
public function createStudent($request);
public function updateStudent($id,$request);
public function destroyStudent($id);
public function getData();
public function uploadAttachments($request);
public function downloadAttachments($file_name,$student_name);
public function deleteAttachments($request);


}

















?>