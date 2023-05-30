@extends('layouts.master')
@section('css')
<style>
.nice-select{
float:unset !important;
}
</style>
@section('title')
{{trans('classes.Classes')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h2 class="mb-0">{{trans('classes.Classes')}}</h2>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{__('grades.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('classes.Classes')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row mb-40">
      <div class="col-xl-12 mb-30">
        <button type="button" class="btn btn-success btn-lg mb-3 w-25" style="background-color: #28a745 important!" data-toggle="modal" data-target="#storeClassModal">
            {{trans('classes.add_class')}}
          </button>
          <button type="button" class="btn btn-danger btn-lg mb-3 w-10" id="delete_classes">
            {{trans('classes.delete_checked_rows')}}
          </button> 

          <div class="row mb-3">
            <div class="col-5">
                <div class="box">
                    <select class="fancyselect bg-white" id="filter_grades" name="grade_id">
                      <option value="">{{__('classes.Name_Grade')}}</option>
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
          </div>

             {{-- start store modal --}}
          <div class="modal fade" id="storeClassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                          {{ trans('classes.add_class') }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                    <form class=" row mb-30">
                          <div class="card-body">
                              <div class="repeater">
                                  <div class="repeaterr" id="storeClassForm" data-repeater-list="classes_list">
                                      <div data-repeater-item>
                                          <div class="row mb-20">
      
                                              <div class="col-3">
                                                  <input class="form-control" type="text" name="class_name_ar" placeholder="{{__('classes.Name_class')}}" />
                                                  <small id="class_name_ar_error" name="class_name_ar_error"  class="form-text text-danger"></small>

                                              </div>
      
      
                                              <div class="col-3">
                                                  <input class="form-control" type="text" name="class_name_en" placeholder="{{__('classes.Name_class_en')}}" />
                                                  <small id="class_name_en_error" name="class_name_en_error" class="form-text text-danger"></small>
                                              </div>
      
      
                                              <div class="col-3">      
                                                  <div class="box">
                                                      <select class="fancyselect" name="grade_id">
                                                        <option value="">{{__('classes.Name_Grade')}}</option>
                                                          @foreach ($grades as $grade)
                                                              <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                                          @endforeach
                                                      </select>
                                                      <small id="grade_id_error" name="grade_id_error"  class="form-text text-danger"></small>
                                                  </div>
      
                                              </div>
      
                                              <div class="col-3">
                                                  <button class="btn btn-danger btn-block" data-repeater-delete
                                                      type="button">{{ trans('classes.delete_row') }}</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="row mt-20">
                                      <div class="col-12">
                                          <input class="button" data-repeater-create type="button" value="{{ trans('classes.add_row') }}"/>
                                      </div>
      
                                  </div>
      
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary"
                                          data-dismiss="modal">{{ trans('main_trans.Close') }}</button>
                                      <button type="button"
                                        id="storeGradeClass"
                                         count_classes={{count($grade_classes)}}
                                          class="btn btn-success">{{ trans('main_trans.Submit') }}</button>
                                  </div>
      
      
                              </div>
                          </div>
                      </form>
                  </div>
      
      
              </div>
      
          </div>
      
      </div>
      {{-- end store modal --}}
  <div class="card card-statistics h-100">
        <div class="card-body">
          <div class="table-responsive">
          <table id="datatable" class="table table-striped table-bordered p-0 text-center">
            <thead>
                <tr>
                  <th>
                    <div class="form-check pb-3">
                    <input class="form-check-input" type="checkbox" id="checkAll">
                    </div></th>
                    <th>#</th>
                    <th>{{trans('classes.Class name')}}</th>
                    <th>{{trans('classes.Name_Grade')}}</th>
                    <th>{{trans('grades.Actions')}}</th>
                </tr>
            </thead>
            <tbody id="classTable">
                @foreach($grade_classes as $gclass)
                <tr id="grade_class{{$gclass->id}}">
                    <td><div class="form-check pb-3">
                      <input class="form-check-input" name="grade_classes" type="checkbox" grade_class={{$gclass->id}}  id="gridCheck1">
                    </div></td>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$gclass->class_name}}</td>
                    <td>{{$gclass->grade?->name}}</td>
                    <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                              data-target="#editClassModal{{ $gclass->id }}"
                              title="{{ trans('main_trans.Edit') }}"><i
                              class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                              data-target="#deleteClassModal{{ $gclass->id }}"
                              title="{{ trans('main_trans.Delete') }}"><i
                              class="fa fa-trash"></i></button>
                  </td>
                </tr>
                {{-- edit Modal --}}
                <div class="modal fade" id="editClassModal{{$gclass->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{trans('classes.edit_class')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" class="editClassForm" gclass_id={{$gclass->id}}>
                          @csrf
                          @method('PATCH')
                        <div class="modal-body">
                                    <div class="row">
                                      <input type="hidden" name="id" value="{{$gclass->id}}">
                                      <div class="col-sm-6 mb-3">
                                        <h5 class="form-label" for="">{{trans('classes.Name_class')}}</h5>
                                        <input type="text" class="form-control mb-3" name="class_name_ar" value="{{$gclass->getTranslation('class_name','ar')}}">
                                        <small id="class_name_ar_error_edit"  class="form-text text-danger"></small>
                                      </div>
                                      <div class="col-sm-6 mb-3">
                                        <h5 class="form-label" for="">{{trans('classes.Name_class_en')}}</h5>
                                        <input type="text" class="form-control mb-3" name="class_name_en" value="{{$gclass->getTranslation('class_name','en')}}">
                                        <small id="class_name_en_error_edit" class="form-text text-danger"></small>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="box mb-3 col-md-8">
                                        <h5 class="form-label" for="">{{trans('classes.Name_Grade')}}</h5>
                                            <select class="fancyselect" name="grade_id">
                                              <option value="">{{__('classes.Name_Grade')}}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}" @if($gclass->grade_id==$grade->id) selected @endif>{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                            <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                          <button type="submit" id="updateClass" gclass_id={{$gclass->id}}  class="btn btn-success">{{trans('main_trans.Update')}}</button>
                        </div>
                    </form>
                      </div>
                    </div>
                  </div>
  
                {{-- end edit Modal --}}

                {{-- deleteModal --}}

                 <div class="modal fade" id="deleteClassModal{{$gclass->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{trans('classes.delete_class')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="deleteClass" gclass_id={{$gclass->id}} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                      </div>
                    </div>
                  </div>
                </div> 
                {{-- end deleteModal --}}
                @endforeach

                {{-- delete checked classes modal --}}
                <div class="modal fade" id="deleteCheckedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">{{trans('classes.delete_checked_rows')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>{{trans('classes.Warning_class')}}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="delete_checked"  class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                      </div>
                    </div>
                  </div>
                </div> 
                {{-- end delete checked classes modal --}}
            </tbody>
            <tfoot>
                <tr>
                    <th>#</th>
                    <th>{{trans('classes.Class name')}}</th>
                    <th>{{trans('classes.Name_Grade')}}</th>
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
 @include('grade_classes.scripts.storeclass') 
 @include('grade_classes.scripts.updateclass')
 @include('grade_classes.scripts.deleteclass')
 @include('grade_classes.scripts.filter')
@endsection
