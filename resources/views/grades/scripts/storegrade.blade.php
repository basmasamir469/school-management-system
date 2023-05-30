<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('click', '#storeGrade', function (e) {
       e.preventDefault();
       var formData = new FormData($('#gradeForm')[0]);
       var count=$(this).attr('count_grades')
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Grades.store')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                 $('#exampleModal').modal('hide');
                 $('#gradeForm input').val('')
                 $('#gradeForm textarea').val('')
                 if(lang=='en'){
                   swal("Done!", "It saved successfully!", "success");
                   var name=data.data.name.en
                 }else{
                   swal("حسنا!", "!تم حفظ البيانات بنجاح", "success");
                   var name=data.data.name.ar
                 }
                 console.log(data.data)
                $('#gradeTable').append(`<tr id="grade${data.data.id}">
                 <td>${++count}</td>
                 <td>${name}</td>
                 <td>${data.data.notes?data.data.notes:''}</td>
                 <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                              data-target="#edit${data.data.id}"
                              title="${lang=='en'?'Edit':'تعديل'}"><i
                              class="fa fa-edit"></i></button>
                      
                              <div class="modal fade" id="edit${data.data.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">${lang=='en'?'Edit Grade':'تعديل مرحلة'}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                                <form method="post" id="editGradeForm" grade_id=${data.data.id}>
                                  @csrf
                                  @method('Patch')
                                  <div class="row">
                                    <div class="col-sm-6 mb-3">
                                      <h5 class="form-label" for="">${lang=='en'?'Stage-in-english':'اسم المرحلة بالانجليزية'}</h5>
                                      <input type="text" class="form-control mb-3" name="name[ar]" value="${data.data.name.ar}">
                                      <small id="name.ar_error_edit"  class="form-text text-danger"></small>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                      <h5 class="form-label" for="">${lang=='en'?'Stage-in-arabic':'اسم المرحلة بالعربية'}</h5>
                                      <input type="text" class="form-control mb-3" name="name[en]" value="${data.data.name.en}">
                                      <small id="name.en_error_edit" class="form-text text-danger"></small>
                                    </div>
                                  </div>
                                  <div class="row">
                                    <div class="mb-3 col-md-12">
                                      <h5 class="form-label" for="">${lang=='en'?'Notes':'ملاحظات'}</h5>
                                      <textarea class="form-control mb-3" name="notes" id="" cols="30" rows="5">${data.data.notes?data.data.notes:''}</textarea>
                                    </div>
                                  </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">${lang=='en'?'Close':'اغلاق'}</button>
                        <button type="submit" id="updateGrade"  class="btn btn-success">${lang=='en'?'Update':'تعديل'}</button>
                      </div>
                  </form>
                    </div>
                  </div>
                </div>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                              data-target="#delete${data.data.id}"
                              title="${lang=='en'?'Delete':'حذف'}"><i
                              class="fa fa-trash"></i></button>
               <div class="modal fade" id="delete${data.data.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">

                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">${lang=='en'?'Delete Grade':'حذف المرحلة'}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>${lang=='en'?'Are you sure to delete this row?':'هل انت متاكد من حذف هذا الصف؟'}</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" id="deleteGrade" grade_id=${data.data.id} class="btn btn-danger">${lang=='en'?'Delete':'حذف'}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">${lang=='en'?'Close':'اغلاق'}</button>
                      </div>
                    </div>
                  </div>
                </div>
                  </td>
                 </tr>`)
                }
                else if(data.status===false){
                 $('#exampleModal').modal('show');
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
</script>