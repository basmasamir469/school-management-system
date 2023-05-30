<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('click', '#deleteGrade', function (e) {
       e.preventDefault();
       var grade_id=$(this).attr('grade_id')
       var url = "{{ route('Grades.destroy', ":id") }}";
           url = url.replace(':id', grade_id);
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
                 $(`#delete${grade_id}`).modal('hide');
                 if(lang=='en'){
                   swal("Done!",data.msg,"success");
                 }else{
                   swal("حسنا!",data.msg, "success");
                 }
                 $(`#gradeTable tr#grade${grade_id}`).remove()
                }
                else if(data.status===false){
                  $(`#delete${grade_id}`).modal('hide');
                  swal("",data.msg, "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>