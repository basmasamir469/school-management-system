<script>
$(document).on('click', '#deleteTeacher', function (e) {
       e.preventDefault();
       var teacher_id=$(this).attr('teacher_id')
       var url = "{{ route('Teachers.destroy', ":id") }}";
           url = url.replace(':id', teacher_id);
       $.ajax({
           type: 'delete',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
            console.log(data.data)
                if(data.status===true){
                 $(`#delete${teacher_id}`).modal('hide');
                   swal(data.msg,"","success");
                 $(`#gradeTable tr#teacher${teacher_id}`).remove()
                }
                else if(data.status===false){
                  $(`#delete${teacher_id}`).modal('hide');
                  swal(data.msg,"", "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>