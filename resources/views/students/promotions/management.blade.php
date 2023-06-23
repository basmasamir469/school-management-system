@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_promotions')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_promotions')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteAllPromotions">
                                    {{ trans('Students_trans.rollback_all') }}
                                </button>
                                <br><br>


                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th class="alert-info">#</th>
                                            <th class="alert-info">{{trans('Students_trans.student_name')}}</th>
                                            <th class="alert-danger">{{ trans('Students_trans.old_grade') }}</th>
                                            <th class="alert-danger"> {{ trans('Students_trans.old_academic_year') }}</th>
                                            <th class="alert-danger">{{ trans('Students_trans.old_class') }}</th>
                                            <th class="alert-danger">{{ trans('Students_trans.old_section') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_grade') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_academic_year') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_class') }}</th>
                                            <th class="alert-success">{{ trans('Students_trans.current_section') }}</th>
                                            <th>{{trans('grades.Actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="promotions">
                                        @foreach($promotions as $promotion)
                                            <tr id="promotion{{$promotion->id}}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{$promotion->student->student_name}}</td>
                                                <td>{{$promotion->fromGrade->name}}</td>
                                                <td>{{$promotion->from_academic_year}}</td>
                                                <td>{{$promotion->fromClass->class_name}}</td>
                                                <td>{{$promotion->fromSection->section_name}}</td>
                                                <td>{{$promotion->toGrade->name}}</td>
                                                <td>{{$promotion->to_academic_year}}</td>
                                                <td>{{$promotion->toClass->class_name}}</td>
                                                <td>{{$promotion->toSection->section_name}}</td>
                                                <td class="d-flex justify-content-between">
                                                        <button type="button" class="btn btn-outline-danger" style="margin-left: 5px;" data-toggle="modal" data-target="#deleteOnePromotion{{$promotion->id}}">{{__('Students_trans.rollback_student')}}</button>
                                                        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#graduateStudent{{$promotion->student_id}}">{{ trans('Students_trans.graduate_student') }}</button>
                                                    </td>
                                            </tr>
                                    @include('students.promotions.delete_all')
                                    @include('students.promotions.delete_one')
                                    @include('students.promotions.graduate')  
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @include('students.scripts.promotions.delete_all')
    @include('students.scripts.promotions.delete_one')
    @include('students.scripts.promotions.graduatestudent')
@endsection