<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('submit', '.editSectionForm', function (e) {
       e.preventDefault();
       $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
     var id=$(this).attr('id')
       var formData = new FormData($(this)[0]);
       console.log(formData)
       var sectionForm=$(this)
       var section_id=$(this).attr('section_id')
       var grade_id=$(this).attr('grade_id')
       var url = "{{ route('Sections.update', ":id") }}";
           url = url.replace(':id', section_id);
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: url,
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
            console.log(data.data)
            var section=data.data
            var array_teachers=Object.keys(section.teachers).map(function(key) {
                                                            return section.teachers[key]['id']
                                                       });
            var badge=section.status==1?`<span class="badge badge-success">{{trans('sections.Status_Section_AC')}}</span>`:`<span class="badge badge-danger">{{trans('sections.Status_Section_No')}}</span>`                    
                if(data.status===true){
                 $(`#editSectionModal${section.id}`).modal('hide');
                   swal("{{__('main_trans.It updated successfully!')}}","", "success");
                   $('body').removeClass("modal-open");
                   if(grade_id != section.grade_id){
                    $(`#gradeTable${grade_id} tr#section${section.id}`).remove()
                    $(`#gradeTable${section.grade_id}`).append(`
                 <tr id="section${section.id}">
                      <td>${section.sections_count}</td>
                      <td>${section.section_name}</td>
                      <td>${section.class_name}</td>
                      <td>${badge}</td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-backdrop="false" 
                                data-target="#editSectionModal${section.id}"
                                title="{{ trans('main_trans.Edit') }}"><i
                                class="fa fa-edit"></i></button>
                        
                                <div class="modal fade" id="editSectionModal${section.id}"   tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{trans('sections.edit_Section')}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <form method="post" class="editSectionForm" id="sectionForm${section.id}" section_id=${section.id} grade_id=${section.grade_id}>
                                        @csrf
                                        @method('PATCH')
                                      <div class="modal-body">
                                                  <div class="row">
                                                    <input type="hidden" name="id" value=${section.id}>
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('sections.Section_name_ar')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name_ar" value=${section.section_name_ar}>
                                                      <small id="section_name_ar_error_edit"  class="form-text text-danger"></small>
                                                    </div>
                                                    <div class="col-sm-6 mb-3">
                                                      <h5 class="form-label" for="">{{trans('sections.Section_name_en')}}</h5>
                                                      <input type="text" class="form-control mb-3" name="section_name_en" value=${section.section_name_en}>
                                                      <small id="section_name_en_error_edit" class="form-text text-danger"></small>
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('classes.Name_Grade')}}</h5>
                                                          <select class="custom-select" id="select_grade" name="grade_id">
                                                            <option value="">{{__('classes.Name_Grade')}}</option>
                                                              @foreach ($grades as $grade)
                                                                  <option value="{{ $grade->id }}" ${"{{$grade->id}}"==section.grade_id?'selected':''}>{{ $grade->name }}</option>
                                                              @endforeach
                                                          </select>
                                                          <small id="grade_id_error_edit" name="grade_id_error_edit"  class="form-text text-danger"></small>
                                                      </div>
                                                  </div>
                                                  <div class="row">
                                                    <div class="mb-3 col-md-8">
                                                      <h5 class="form-label" for="">{{trans('sections.Name_Class')}}</h5>
                                                        <select class="custom-select" id="grade_classes" name="gradeClass_id">
                                                          <option value=${section.gradeClass_id}>${section.class_name}</option>
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
                                                        <input class="form-check-input" type="checkbox" name="status" id="flexCheckChecked"  ${section.status==1?'checked':''}>
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
                                data-target="#deleteSectionModal${section.id}"
                                title="{{ trans('main_trans.Delete') }}"><i
                                class="fa fa-trash"></i></button>


                                <div class="modal fade" id="deleteSectionModal${section.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
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
                                        <button type="button" id="deleteSection" section_id=${section.id} grade_id=${section.grade_id} class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                      </div>
                                    </div>
                                  </div>
                                </div> 
                    </td>
                  </tr>
                 `)
                   }else{
                 $(`#gradeTable${section.grade_id} tr#section${section.id} td:eq(1)`).text(section.section_name)
                 $(`#gradeTable${section.grade_id} tr#section${section.id} td:eq(2)`).text(section.class_name)
                 $(`#gradeTable${section.grade_id} tr#section${section.id} td:eq(3)`).html(badge)
                }
                }
                else if(data.status===false){
                 $(`#editSectionModal${section.id}`).modal('show');
                  }
           },
           error:function(reject){
            $.each(document.querySelectorAll("[id$=_error_edit]"),function(key,val){
                val.textContent=''
            })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors);
             $.each(response.errors,function(key,val){
               $(`#${id} #${key}_error_edit`).text(val[0])
             })
           }
})
})
</script>