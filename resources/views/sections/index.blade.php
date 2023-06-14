@extends('layouts.master')
@section('css')
<style>
  .nice-select{
  float:unset !important;
  }
  </style>  
@section('title')
{{trans('sections.title_page')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('sections.title_page')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('sections.title_page')}}</li>
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
        <button type="button" class="btn btn-success btn-lg mb-3 w-25" style="background-color: #28a745 important!" data-toggle="modal" data-target="#storeSectionModal">
            {{trans('sections.add_section')}}
          </button>             
  <!-- Modal -->
  <div class="modal fade" id="storeSectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{trans('sections.add_section')}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="storeSectionForm">
          @csrf
        <div class="modal-body">
                    <div class="row">
                      <div class="col-sm-6 mb-3">
                        <h5 class="form-label" for="">{{trans('sections.Section_name_ar')}}</h5>
                        <input type="text" class="form-control mb-3" name="section_name_ar">
                        <small id="section_name_ar_error"  class="form-text text-danger"></small>
                      </div>
                      <div class="col-sm-6 mb-3">
                        <h5 class="form-label" for="">{{trans('sections.Section_name_en')}}</h5>
                        <input type="text" class="form-control mb-3" name="section_name_en">
                        <small id="section_name_en_error" class="form-text text-danger"></small>
                      </div>
                    </div>
                    <div class="row">
                      <div class="mb-3 col-md-8">
                        <h5 class="form-label" for="">{{trans('sections.Name_Grade')}}</h5>
                          <select class="custom-select" id="select_grade" name="grade_id">
                            <option value="">{{__('classes.Name_Grade')}}</option>
                              @foreach ($grades as $grade)
                                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                              @endforeach
                          </select>
                          <small id="grade_id_error" name="grade_id_error"  class="form-text text-danger"></small>
                      </div>
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-8">
                        <h5 class="form-label" for="">{{trans('sections.Name_Class')}}</h5>
                          <select class="custom-select" id="grade_classes" name="gradeClass_id">
                          </select>
                          <small id="gradeClass_id_error" name="gradeClass_id_error"  class="form-text text-danger"></small>
                      </div>
                    </div>

                    <div class="row">
                      <div class="mb-3 col-md-8">
                        <h5 class="form-label" for="">{{trans('main_trans.Teachers')}}</h5>
                        @foreach ($teachers as $teacher)
                        <div class="form-check">
                          <input class="form-check-input teachers" type="checkbox" name="teachers[]" value="{{$teacher->id}}" id="flexCheckDefault{{$teacher->id}} ">
                          <label class="form-check-label" for="flexCheckDefault{{$teacher->id}}">
                            {{$teacher->name}} -- {{$teacher->specialization->name}}
                          </label>
                        </div>
                        @endforeach
                          <small id="teachers_error"   class="form-text text-danger"></small>
                      </div>
                    </div>


                    <div class="row">
                      <div class="col-6">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked" checked>
                          <label class="form-check-label" for="flexCheckChecked">
                            {{__('sections.Status')}}
                          </label>
                        </div>
                      </div>
                    </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
          <button type="submit" id="storeSection" count_grades={{count($grades)}} class="btn btn-success">{{trans('main_trans.Submit')}}</button>
        </div>
    </form>
      </div>
    </div>
  </div>
          </div>
        <div class="card-body">
          <div class="accordion gray plus-icon round">
            @foreach($grades as $grade)
            <div class="acd-group" id="group{{$grade->id}}">
              <a href="#" class="acd-heading">{{$grade->name}}</a>
              <div class="acd-des" style="display: none;">
                <div class="table-responsive">
              <table class="mb-0 table table-hover sections-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>{{trans('sections.Name_Section')}}</th>
                    <th>{{trans('sections.Name_Class')}}</th>
                    <th>{{trans('sections.Status')}}</th>
                    <th>{{trans('classes.Actions')}}</th>
                </tr>
                </thead>
                <tbody id="gradeTable{{$grade->id}}">
                  @foreach($grade->sections as $section)
                  <tr id="section{{$section->id}}">
                    <input type="hidden" name="sections-count{{$grade->id}}" value={{$grade->sections_count}}>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$section->section_name}}</td>
                      <td>{{$section->grade_class?->class_name}}</td>
                      <td>
                        @if($section->status==\App\interfaces\GradeClassSectionStatus::ACTIVE)
                        <span class="badge badge-success">{{trans('sections.Status_Section_AC')}}</span>
                        @else
                        <span class="badge badge-danger">{{trans('sections.Status_Section_No')}}</span>
                        @endif
                      </td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop='false'
                                data-target="#editSectionModal{{ $section->id }}"
                                title="{{ trans('main_trans.Edit') }}"><i
                                class="fa fa-edit"></i></button>
                    {{-- edit section modal --}}
                                <div class="modal fade" id="editSectionModal{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('sections.edit_Section')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="post" class="editSectionForm" id="sectionForm{{$section->id}}" section_id={{$section->id}} grade_id={{$section->grade_id}}>
                                        @csrf
                                        @method('PATCH')
                                      <div class="modal-body">
                                                  <div class="row">
                                                    <input type="hidden" name="id" value="{{$section->id}}">
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('sections.Section_name_ar')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name_ar" value="{{$section->getTranslation('section_name','ar')}}">
                                                      <small id="section_name_ar_error_edit"  class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('sections.Section_name_en')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name_en" value="{{$section->getTranslation('section_name','en')}}">
                                                      <small id="section_name_en_error_edit" class="form-text text-danger"></small>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('classes.Name_Grade')}}</h5>
                                                          <select class="custom-select" id="select_grade" name="grade_id">
                                                            <option value="">{{__('classes.Name_Grade')}}</option>
                                                              @foreach ($grades as $grade)
                                                                  <option value="{{ $grade->id }}" @if($section->grade_id==$grade->id) selected @endif>{{ $grade->name }}</option>
                                                              @endforeach
                                                          </select>
                                                          <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('sections.Name_Class')}}</h5>
                                                        <select class="custom-select" id="grade_classes" name="gradeClass_id">
                                                          <option value="{{$section->gradeClass_id}}">{{$section->grade_class?->class_name}}</option>
                                                        </select>
                                                        <small id="gradeClass_id_error_edit" name="gradeClass_id_error_edit"  class="form-text text-danger"></small>
                                                    </div>
                                                  </div>

                                                   <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('main_trans.Teachers')}}</h5>
                                                      @foreach ($teachers as $teacher)
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="teachers[]" value="{{$teacher->id}}" id="flexCheckDefault{{$teacher->id}}" @if(in_array($teacher->id,$section->teachers->pluck('id')->toArray())) checked @endif>
                                                        <label class="form-check-label" for="flexCheckDefault{{$teacher->id}}">
                                                          {{$teacher->name}} -- {{$teacher->specialization->name}}
                                                        </label>
                                                      </div>
                                                      @endforeach
                                                        <small id="teachers_error_edit"   class="form-text text-danger"></small>
                                                    </div>
                                                  </div> 

                              
                                                  <div class="row">
                                                    <div class="col-6">
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked"  @if($section->status==1) checked @endif>
                                                        <label class="form-check-label" for="flexCheckChecked">
                                                          {{__('sections.Status')}}
                                                        </label>
                                                      </div>
                                                    </div>
                                                  </div>
                              
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                        <button type="submit" id="updateSection"  class="btn btn-success">{{trans('main_trans.Update')}}</button>
                                      </div>
                                  </form>
                                    </div>
                                  </div>
                                </div>

                                {{-- end section modal --}}
                
              
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-backdrop="false"
                                data-target="#deleteSectionModal{{ $section->id }}"
                                title="{{ trans('main_trans.Delete') }}"><i
                                class="fa fa-trash"></i></button>
                         {{-- start delete modal --}}
                                <div class="modal fade" id="deleteSectionModal{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">{{trans('sections.delete_Section')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" id="deleteSection" section_id={{$section->id}} grade_id={{$section->grade_id}} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
                                {{-- end delete modal --}}
                    </td>
                    
                  </tr>
                  @endforeach
  
                </tbody>
              </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>  
          </div>
        </div>
      </div>   
    </div>
<!-- row closed -->
@endsection
@section('js')
@include('sections.scripts.storesection')
 @include('sections.scripts.updatesection')
 @include('sections.scripts.deletesection')
@endsection

