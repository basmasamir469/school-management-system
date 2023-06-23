<?php
namespace App\Repository;

use App\Http\Resources\AttachmentResource;
use App\Models\BloodType;
use App\Models\Gender;
use App\Models\Grade;
use App\Models\Image;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

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
    return Student::with(['grade','class','section','parent','gender','nationality'])->findOrFail($studentId);
}

public function createStudent($request)
{
     DB::beginTransaction();
     $student=Student::create(array_except(array_merge(['student_name'=>['en'=>$request->student_name_en,'ar'=>$request->student_name_ar]],$request->all()),['student_name_en','student_name_ar','photos']));
     if($request->photos){
     foreach($request->photos as $photo){
     $photo->storeAs($student->student_name,$photo->getClientOriginalName(),$disk='upload_attachments');
     $image=new Image();
     $image->file_name=$photo->getClientOriginalName();
     $student->images()->save($image);

        }
    if($student->images()->count()){
        DB::commit();
        return $student;    
    }
    DB::rollBack();
    return false;
}
DB::commit();
return $student;

}

public function updateStudent($id,$request)
{
    return Student::find($id)->update($request);
}
public function destroyStudent($id)
{
    return Student::find($id)->delete();
}

public function uploadAttachments($request){
$student_images=[];
$student=$this->getStudentById($request->student_id);
foreach($request->photos as $photo){
    $extension = pathinfo($photo->getClientOriginalName(), PATHINFO_EXTENSION);
    $file_name=$photo->getClientOriginalName()."-".time().'.'.$extension;
$photo->storeAs($student->student_name,$file_name,$disk='upload_attachments');
$student_images[]=new AttachmentResource($student->images()->create([
    'file_name'=>$file_name
]));
}
return $student_images;
}

public function downloadAttachments($file_name,$student_name){
    return response()->download(public_path().'/student_attachments/'.$student_name.'/'.$file_name);
}

public function deleteAttachments($request){
    File::delete(public_path('/student_attachments/'.$request->student_name.'/'.$request->file_name));
    return Image::findorFail($request->id)->delete();
}
    





}

















?>