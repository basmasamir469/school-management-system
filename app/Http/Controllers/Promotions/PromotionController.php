<?php

namespace App\Http\Controllers\Promotions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Promotions\StorePromotionRequest;
use App\Repository\PromotionRepositoryInterface;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    protected $promotion;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(PromotionRepositoryInterface $promotion)
    {

        $this->promotion=$promotion;
        
    }
    public function index()
    {
        //
        $promotions=$this->promotion->getAllPromotions();
        return view('students.promotions.management',compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data=$this->promotion->getData();
        return view('students.promotions.create',compact('data'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePromotionRequest $request)
    {
        //
        $promotions=$this->promotion->createPromotion($request);
        if($promotions){
            return response()->json([
                'data'=>$promotions,
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
    public function destroy(Request $request)
    {
        //
        $deleted=$this->promotion->destroyPromotion($request);
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

    public function graduate($id)
    {
        $student=$this->promotion->graduateStudent($id);
        if($student){
            return response()->json([
                'data'=>$student,
                'status'=>true,
                'msg'=>__('main_trans.Data has been saved successfully!'),
                'route'=>route('Graduated.index')
            ]);
        }
            return response()->json([
                'data'=>[],
                'status'=>false,
                'msg'=>'failed to save'
            ]);
    }

}
