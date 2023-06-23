@extends('layouts.master')
@section('css')

@section('title')
{{trans('Students_trans.Student_details')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('Students_trans.Student_details')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Students_trans.Student_details')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
      <div class="col-md-12 mb-30">
          <div class="card card-statistics h-100">
              <div class="card-body">
                  <div class="card-body">
                      <div class="tab nav-border">
                          <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                     role="tab" aria-controls="home-02"
                                     aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                              </li>
                              <li class="nav-item">
                                  <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                     role="tab" aria-controls="profile-02"
                                     aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                              </li>
                          </ul>
                          <div class="tab-content">
                              <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                   aria-labelledby="home-02-tab">
                                  <table class="table table-striped table-hover" style="text-align:center">
                                      <tbody>
                                      <tr class="mb-3">
                                          <th scope="row">{{trans('Students_trans.student_name')}}</th>
                                          <td>{{ $Student->student_name }}</td>
                                          <th scope="row">{{trans('Students_trans.email')}}</th>
                                          <td>{{$Student->email}}</td>
                                          <th scope="row">{{trans('Students_trans.gender')}}</th>
                                          <td>{{$Student->gender->name}}</td>
                                          <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                          <td>{{$Student->nationality->nationality}}</td>
                                      </tr>

                                      <tr class="mb-3">
                                          <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                          <td>{{ $Student->grade->name }}</td>
                                          <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                          <td>{{$Student->class->class_name}}</td>
                                          <th scope="row">{{trans('Students_trans.section')}}</th>
                                          <td>{{$Student->section->section_name}}</td>
                                          <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                          <td>{{ $Student->birth_date}}</td>
                                      </tr>

                                      <tr>
                                          <th scope="row">{{trans('Students_trans.parent')}}</th>
                                          <td>{{ $Student->parent->father_name}}</td>
                                          <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                          <td>{{ $Student->academic_year }}</td>
                                          <th scope="row"></th>
                                          <td></td>
                                          <th scope="row"></th>
                                          <td></td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>

                              <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                   aria-labelledby="profile-02-tab">
                                  <div class="card card-statistics">
                                      <div class="card-body">
                                          <form method="post" id="storeAttachments" count-attachments="{{count($Student->images)}}"  enctype="multipart/form-data">
                                              <div class="col-md-3">
                                                  <div class="form-group">
                                                      <label
                                                          for="academic_year">{{trans('Students_trans.Attachments')}}
                                                          : <span class="text-danger">*</span></label>
                                                      <input type="file" accept="image/*" name="photos[]" multiple required>
                                                      <small id="photos_year_error"  class="form-text text-danger"></small>
                                                      <input type="hidden" name="student_name" value="{{$Student->name}}">
                                                      <input type="hidden" name="student_id" value="{{$Student->id}}">
                                                  </div>
                                              </div>
                                              <br><br>
                                              <button type="submit" class="button button-border x-small">
                                                     {{trans('Students_trans.submit')}}
                                              </button>
                                          </form>
                                      </div>
                                      <br>
                                      <table class="table center-aligned-table mb-0 table table-hover" id="attachmentsTable"
                                             style="text-align:center">
                                          <thead>
                                          <tr class="table-secondary">
                                              <th scope="col">#</th>
                                              <th scope="col">{{trans('Students_trans.filename')}}</th>
                                              <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                              <th scope="col">{{trans('grades.Actions')}}</th>
                                          </tr>
                                          </thead>
                                          <tbody>
                                          @foreach($Student->images as $attachment)
                                              <tr style='text-align:center;vertical-align:middle' id="attachment{{$attachment->id}}">
                                                  <td>{{$loop->iteration}}</td>
                                                  <td>{{$attachment->file_name}}</td>
                                                  <td>{{$attachment->created_at}}</td>
                                                  <td colspan="2">
                                                       <a class="btn btn-outline-info btn-sm"
                                                         href="{{route('Students.download-attachments',['file_name'=>$attachment->file_name,'student_name'=>$attachment->imageable->student_name])}}"
                                                         role="button"><i class="fa fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}</a> 

                                                      <button type="button" class="btn btn-outline-danger btn-sm"
                                                              data-toggle="modal"
                                                              data-target="#deleteAttachment{{ $attachment->id }}"
                                                              title="{{ trans('Grades_trans.Delete') }}">{{trans('main_trans.Delete')}}
                                                      </button> 
                                                      <div class="modal fade" id="deleteAttachment{{$attachment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title">{{trans('Students_trans.Delete_attachment')}}</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" id="deleteAttachment" attachment_id={{$attachment->id}} attachment_name="{{$attachment->file_name}}" student_name="{{$attachment->imageable->student_name}}" class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                  </td>
                                              </tr>
                                          @endforeach
                                          </tbody>
                                      </table>
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
 @include('students.scripts.uploadattachments')
 @include('students.scripts.deleteattachment')  
@endsection

