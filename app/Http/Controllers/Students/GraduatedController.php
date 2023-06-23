<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grades\StoreGradeRequest;
use App\Http\Requests\Graduated\StoreGraduatedRequest;
use App\Repository\GraduatedRepositoryInterface;
use Illuminate\Http\Request;

class GraduatedController extends Controller
{
    protected $graduated;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(GraduatedRepositoryInterface $graduated)
    {

        $this->graduated=$graduated;
        
    }
    public function index()
    {
        //
        $graduated_students=$this->graduated->getAllGraduated();
        return view('students.graduated.index',compact('graduated_students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=$this->graduated->getData();
        return view('students.graduated.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGraduatedRequest $request)
    {
        //
        $graduated=$this->graduated->storeGraduated($request);
        if($graduated){
            return response()->json([
                'data'=>$graduated,
                'status'=>true,
                'msg'=>'success',
                'route'=>route('Graduated.index')
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
        $student=$this->graduated->returnStudent($id);
        if($student){
            return response()->json([
                'data'=>$student,
                'status'=>true,
                'msg'=>__('main_trans.Data has been saved successfully!'),
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        $student=$this->graduated->deleteStudent($id);
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
}
