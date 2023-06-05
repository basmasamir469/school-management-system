@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.Teachers')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('main_trans.Teachers')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.List_Teachers')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-40">
      <div class="col-xl-12 mb-30">
        <a href="{{route('Teachers.create')}}"> 
          <button type="button" class="btn btn-success btn-lg mb-3 w-25" style="background-color: #28a745 important!">
            {{trans('Teacher_trans.Add_Teacher')}}
          </button>
        </a>
   
      <div class="card card-statistics h-100">
          <div class="card-body">
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0 text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('Teacher_trans.Name_Teacher')}}</th>
                    <th>{{trans('Teacher_trans.Email')}}</th>
                    <th>{{trans('Teacher_trans.Address')}}</th>
                    <th>{{trans('Teacher_trans.specialization')}}</th>
                    <th>{{trans('Teacher_trans.Joining_Date')}}</th>
                </tr>
            </thead>
            <tbody id="gradeTable">
                @foreach($teachers as $teacher)
                <tr id="teacher{{$teacher->id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$teacher->name}}</td>
                    <td>{{$teacher->email}}</td>
                    <td>{{$teacher->address}}</td>
                    <td>{{$teacher->specialization->name}}</td>
                    <td>
                      <a href="{{route('Teachers.edit',$teacher->id)}}">
                        <button type="button" class="btn btn-info btn-sm"
                              title="{{ trans('main_trans.Edit') }}">
                                 <i
                                class="fa fa-edit"></i>
                            </button>
                          </a>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                              data-target="#delete{{ $teacher->id }}"
                              title="{{ trans('main_trans.Delete') }}"><i
                              class="fa fa-trash"></i></button>
                  </td>
                </tr>
                {{-- deleteModal --}}

                <div class="modal fade" id="delete{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{trans('Teacher_trans.Delete_Teacher')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="deleteTeacher" teacher_id={{$teacher->id}} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
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
 @include('teachers.scripts.deleteteacher') 
@endsection

