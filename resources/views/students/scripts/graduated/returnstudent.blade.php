<script>
$(document).on('click', '#returnStudent', function (e) {
       e.preventDefault();
       var student_id=$(this).attr('student_id')
       var url = "{{ route('Graduated.edit', ":id") }}";
           url = url.replace(':id', student_id);
       $.ajax({
           type: 'get',
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
                 $(`#returnStudent${student_id}`).modal('hide');
                   swal(data.msg,"","success");
                 $(`tbody#graduatedTable tr#graduated${student_id}`).remove()
                }
                else if(data.status===false){
                  $(`#returnStudent${student_id}`).modal('hide');
                  swal(data.msg,"", "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>