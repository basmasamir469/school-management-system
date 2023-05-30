<script type="text/javascript">
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
    $(document).on('change', '#filter_grades', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var selected_grade=$('#filter_grades').val()
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url:"{{ route('GradeClasses.filterGrade') }}",
           data:{'selected_grade':selected_grade,
            __token:'{{csrf_token()}}'} ,
           success:function(data){
                if(data.status===true){
                 console.log(data.data.data)
                 $('#classTable').empty()
                 if(data.data.data.length==0){
                    $('#classTable').append('<tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">{{trans("main_trans.No data is found")}}</td></tr>')
                 }
                 else{
                 for(var [i,d] of data.data.data.entries()){
                 $('#classTable').append(`<tr id="grade_class${d.id}">
                    <td><div class="form-check pb-3">
                      <input class="form-check-input" name="grade_classes" type="checkbox" grade_class=${d.id}  id="gridCheck1">
                    </div></td>
                  <td>${++i}</td>
                  <td>${d.class_name}</td>
                  <td>${d.grade_name}</td>
                   <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                              data-target="#editClassModal${d.id}"
                              title="{{__('main_trans.Edit')}}"><i
                              class="fa fa-edit"></i></button>
                  
                              <div class="modal fade" id="editClassModal${d.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{trans('classes.edit_class')}}</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                                  <form method="post" class="editClassForm">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                      <input type="hidden" name="id" value=${d.id}>
                                      <div class="col-sm-6 mb-3">
                                        <h5 class="form-label" for="">{{trans('classes.Name_class')}}</h5>
                                        <input type="text" class="form-control mb-3" name="class_name_ar" value="${d.class_name_ar}">
                                        <small id="class_name_ar_error_edit"  class="form-text text-danger"></small>
                                      </div>
                                      <div class="col-sm-6 mb-3">
                                        <h5 class="form-label" for="">{{trans('classes.Name_class_en')}}</h5>
                                        <input type="text" class="form-control mb-3" name="class_name_en" value="${d.class_name_en}">
                                        <small id="class_name_en_error_edit" class="form-text text-danger"></small>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="box mb-3 col-md-8">
                                        <h5 class="form-label" for="">{{trans('classes.Name_Grade')}}</h5>
                                            <select class="fancyselect" name="grade_id">
                                              <option value="">{{__('classes.Name_Grade')}}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}" {{ ('${d.grade_id}'==$grade->id)?'selected':''}}  >{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                            <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                          <button type="button" id="updateClass" gclass_id=${d.id} class="btn btn-success">{{trans('main_trans.Update')}}</button>
                        </div>
                    </form>
                      </div>
                    </div>
                  </div>

                      
                       <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                               data-target="#deleteClassModal${d.id}"
                              title="{{__('main_trans.Delete')}}"><i
                              class="fa fa-trash"></i></button>
                              <div class="modal fade" id="deleteClassModal${d.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
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
                        <button type="button" id="deleteClass" gclass_id=${d.id} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                      </div>
                    </div>
                  </div>
                </div> 
                   </td>
                  </tr>`)
                 }
                }
                }
                else if(data.status===false){
                  }
           },
           error:function(reject){
           }
})
})
</script>
