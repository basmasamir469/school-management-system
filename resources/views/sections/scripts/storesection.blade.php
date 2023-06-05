<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('submit', '#storeSectionForm', function (e) {
       e.preventDefault();
       var formData = new FormData($(this)[0]);
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Sections.store')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                 $('#storeSectionModal').modal('hide');
                 $('#storeSectionForm input:not(input[type=checkbox])').val('')
                 $('#storeSectionForm textarea').val('')
                 $('#storeSectionForm #select_grade').val('')
                 $('#storeSectionForm input.teachers').prop('checked',false)
                 $('#storeSectionForm select#grade_classes').empty('')
                 swal("{{__('main_trans.Data has been saved successfully!')}}","", "success");
                var badge=data.data.status==1?`<span class="badge badge-success">{{trans('sections.Status_Section_AC')}}</span>`:`<span class="badge badge-danger">{{trans('sections.Status_Section_No')}}</span>`                    
                 console.log(data.data)
                 var array_teachers=Object.keys(data.data.teachers).map(function(key) {
                                                            return data.data.teachers[key]['id']
                                                       });
                 $(`#group${data.data.grade_id} table.sections-table tbody`).append(`
                 <tr id="section${data.data.id}">
                      <td>${data.data.sections_count}</td>
                      <td>${data.data.section_name}</td>
                      <td>${data.data.class_name}</td>
                      <td>${badge}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false"
                                data-target="#editSectionModal${data.data.id}"
                                title="{{ trans('main_trans.Edit') }}"><i
                                class="fa fa-edit"></i></button>

                                <div class="modal fade" id="editSectionModal${data.data.id}" tabindex="-1"   role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('classes.edit_class')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="post" class="editSectionForm" section_id=${data.data.id} grade_id=${data.data.grade_id}>
                                        @csrf
                                        @method('PATCH')
                                      <div class="modal-body">
                                                  <div class="row">
                                                    <input type="hidden" name="id" value=${data.data.id}>
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('classes.Name_class')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name[ar]" value=${data.data.section_name_ar}>
                                                      <small id="section_name.ar_error_edit"  class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('classes.Name_class_en')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name[en]" value=${data.data.section_name_en}>
                                                      <small id="section_name.en_error_edit" class="form-text text-danger"></small>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('classes.Name_Grade')}}</h5>
                                                          <select class="custom-select" id="select_grade" name="grade_id">
                                                            <option value="">{{__('classes.Name_Grade')}}</option>
                                                              @foreach ($grades as $grade)
                                                                  <option value="{{ $grade->id }}" ${"{{$grade->id}}"==data.data.grade_id?'selected':''}>{{ $grade->name }}</option>
                                                              @endforeach
                                                          </select>
                                                          <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('sections.Name_Class')}}</h5>
                                                        <select class="custom-select" id="grade_classes" name="gradeClass_id">
                                                          <option value=${data.data.gradeClass_id}>${data.data.class_name}</option>
                                                        </select>
                                                        <small id="gradeClass_id_error_edit" name="gradeClass_id_error"  class="form-text text-danger"></small>
                                                    </div>
                                                  </div>

                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('main_trans.Teachers')}}</h5>
                                                      @foreach ($teachers as $teacher)
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="teachers[]" value="{{$teacher->id}}" id="flexCheckDefault{{$teacher->id}}" ${array_teachers.includes({{$teacher->id}})?'checked':''} >
                                                        <label class="form-check-label" for="flexCheckDefault{{$teacher->id}}">
                                                          {{$teacher->name}}
                                                        </label>
                                                      </div>
                                                      @endforeach
                                                        <small id="teachers_error_edit"   class="form-text text-danger"></small>
                                                    </div>
                                                  </div> 

                              
                                                  <div class="row">
                                                    <div class="col-6">
                                                      <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked"  ${data.data.status==1?'checked':''}>
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
                                

                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-backdrop="false" 
                                data-target="#deleteSectionModal${data.data.id}" 
                                title="{{ trans('main_trans.Delete') }}"><i
                                class="fa fa-trash"></i></button>


                                <div class="modal fade" id="deleteSectionModal${data.data.id}"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
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
                                        <button type="button" id="deleteSection" section_id=${data.data.id} grade_id=${data.data.grade_id} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
                    </td>
                  </tr>
                 `)
                }
                else if(data.status===false){
                 $('#storeSectionModal').modal('show');
                  }
           },
           error:function(reject){
            $.each(document.querySelectorAll("[id$=_error]"),function(key,val){
                val.textContent=''
            })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors);
             $.each(response.errors,function(key,val){
               document.getElementById(`${key}_error`).textContent=val[0]
               // $(document).find('input[name='+key+']').after('<span class="text-strong text-danger">' +val[0]+ '</span>')

             })
           }
})
})
$(document).on('change', '#select_grade', function (e) {
  e.preventDefault();
     var grade_id=$(this).val()
       var url = "{{ route('Grades.get_classes', ":id") }}";
           url = url.replace(':id', grade_id);
      $.ajax({
           type: 'get',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
                 var classes=data.data.data
                 $('select#grade_classes').empty()
                 for(var d of classes){
                  $('select#grade_classes').append(`<option value=${d.id}>${d.class_name}</option>`)
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
