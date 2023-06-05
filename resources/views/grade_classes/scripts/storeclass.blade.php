<script type="text/javascript">
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
    $(document).on('click', '#storeGradeClass', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
    var formData1 = $('.repeaterr').repeaterVal();
    var formData = new FormData();

    formData.append('data',JSON.stringify(formData1));
    console.log(formData)
     var count=$(this).attr('count_classes')
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('GradeClasses.store')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                $('#storeClassModal').modal('hide');
                $('#storeClassForm input').val('')
                $('#storeClassForm select.custom-select').val('')
                 $('#storeClassForm select.fancyselect option[value=""]').prop('selected',true)
                 $('#storeClassForm div.fancyselect').next(".current").text("{{__('classes.Name_Grade')}}")
                $.each(document.querySelectorAll("#storeClassForm small[id$=_error]"),function(key,val){
                  val.textContent=''
                })
                swal("{{__('main_trans.Data has been saved successfully!')}}","", "success");
                 console.log(data)
                 for(var d of data.data){
                  // var name=lang=='en'?d.class_name_en:d.class_name_ar
                 $('#classTable').append(`<tr id="grade_class${d.id}">
                  <td><div class="form-check pb-3">
                      <input class="form-check-input" name="grade_classes" type="checkbox" grade_class=${d.id}  id="gridCheck1">
                    </div></td>
                  <td>${++count}</td>
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
                        <form method="post" class="editClassForm" gclass_id=${d.id}>
                                    @csrf
                                    @method('PATCH')
                        <div class="modal-body">
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
                                            <select class="form-control fancy-select" name="grade_id">
                                              <option value="">{{__('classes.Name_Grade')}}</option>
                                                @foreach ($grades as $grade)
                                                    <option value="{{ $grade->id }}" ${d.grade_id=="{{$grade->id}}"?'selected':''} >{{ $grade->name }}</option>
                                                @endforeach
                                            </select>
                                            <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                        </div>
                                    </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                          <button type="submit" id="updateClass" class="btn btn-success">{{trans('main_trans.Update')}}</button>
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
                else if(data.status===false){
                 $('#storeClassModal').modal('show');
                  }
           },
           error:function(reject){
             $.each(document.querySelectorAll("#storeClassForm small[id$=_error]"),function(key,val){
                 val.textContent=''
             })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors)
             $.each(response.errors,function(key,val){
             $("#storeClassForm input,#storeClassForm select").each(function() {
                var rep_name=$(this).attr("name");
                var rep=rep_name?'data.'+rep_name.replace('[',".").replace('][',".").replace(']',''):null;
                if(rep==key){
                  if($(this)[0].nodeName=="SELECT"){
                    $(this).next('div').next('small').text(val[0]);
                }else{
                  $(this).next('small').text(val[0]);
                }
                }
                  });
              // $index=$('small').closest("[data-repeater-item]").index()
             })
           }
})
})
</script>
