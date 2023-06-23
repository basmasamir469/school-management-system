@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.add_Graduate')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_Graduate')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">

        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form method="post" id="storeGraduatedForm">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('Students_trans.Grade')}}</label>
                                <select class="custom-select mr-sm-2" id="student_grades" name="grade_id" >
                                    <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                    @foreach($data['grades'] as $grade)
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endforeach
                                </select>
                                <small id="grade_id_error"  class="form-text text-danger"></small>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" id="student_classes" name="class_id" >

                                </select>
                                <small id="class_id_error"  class="form-text text-danger"></small>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                <select class="custom-select mr-sm-2" id="student_sections" name="section_id" >

                                </select>
                                <small id="section_id_error"  class="form-text text-danger"></small>
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
    @include('students.scripts.storestudent')
    @include('students.scripts.graduated.storegraduated')

@endsection
