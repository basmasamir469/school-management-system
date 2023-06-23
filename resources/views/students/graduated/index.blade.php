@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.list_Graduate')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.list_Graduate')}} <i class="fas fa-user-graduate"></i>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{trans('Students_trans.student_name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('grades.Actions')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody id="graduatedTable">
                                        @foreach($graduated_students as $student)
                                            <tr id="graduated{{$student->id}}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$student->student_name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender?->name}}</td>
                                            <td>{{$student->grade?->name}}</td>
                                            <td>{{$student->class?->class_name}}</td>
                                            <td>{{$student->section?->section_name}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#returnStudent{{ $student->id }}" title="{{ trans('Grades_trans.Delete') }}">{{ trans('Students_trans.rollback_student') }}</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteStudent{{ $student->id }}" title="{{ trans('Grades_trans.Delete') }}">{{ trans('Students_trans.delete_student') }}</button>

                                                </td>
                                            </tr>
                                        @include('students.graduated.return')
                                        @include('students.graduated.delete')
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
    @include('students.scripts.graduated.returnstudent')
    @include('students.scripts.graduated.deletestudent')
@endsection
