@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.Students_Promotions')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.Students_Promotions')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                        <h6 style="color: red;font-family: Cairo">{{__('main_trans.old_school_grade')}}</h6><br>

                    <form method="post" id="storePromotionForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" id="student_grades" name="from_grade_id" >
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($data['grades'] as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                <small id="from_grade_id_error"  class="form-text text-danger"></small>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="student_classes" name="from_class_id" >

                                </select>
                                <small id="from_class_id_error"  class="form-text text-danger"></small>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" id="student_sections" name="from_section_id" >

                                </select>
                                <small id="from_section_id_error"  class="form-text text-danger"></small>
                            </div>

                            {{-- <div class="col-md-3"> --}}
                                <div class="form-group col">
                                    <label for="academic_year">{{trans('Students_trans.old_academic_year')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2" name="from_academic_year">
                                        <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                        @php
                                            $current_year = date("Y");
                                        @endphp
                                        @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                            <option value="{{ $year}}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                    <small id="from_academic_year_error"  class="form-text text-danger"></small>
                                </div>
                            {{-- </div> --}}
                        </div>
                        <br><h6 style="color: red;font-family: Cairo">{{__('main_trans.new_school_grade')}}</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" id="new_student_grades" name="to_grade_id" >
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($data['grades'] as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                <small id="to_grade_id_error"  class="form-text text-danger"></small>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="new_student_classes" name="to_class_id" >

                                </select>
                                <small id="to_class_id_error"  class="form-text text-danger"></small>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">:{{trans('Students_trans.section')}} </label>
                                <select class="custom-select mr-sm-2" id="new_student_sections" name="to_section_id" >

                                </select>
                                <small id="to_section_id_error"  class="form-text text-danger"></small>
                            </div>

                            <div class="form-group col">
                                <label for="academic_year">{{trans('Students_trans.current_academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="to_academic_year">
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y");
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                                <small id="to_academic_year_error"  class="form-text text-danger"></small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">{{__('main_trans.Submit')}}</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
    <!-- row closed -->
@endsection
@section('js')

    @toastr_js
    @toastr_render
    @include('students.scripts.promotions.storepromotion')
    @include('students.scripts.storestudent')

@endsection
