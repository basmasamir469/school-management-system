@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('main_trans.students')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.students')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-40">
      <div class="col-xl-12 mb-30">
        <a href="{{route('Students.create')}}"> 
          <button type="button" class="btn btn-success btn-lg mb-3 w-25" style="background-color: #28a745 important!">
            {{trans('main_trans.add_student')}}
          </button>
        </a>
   
      <div class="card card-statistics h-100">
          <div class="card-body">
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0 text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('Students_trans.student_name')}}</th>
                    <th>{{trans('Students_trans.email')}}</th>
                    <th>{{trans('Students_trans.Date_of_Birth')}}</th>
                    <th>{{trans('Students_trans.parent')}}</th>
                    <th>{{trans('Students_trans.Grade')}}</th>
                    <th>{{trans('Students_trans.classrooms')}}</th>
                    <th>{{trans('Students_trans.section')}}</th>
                    <th>{{trans('Students_trans.academic_year')}}</th>
                    <th>{{trans('classes.Actions')}}</th>
                </tr>
            </thead>
            <tbody id="studentTable">
                @foreach($students as $student)
                <tr id="student{{$student->id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$student->student_name}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->birth_date}}</td>
                    <td>{{$student->parent?->father_name}}</td>
                    <td>{{$student->grade?->name}}</td>
                    <td>{{$student->class?->class_name}}</td>
                    <td>{{$student->section?->section_name}}</td>
                    <td>{{$student->academic_year}}</td>
                    <td class="d-flex">
                      <a href="{{route('Students.edit',$student->id)}}" class="mr-1">
                        <button type="button" class="btn btn-info btn-sm"
                              title="{{ trans('main_trans.Edit') }}">
                                 <i
                                class="fa fa-edit"></i>
                        </button>
                      </a>
                      <button type="button" class="btn btn-danger btn-sm mr-1" data-toggle="modal"
                              data-target="#deleteStudent{{ $student->id }}"
                              title="{{ trans('main_trans.Delete') }}"><i
                              class="fa fa-trash "></i></button>
                     <a href="{{route('Students.show',$student->id)}}" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fa fa-eye"></i></a>

                  </td>
                </tr>
                {{-- deleteModal --}}

                <div class="modal fade" id="deleteStudent{{$student->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{trans('Students_trans.delete_student')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="deleteStudent" student_id={{$student->id}} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end deleteModal --}}
                @endforeach
            </tbody>            
         </table>
        </div>
        </div>
      </div>   
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')
 @include('students.scripts.deletestudent') 
@endsection

