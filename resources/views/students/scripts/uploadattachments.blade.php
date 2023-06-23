<script>
$(document).on('submit', '#storeAttachments', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
       var formData = new FormData($(this)[0]);
       var count=$(this).attr('count-attachments')
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Students.upload-attachments')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
                 var images=data.data
                 swal("{{__('main_trans.Data has been saved successfully!')}}","", "success");
                 $('input[name="photos[]"]').val('')
                 for(var i of images){
                 $('#attachmentsTable').append(`<tr id="attachment${i.id}" style='text-align:center;vertical-align:middle'>
                 <td>${++count}</td>
                 <td>${i.file_name}</td>
                 <td>${i.created_at}</td>
                 <td colspan="2">
                                                       <a class="btn btn-outline-info btn-sm"
                                                       href="{{url('Students/download/attachments')}}/${i.file_name}/${i.student_name}"
                                                         role="button"><i class="fa fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}</a> 

                                                      <button type="button" class="btn btn-outline-danger btn-sm"
                                                              data-toggle="modal"
                                                              data-target="#deleteAttachment${i.id}"
                                                              title="{{ trans('Grades_trans.Delete') }}">{{trans('main_trans.Delete')}}
                                                      </button> 
                                                      <div class="modal fade" id="deleteAttachment${i.id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title">{{trans('Students_trans.Delete_attachment')}}</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p>{{trans('main_trans.Are you sure to delete this row?')}}</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" id="deleteAttachment" attachment_id=${i.id} attachment_name="${i.file_name}" student_name="${i.student_name}" class="btn btn-danger">{{trans('main_trans.Delete')}}</button>
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('main_trans.Close')}}</button>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                  </td>`)
                }
                }
                else if(data.status===false){
                  swal("{{__('main_trans.failed to save')}}","", "error");
                  }
           },
           error:function(reject){
            $.each(document.querySelectorAll("[id$=_error]"),function(key,val){
                val.textContent=''
            })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors);
             $.each(response.errors,function(key,val){
               $(`#${key}_error`).text(val[0])
             })
           }
})
})




</script>