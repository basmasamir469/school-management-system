@extends('layouts.master')
@section('css')

@section('title')
{{trans('Teacher_trans.Add_Teacher')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('Teacher_trans.Add_Teacher')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Teacher_trans.Add_Teacher')}}</li>
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
            <form method="post" id="teacherForm" class="mt-5">
              <div class="row">
                <div class="col-sm-6 mb-3">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Name_ar')}}</h5>
                  <input type="text" class="form-control mb-3" name="name[ar]">
                  <small id="name.ar_error"  class="form-text text-danger"></small>
                </div>
                <div class="col-sm-6 mb-3">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Name_en')}}</h5>
                  <input type="text" class="form-control mb-3" name="name[en]">
                  <small id="name.en_error" class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Email')}}</h5>
                  <input type="email" class="form-control mb-3" name="email">
                  <small id="email_error" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>
              <div class="row mb-3">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Password')}}</h5>
                  <input type="password" class="form-control mb-3" name="password" autocomplete="new-password">
                  <small id="password_error" name="specialization_id_error"  class="form-text text-danger"></small>

                </div>
              </div>

              <div class="row mb-3">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Gender')}}</h5>
                  <div class="d-flex">
              @foreach ($genders as $gender)
              <div class="form-check ml-3">
                <input class="form-check-input" type="radio" name="gender_id" value="{{$gender->id}}" id="flexRadioDefault{{$gender->id}}">
                <label class="form-check-label" for="flexRadioDefault{{$gender->id}}">
                  {{$gender->name}}
                </label>
              </div>
              @endforeach
            </div>
            <small id="gender_id_error" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>
              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Address')}}</h5>
                  <textarea class="form-control mb-3" name="address" id="" cols="30" rows="5"></textarea>
                  <small id="address_error" class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.specialization')}}</h5>
                    <select class="custom-select" name="specialization_id">
                      <option value="">{{ trans('Teacher_trans.specialization') }}</option>
                      @foreach ($specializations as $specialization)
                      <option value="{{$specialization->id}}">{{$specialization->name}}</option>
                      @endforeach
                    </select>
                    <small id="specialization_id_error" name="specialization_id_error"  class="form-text text-danger"></small>
                </div>
              </div>

              <div class="row">
                <div class="mb-3 col-md-8">
                  <h5 class="form-label mb-3" for="">{{trans('Teacher_trans.Joining_Date')}}</h5>
                  <input type="date" class="form-control mb-3" name="joining_date">
                  <small id="joining_date_error"   class="form-text text-danger"></small>
                </div>
              </div>


              <div class="row d-flex justify-content-end">
                <div style="margin-left: 30px">
                <button type="button" id="storeTeacher"  class="btn btn-success">{{trans('main_trans.Submit')}}</button>
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
 @include('teachers.scripts.storeteacher')
@endsection

