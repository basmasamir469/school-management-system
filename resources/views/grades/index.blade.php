@extends('layouts.master')
@section('css')

@section('title')
{{trans('grades.Grades')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('grades.Grades')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('grades.Grades')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-40">
  {{-- @if ($errors->any())
  <div class="alert alert-danger w-50" role="alert">
    @foreach ($errors->all() as $error)
        <div class="">{{$error}}</div>
    @endforeach
  </div>
  @endif    --}}
      <div class="col-xl-12 mb-30">
        <button type="button" class="btn btn-success btn-lg mb-3 w-25" style="background-color: #28a745 important!" data-toggle="modal" data-target="#exampleModal">
            {{trans('grades.Add Grade')}}
          </button>           
      <div class="card card-statistics h-100">
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('grades.Add Grade')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
                  <form method="post" id="gradeForm">
                    @csrf
                    <div class="row">
                      <div class="col-sm-6 mb-3">
                        <h5 class="form-label" for="">{{trans('grades.Stage-in-arabic')}}</h5>
                        <input type="text" class="form-control mb-3" name="name[ar]">
                        <small id="name.ar_error"  class="form-text text-danger"></small>
                      </div>
                      <div class="col-sm-6 mb-3">
                        <h5 class="form-label" for="">{{trans('grades.Stage-in-english')}}</h5>
                        <input type="text" class="form-control mb-3" name="name[en]">
                        <small id="name.en_error" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-3 col-md-12">
                        <h5 class="form-label" for="">{{trans('grades.Notes')}}</h5>
                        <textarea class="form-control mb-3" name="notes" id="" cols="30" rows="5"></textarea>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
          <button type="button" id="storeGrade" count_grades={{count($grades)}} class="btn btn-success">{{trans('main_trans.Submit')}}</button>
        </div>
    </form>
      </div>
    </div>
  </div>
        <div class="card-body">
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0 text-center">
            <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('grades.Grade Name')}}</th>
                    <th>{{trans('grades.Notes')}}</th>
                    <th>{{trans('grades.Actions')}}</th>
                </tr>
            </thead>
            <tbody id="gradeTable">
                @foreach($grades as $grade)
                <tr id="grade{{$grade->id}}">
                    <td>{{$loop->iteration}}</td>
                    <td>{{$grade->name}}</td>
                    <td>{{$grade->notes}}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                              data-target="#edit{{ $grade->id }}"
                              title="{{ trans('main_trans.Edit') }}"><i
                              class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                              data-target="#delete{{ $grade->id }}"
                              title="{{ trans('main_trans.Delete') }}"><i
                              class="fa fa-trash"></i></button>
                  </td>
                </tr>
                {{-- edit Modal --}}
                <div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{trans('grades.Edit Grade')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                                <form method="post" class="editGradeForm" grade_id={{$grade->id}}>
                                  @csrf
                                  @method('Patch')
                                  <div class="row">
                                    <input type="hidden" name="id" value="{{$grade->id}}">
                                    <div class="col-sm-6 mb-3">
                                      <h5 class="form-label" for="">{{trans('grades.Stage-in-arabic')}}</h5>
                                      <input type="text" class="form-control mb-3" name="name[ar]" value="{{$grade->getTranslation('name','ar')}}">
                                      <small id="name.ar_error_edit"  class="form-text text-danger"></small>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                      <h5 class="form-label" for="">{{trans('grades.Stage-in-english')}}</h5>
                                      <input type="text" class="form-control mb-3" name="name[en]" value="{{$grade->getTranslation('name','en')}}">
                                      <small id="name.en_error_edit" class="form-text text-danger"></small>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="mb-3 col-md-12">
                                      <h5 class="form-label" for="">{{trans('grades.Notes')}}</h5>
                                      <textarea class="form-control mb-3" name="notes" id="" cols="30" rows="5">{{$grade->notes}}</textarea>
                                    </div>
                                  </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                        <button type="submit" id="updateGrade"  class="btn btn-success">{{trans('main_trans.Update')}}</button>
                      </div>
                  </form>
                    </div>
                  </div>
                </div>
                {{-- end edit Modal --}}

                {{-- deleteModal --}}

                <div class="modal fade" id="delete{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{trans('grades.Delete Grade')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="deleteGrade" grade_id={{$grade->id}} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end deleteModal --}}
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{trans('grades.Grade Name')}}</th>
                    <th>{{trans('grades.Notes')}}</th>
                    <th>{{trans('grades.Actions')}}</th>
                </tr>
            </tfoot>
            
         </table>
        </div>
        </div>
      </div>   
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')
@include('grades.scripts.storegrade')
@include('grades.scripts.updategrade')
@include('grades.scripts.deletegrade')
@endsection

