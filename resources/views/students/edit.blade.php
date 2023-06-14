@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.edit_student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('main_trans.edit_student')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('main_trans.edit_student')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
  <div class="col-md-12 mb-30">
      <div class="card card-statistics h-100">
          <div class="card-body">
              <form method="post" class="editStudentForm" student_id="{{$student->id}}" autocomplete="off">
                @csrf
                @method('PATCH')
                  <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.personal_information')}}</h6><br>
                      <div class="row">
                        <input type="hidden" name="id" value="{{$student->id}}">     
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{trans('Students_trans.name_ar')}} : <span class="text-danger">*</span></label>
                                  <input  type="text" name="student_name_ar"  class="form-control" value="{{$student->getTranslation('student_name','ar')}}">
                                  <small id="student_name_ar_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{trans('Students_trans.name_en')}} : <span class="text-danger">*</span></label>
                                  <input  class="form-control" name="student_name_en" type="text" value="{{$student->getTranslation('student_name','en')}}" >
                                  <small id="student_name_en_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>
                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{trans('Students_trans.email')}} : </label>
                                  <input type="email"  name="email" class="form-control" value="{{$student->email}}">
                                  <small id="email_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>


                          <div class="col-md-6">
                              <div class="form-group">
                                  <label>{{trans('Students_trans.password')}} :</label>
                                  <input  type="password" name="password" class="form-control" autocomplete="new-password" >
                                  <small id="password_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="gender">{{trans('Students_trans.gender')}} : <span class="text-danger">*</span></label>
                                  <select class="custom-select mr-sm-2" name="gender_id">
                                      <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                      @foreach($data['genders'] as $gender)
                                          <option  value="{{ $gender->id }}" @if($gender->id == $student->gender_id) selected @endif>{{ $gender->name }}</option>
                                      @endforeach
                                  </select>
                                  <small id="gender_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="nal_id">{{trans('Students_trans.Nationality')}} : <span class="text-danger">*</span></label>
                                  <select class="custom-select mr-sm-2" name="nationality_id">
                                      <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                      @foreach($data['nationalities'] as $nal)
                                          <option  value="{{ $nal->id }}" @if($nal->id == $student->nationality_id) selected @endif>{{ $nal->nationality }}</option>
                                      @endforeach
                                  </select>
                                  <small id="nationality_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="bg_id">{{trans('Students_trans.blood_type')}} : </label>
                                  <select class="custom-select mr-sm-2" name="blood_type_id">
                                      <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                      @foreach($data['blood_types'] as $bt)
                                          <option value="{{ $bt->id }}" @if($bt->id == $student->blood_type_id) selected @endif>{{ $bt->blood_type }}</option>
                                      @endforeach
                                  </select>
                                  <small id="blood_type_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label>{{trans('Students_trans.Date_of_Birth')}}  :</label>
                                  <input class="form-control" type="text"  id="datepicker-action" name="birth_date" value="{{$student->birth_date}}" data-date-format="yyyy-mm-dd">
                                  <small id="birth_date_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                      </div>

                  <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('Students_trans.Student_information')}}</h6><br>
                  <div class="row">
                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="Grade_id">{{trans('Students_trans.Grade')}} : <span class="text-danger">*</span></label>
                                  <select class="custom-select mr-sm-2" name="grade_id" id="student_grades">
                                      <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                      @foreach($data['grades'] as $g)
                                          <option  value="{{ $g->id }}" @if($g->id == $student->grade_id) selected @endif>{{ $g->name }}</option>
                                      @endforeach
                                  </select>
                                  <small id="grade_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="Classroom_id">{{trans('Students_trans.classrooms')}} : <span class="text-danger">*</span></label>
                                  <select class="custom-select mr-sm-2" name="grade_class_id" id="student_classes">
                                    @foreach ($student->grade->grade_classes as $class)
                                    <option  value="{{ $class->id }}" @if($class->id == $student->class_id) selected @endif>{{ $class->class_name }}</option>
                                    @endforeach
                                  </select>
                                  <small id="grade_class_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-2">
                              <div class="form-group">
                                  <label for="section_id">{{trans('Students_trans.section')}} : </label>
                                  <select class="custom-select mr-sm-2" name="section_id" id="student_sections">
                                  @foreach ($student->class->sections as $section)
                                  <option  value="{{ $section->id }}" @if($section->id == $student->section_id) selected @endif>{{ $section->section_name }}</option>
                                  @endforeach
                                  </select>
                                  <small id="section_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                          <div class="col-md-3">
                              <div class="form-group">
                                  <label for="parent_id">{{trans('Students_trans.parent')}} : <span class="text-danger">*</span></label>
                                  <select class="custom-select mr-sm-2" name="parent_id">
                                      <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                     @foreach($data['parents'] as $parent)
                                          <option value="{{ $parent->id }}" @if($parent->id == $student->parent_id) selected @endif>{{ $parent->father_name }}</option>
                                      @endforeach
                                  </select>
                                  <small id="parent_id_error_edit"  class="form-text text-danger"></small>
                              </div>
                          </div>

                      <div class="col-md-3">
                          <div class="form-group">
                              <label for="academic_year">{{trans('Students_trans.academic_year')}} : <span class="text-danger">*</span></label>
                              <select class="custom-select mr-sm-2" name="academic_year">
                                  <option selected disabled>{{trans('Parent_trans.Choose')}}...</option>
                                  @php
                                      $current_year = date("Y");
                                  @endphp
                                  @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                      <option value="{{ $year}}" @if($year == $student->academic_year) selected @endif>{{ $year }}</option>
                                  @endfor
                              </select>
                              <small id="academic_year_error_edit"  class="form-text text-danger"></small>
                          </div>
                      </div>
                      </div><br>
                  <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"  type="submit">{{trans('main_trans.Update')}}</button>
              </form>

          </div>
      </div>
  </div>
</div>
<!-- row closed -->
@endsection
@section('js')
  @include('students.scripts.updatestudent')
  @include('students.scripts.storestudent')
@endsection

