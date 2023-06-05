<?php

namespace App\Http\Controllers\Grades;

use App\Http\Controllers\Controller;
use App\Http\Requests\Grades\StoreGradeRequest;
use App\Http\Requests\Grades\UpdateGradeRequest;
use App\Http\Resources\GradeClassCollection;
use App\Models\Grade;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grades=Grade::all();
        return view('grades.index',compact('grades'));
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradeRequest $request)
    {
        //
        if(request()->ajax()){
        $grade=Grade::create($request->all());
        if($grade){
            return response()->json([
                'data'=>$grade,
                'status'=>true,
                'msg'=>'success'
            ]);
        }

            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>'failed to save'
            ]);
        // return redirect()->back();
    }
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradeRequest $request, $id)
    {
        //
        $grade=Grade::find($id);
        $grade->update([
            'name'=>$request->name,
            'notes'=>$request->notes
        ]);
        if($grade){
            return response()->json([
                'data'=>$grade->fresh(),
                'status'=>true,
                'msg'=>'success'
            ]);
        }

            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>'failed to update'
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
        $grade=Grade::find($id);
        if($grade->grade_classes()->count()) {
            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>trans('grades.failed to delete! there are classes belongs to this grade')
            ]);    
        }
        if($grade->delete()){
            return response()->json([
                'data'=>[],
                'status'=>true,
                'msg'=>trans('grades.Grade deleted successfully!')
            ]);
        }
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('grades.failed to delete! something wrong is happened')
        ]);

    }

    public function gradeClasses($id)
    {
        //
        if(request()->ajax()){
        $grade=Grade::find($id);
        if($grade){
            return response()->json([
                'data'=>new GradeClassCollection($grade->grade_classes),
                'status'=>true,
                'msg'=>'success'
            ]);
        }

            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>'failed to save'
            ]);
        // return redirect()->back();
    }
}



}
