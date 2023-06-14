<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
    $(document).on('submit', '.editClassForm', function (e) {
       e.preventDefault();
       $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      var formData = new FormData( $(this)[0]);
      console.log(formData)
       var gclass_id=$(this).attr('gclass_id')
       var url = "{{ route('GradeClasses.update', ":id") }}";
           url = url.replace(':id', gclass_id);
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
                 $(`#editClassModal${gclass_id}`).modal('hide');
                   swal( "{{trans('main_trans.It updated successfully!')}}","", "success");
                   $.each(document.querySelectorAll(`[id$=_error_edit${gclass_id}]`),function(key,val){
                val.textContent=''
                  })
                 $(`#classTable tr#grade_class${gclass_id} td:eq(2)`).text(data.data.class_name)
                 $(`#classTable tr#grade_class${gclass_id} td:eq(3)`).text(data.data.grade_name)
                }
                else if(data.status===false){
                 $(`#editClassModal${gclass_id}`).modal('show');
                  }
           },
           error:function(reject){
            $.each(document.querySelectorAll(`small[id$=_error_edit${gclass_id}]`),function(key,val){
                val.textContent=''
            })
             var response=$.parseJSON(reject.responseText)
             console.log(response.errors);
             $.each(response.errors,function(key,val){
               $(`#${key}_error_edit${gclass_id}`).text(val[0])
             })
           }
})
})
</script>