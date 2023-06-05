<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teachers\StoreTeacherRequest;
use App\Http\Requests\Teachers\UpdateTeacherRequest;
use App\Repository\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    protected $teacher;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(TeacherRepositoryInterface $teacher)
    {
        $this->teacher=$teacher;
    }

    public function index()
    {
        //
        $teachers=$this->teacher->getAllTeachers();
        return view('teachers.index',compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $specializations=$this->teacher->getSpecializations();
        $genders=$this->teacher->getGenders();
        return view ('teachers.create',compact('specializations','genders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        //
        $teacher=$this->teacher->createTeacher($request->all());
        if($teacher){
            return response()->json([
                'data'=>$teacher,
                'status'=>true,
                'msg'=>'success',
                'route'=>route('Teachers.index')
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
        $teacher=$this->teacher->getTeacherById($id);
        $specializations=$this->teacher->getSpecializations();
        $genders=$this->teacher->getGenders();
        return view('teachers.edit',compact('teacher','specializations','genders'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, $id)
    {
        //
        if(empty($request['password'])){
            $input=array_except($request->all(), ['password']);       
         }
        else{
            $input=$request->all();
            $input['password']=Hash::make($input['password']);
        }
        $teacher=$this->teacher->updateTeacher($id,$input);
        if($teacher){
            return response()->json([
                'data'=>$teacher,
                'status'=>true,
                'msg'=>'success',
                'route'=>route('Teachers.index')
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
        $teacher=$this->teacher->destroyTeacher($id);
        if($teacher){
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
