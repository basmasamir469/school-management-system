<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Students\StoreStudentRequest;
use App\Http\Requests\Students\UpdateStudentRequest;
use App\Http\Requests\Students\uploadRequest;
use App\Repository\StudentRepositoryInterface;
use Flasher\SweetAlert\Laravel\Facade\SweetAlert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    protected $student;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(StudentRepositoryInterface $student)
    {

        $this->student=$student;
        
    }
    public function index()
    {
        //
        $students=$this->student->getAllStudents();
        return view('students.index',compact('students'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=$this->student->getData();
        return view('students.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        //
        $student=$this->student->createStudent($request);
        if($student){
            return response()->json([
                'data'=>$student,
                'status'=>true,
                'msg'=>'success',
                'route'=>route('Students.index')
            ]);
        }
            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>'failed to save'
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $Student=$this->student->getStudentById($id);
        return view('students.show',compact('Student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data=$this->student->getData();
        $student=$this->student->getStudentById($id);
        return view('students.edit',compact('student','data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        //
        if(empty($request['password'])){
            $input=array_except(array_merge(['student_name'=>['en'=>$request->student_name_en,'ar'=>$request->student_name_ar]],$request->all()),['student_name_en','student_name_ar','password']);       
         }
        else{
            $input=array_except(array_merge(['student_name'=>['en'=>$request->student_name_en,'ar'=>$request->student_name_ar],'password'=>Hash::make($request->password)],$request->all()),['student_name_en','student_name_ar','password']);       
        }
       $student= $this->student->updateStudent($id,$input);
       if($student){
        return response()->json([
            'data'=>$student,
            'status'=>true,
            'msg'=>'success',
            'route'=>route('Students.index')
        ]);
    }

        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>'failed to save'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $student=$this->student->destroyStudent($id);
        if($student){
            return response()->json([
                'data'=>[],
                'status'=>true,
                'msg'=>trans('main_trans.data deleted successfully')
            ]);
        }
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('grades.failed to delete! something wrong is happened')
        ]);
    }

    public function uploadAttachments(uploadRequest $request){
        $images=$this->student->uploadAttachments($request);
        if($images){
            return response()->json([
                'data'=>$images,
                'status'=>true,
                'msg'=>trans('Students_trans.submit')
            ]);
        }
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('main_trans.failed to save')
        ]);
    }

    public function downloadAttachments($file_name,$student_name){
            return $this->student->downloadAttachments($file_name,$student_name);
    }
    public function deleteAttachments(Request $request){
        $deleted= $this->student->deleteAttachments($request);
        if($deleted){
            return response()->json([
                'data'=>[],
                'status'=>true,
                'msg'=>trans('main_trans.data deleted successfully')
            ]);
        }
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('grades.failed to delete! something wrong is happened')
        ]); 
    }

}
