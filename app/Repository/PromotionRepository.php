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

class PromotionRepository implements PromotionRepositoryInterface
{

public function getAllPromotions()
{
    return Promotion::with(['fromGrade','fromClass','fromSection','toGrade','toClass','toSection','student'])->get();
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

public function createPromotion($request)
{
     $students=Student::where('grade_id',$request->from_grade_id)->where('section_id',$request->from_section_id)->where('grade_class_id',$request->from_class_id)->where('academic_year',$request->from_academic_year)->get();
     $student_ids=$students->pluck('id')->toArray();
     $promotions=[];
     if(count($students) >0){
        DB::beginTransaction();
        $student_promotions=Student::whereIn('id',$student_ids)->update([
            'grade_id'=>$request->to_grade_id,
            'grade_class_id'=>$request->to_class_id,
            'section_id'=>$request->to_section_id,
            'academic_year'=>$request->to_academic_year

        ]);
     foreach($students as $student){
        $promotions[]=$student->promotion()->updateOrCreate(array_except($request->all(), ['student_id','_token']));
    }
        DB::commit();
        if(!$promotions || !$student_promotions){
            DB::rollBack();
        }
        else{
            return $student_promotions;
          }
    }
    else{
        return false;
    }
}
public function destroyPromotion($request)
{
    if($request->delete_all==1){
    $promotion_student_ids=Promotion::pluck('student_id')->toArray();
    $promotions=Promotion::all();
     DB::beginTransaction();
    foreach($promotions as $promotion){
       $student= Student::where('id',$promotion->student_id)->update([
           'grade_id'=>$promotion->from_grade_id,
           'grade_class_id'=>$promotion->from_class_id,
           'section_id'=>$promotion->from_section_id,
           'academic_year'=>$promotion->from_academic_year

            ]); 
            if(!$student){
                return false;
            }
       }
    $delete_promotions=DB::table('promotions')->delete();
     DB::commit();
    if($delete_promotions){
        return true;
    }
    else{
         DB::rollBack();
        return false;
    }

    }
    else{
        DB::beginTransaction();
        $promotion=Promotion::findOrFail($request->id);
        $student=Student::where('id',$promotion->student_id)->update([
            'grade_id'=>$promotion->from_grade_id,
            'grade_class_id'=>$promotion->from_class_id,
            'section_id'=>$promotion->from_section_id,
            'academic_year'=>$promotion->from_academic_year 
        ]);
        $delete_promotion=$promotion->delete();
        DB::commit();
        if($delete_promotion && $student){
            return true;
        }
        else{
            DB::rollBack();
            return false; 
        }

    }
}

    

public function graduateStudent($id){
    return Student::where('id',$id)->first()->delete();
}




}

















?>