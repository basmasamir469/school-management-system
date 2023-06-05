@extends('layouts.master')
@section('css')

@section('title')
{{trans('Teacher_trans.Edit_Teacher')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('Teacher_trans.Edit_Teacher')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Teacher_trans.Edit_Teacher')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-40">
      <div class="col-xl-12 mb-30">
      <div class="card card-statistics h-100">
          <div class="card-body">
            <form method="post" class="editTeacherForm mt-5" teacher_id={{$teacher->id}}>
              @method('PATCH')
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Name_ar')}}</h5>
                  <input type="text" class="form-control mb-3" name="name[ar]" value={{$teacher->getTranslation('name','ar')}}>
                  <input type="hidden" name="id" value="{{$teacher->id}}">
                  <small id="name.ar_error_edit"  class="form-text text-danger"></small>
                </div>
                <div class="col-sm-6 mb-3">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Name_en')}}</h5>
                  <input type="text" class="form-control mb-3" name="name[en]" value={{$teacher->getTranslation('name','en')}}>
                  <small id="name.en_error_edit" class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Email')}}</h5>
                  <input type="email" class="form-control mb-3" name="email" value="{{$teacher->email}}">
                  <small id="email_error_edit" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>
              <div class="row mb-3">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Password')}}</h5>
                  <input type="password" class="form-control mb-3" name="password">
                  <small id="password_error_edit" name="specialization_id_error"  class="form-text text-danger"></small>

                </div>
              </div>

              <div class="row mb-3">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Gender')}}</h5>
                  <div class="d-flex">
              @foreach ($genders as $gender)
              <div class="form-check ml-3">
                <input class="form-check-input" type="radio" name="gender_id" value="{{$gender->id}}" @if($gender->id==$teacher->gender_id) checked @endif id="flexRadioDefault{{$gender->id}}">
                <label class="form-check-label" for="flexRadioDefault{{$gender->id}}">
                  {{$gender->name}}
                </label>
              </div>
              @endforeach
            </div>
            <small id="gender_id_error_edit" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Address')}}</h5>
                  <textarea class="form-control mb-3" name="address" id="" cols="30" rows="5">{{$teacher->address}}</textarea>
                  <small id="address_error_edit" class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.specialization')}}</h5>
                    <select class="custom-select" name="specialization_id">
                      <option value="">{{ trans('Teacher_trans.specialization') }}</option>
                      @foreach ($specializations as $specialization)
                      <option value="{{$specialization->id}}" @if($specialization->id == $teacher->specialization_id) selected @endif>{{$specialization->name}}</option>
                      @endforeach
                    </select>
                    <small id="specialization_id_error_edit" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Joining_Date')}}</h5>
                  <input type="date" class="form-control mb-3" name="joining_date" value="{{$teacher->joining_date}}">
                  <small id="joining_date_error_edit"   class="form-text text-danger"></small>
                </div>
              </div>


              <div class="row d-flex justify-content-end">
                <div style="margin-left: 30px;margin-right:30px;">
                <button type="submit"  class="btn btn-success">{{trans('main_trans.Update')}}</button>
              </div>
              </div>
            </form>            
  </div>
        </div>
      </div>   
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')
 @include('teachers.scripts.updateteacher')
@endsection

