<script>
$(document).on('click', '#graduateStudent', function (e) {
       e.preventDefault();
       var student_id=$(this).attr('student_id')
       var url = "{{ route('Promotions.graduate', ":id") }}";
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
                 $(`#graduateStudent${student_id}`).modal('hide');
                   swal(data.msg,"","success");
                   window.location=data.route
                }
                else if(data.status===false){
                  $(`#graduateStudent${student_id}`).modal('hide');
                  swal(data.msg,"", "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>