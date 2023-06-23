<?php
namespace App\Repository;

interface PromotionRepositoryInterface
{

public function getAllPromotions();
public function createPromotion($request);
public function destroyPromotion($request);
public function getData();
public function graduateStudent($id);

}

















?>