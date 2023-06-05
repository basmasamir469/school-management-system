<?php

namespace App\Http\Controllers\GradeClasses;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sections\StoreSectionRequest;
use App\Http\Requests\Sections\UpdateSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Grade;
use App\Models\GradeClass;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grades=Grade::with(['sections','grade_classes'])->withCount('sections')->get();
        $grade_classes=GradeClass::all();
        $sections=Section::all();
        $teachers=Teacher::all();
        return view('sections.index',compact('grades','grade_classes','sections','teachers'));

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
    public function store(StoreSectionRequest $request)
    {
        //
        if(request()->ajax()){
            $request->merge(['status'=>$request->status?1:0]);
            // DB::beginTransaction();
            $section=Section::create(array_except($request->all(),['teachers']));
            $section->teachers()->attach($request->teachers);
            // DB::commit();
            if($section){
                return response()->json([
                    'data'=>new SectionResource($section),
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
    public function update(UpdateSectionRequest $request, $id)
    {
        //
        $section=Section::find($id);
        $request->merge(['status'=>$request->status?1:0]);
        // DB::beginTransaction();
        $section->update(array_except($request->all(),['teachers']));
        $section->teachers()->sync($request->teachers);
        // DB::commit();
        if($section){
            return response()->json([
                'data'=>new SectionResource($section->fresh()),
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
        $section=Section::findOrFail($id);
        if($section->delete()){
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
