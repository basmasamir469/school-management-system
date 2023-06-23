<script>
$(document).on('click', '#deleteAttachment', function (e) {
       e.preventDefault();
       var attachment_id=$(this).attr('attachment_id')
       var attachment_name=$(this).attr('attachment_name')
       var student_name=$(this).attr('student_name')
       var url = "{{ route('Students.delete-attachments') }}";
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },data:{
           id:attachment_id,
           file_name:attachment_name,
           student_name:student_name,
           },
           success:function(data){
            console.log(data.data)
                if(data.status===true){
               $(`#attachmentsTable tr#attachment${attachment_id}`).hide()
                  swal(data.msg,"","success");
                 $(`#deleteAttachment${attachment_id}`).modal('hide');
                }
                else if(data.status===false){
                  $(`#deleteAttachment${attachment_id}`).modal('hide');
                  swal(data.msg,"", "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>