<?php

namespace App\Http\Controllers\GradeClasses;

use App\Http\Controllers\Controller;
use App\Http\Requests\GradeClasses\StoreClassRequest;
use App\Http\Requests\GradeClasses\UpdateClassRequest;
use App\Http\Resources\GradeClassCollection;
use App\Http\Resources\GradeClassResource;
use App\Models\Grade;
use App\Models\GradeClass;
use Illuminate\Http\Request;

class GradeClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grade_classes=GradeClass::all();
        $grades=Grade::all();
        return view('grade_classes.index',compact('grades','grade_classes'));
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
    public function store(StoreClassRequest $request)
    {
        $all_classes=[];
        if(request()->ajax()){
        $grade_classes=$request->data;
        foreach($grade_classes['classes_list'] as $grade_class){
        //    $grade_class['grade_id']=$grade_class['grade_id']==''?null:$grade_class['grade_id'];
           $gclass=GradeClass::create([
            'class_name'=>['en'=>$grade_class['class_name_en'],'ar'=>$grade_class['class_name_ar']],
            'grade_id'=>$grade_class['grade_id']
           ]);
            if($gclass){
             $all_classes[]= new GradeClassResource($gclass);
            }
            else{
             return response()->json([
                 'data'=>[],
                 'status'=>false,
                 'msg'=>'failed to update'
             ]);
            }
        }
        return response()->json([
            'data'=>$all_classes,
            'status'=>true,
            'msg'=>'success'
        ]);
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
    public function update(UpdateClassRequest $request, $id)
    {
        //
        $gclass=GradeClass::find($id);
        $gclass->update([
            'class_name'=>['en'=>$request->class_name_en,'ar'=>$request->class_name_ar],
            'grade_id'=>$request->grade_id
        ]);
        if($gclass){
            return response()->json([
                'data'=>new GradeClassResource($gclass->fresh()),
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
        $gclass=GradeClass::findOrFail($id);
        if($gclass->sections()->count()) {
            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>trans('sections.failed to delete! there are sections belongs to this class')
            ]);    
        }
        if($gclass->delete()){
            return response()->json([
                'data'=>[],
                'status'=>true,
                'msg'=>trans('classes.Class deleted successfully!')
            ]);
        }
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('grades.failed to delete! something wrong is happened')
        ]);

    }

    public function deleteChecked(Request $request){
       $grade_classes=json_decode($request->checked_rows);
       foreach($grade_classes as $gclass){
        $gclass=GradeClass::findOrFail($gclass);
        if($gclass->sections()->count()) {
            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>trans('sections.failed to delete! there are sections belongs to this class').$gclass->class_name
            ]);    
        }
        if(!$gclass || !$gclass->delete()){
        return response()->json([
            'data'=>[],
            'status'=>false,
            'msg'=>trans('grades.failed to delete! something wrong is happened')
        ]);
      }
       }
       return response()->json([
        'data'=>[],
        'status'=>true,
        'msg'=>trans('classes.Class deleted successfully!')
    ]);

    }
    public function filterGrade(Request $request){
        // $grade_classes=GradeClass::query();
        // $grade_classes=$grade_classes->when($request->filled('selected_grade'),function($q) use($request){
        //       return $q->where('grade_id',$request->selected_grade);
        // })->get();
        if($request->selected_grade !=null){
            $grade_classes=GradeClass::where('grade_id',$request->selected_grade)->get();
        }
        else{
            $grade_classes=GradeClass::all();
        }
        return response()->json([
            'data'=>new GradeClassCollection($grade_classes),
            'status'=>true,
            'msg'=>'success'
        ]);

    }

}
