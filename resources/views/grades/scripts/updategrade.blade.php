<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('submit', '.editGradeForm', function (e) {
       e.preventDefault();
       $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
       var formData = new FormData($(this)[0]);
       console.log(formData)
       var grade_id=$(this).attr('grade_id')
       var url = "{{ route('Grades.update', ":id") }}";
           url = url.replace(':id', grade_id);
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
                 $(`#edit${grade_id}`).modal('hide');
                 if(lang=='en'){
                   swal("Done!", "It updated successfully!", "success");
                   var name=data.data.name.en
                 }else{
                   swal("حسنا!", "!تم تعديل البيانات بنجاح", "success");
                   var name=data.data.name.ar
                 }
                 $(`#gradeTable tr#grade${grade_id} td:eq(1)`).text(name)
                 $(`#gradeTable tr#grade${grade_id} td:eq(2)`).text(data.data.notes?data.data.notes:'')
                }
                else if(data.status===false){
                 $(`#edit${grade_id}`).modal('show');
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