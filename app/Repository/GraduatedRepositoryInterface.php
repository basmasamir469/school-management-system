<?php
namespace App\Repository;

interface GraduatedRepositoryInterface
{

public function getAllGraduated();
public function storeGraduated($request);
public function getData();
public function returnStudent($id);
public function deleteStudent($id);

}

















?>