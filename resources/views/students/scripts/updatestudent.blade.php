<script>
$(document).on('submit', '.editStudentForm', function (e) {
       e.preventDefault();
       $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
       var formData = new FormData($(this)[0]);
       console.log(formData)
       var student_id=$(this).attr('student_id')
       var url = "{{ route('Students.update', ":id") }}";
           url = url.replace(':id', student_id);
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
                if(data.status===true){
                   swal("{{__('main_trans.It updated successfully!')}}","", "success");
                   window.location=data.route
                }
                else if(data.status===false){
                  }
           },
           error:function(reject){
            $.each(document.querySelectorAll("[id$=_error_edit]"),function(key,val){
                val.textContent=''
            })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors);
             $.each(response.errors,function(key,val){
               document.getElementById(`${key}_error_edit`).textContent=val[0]
             })
           }
})
})
</script>