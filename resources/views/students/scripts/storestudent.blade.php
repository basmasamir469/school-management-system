<script>
$(document).on('click', '#storeStudent', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
       var formData = new FormData($('#studentForm')[0]);
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Students.store')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
              window.location=data.route
                 swal("{{__('main_trans.Data has been saved successfully!')}}","", "success");
                }
                else if(data.status===false){
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

$(document).on('change', '#student_grades', function (e) {
  e.preventDefault();
     var grade_id=$(this).val()
       var url = "{{ route('Grades.get_classes', ":id") }}";
           url = url.replace(':id', grade_id);
      $.ajax({
           type: 'get',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
                 var classes=data.data.data
                 $('select#student_classes').empty()
                 $('select#student_classes').append(`<option value="" selected>{{__('Parent_trans.Choose')}}</option>`)
                 for(var d of classes){
                  $('select#student_classes').append(`<option value=${d.id}>${d.class_name}</option>`)
                 }
                }
                else if(data.status===false){
                  }
           },
           error:function(reject){
           }
})


})

$(document).on('change', '#student_classes', function (e) {
  e.preventDefault();
     var grade_id=$(this).val()
     var lang=$(location).attr('href').includes('ar')?'ar':'en';
       var url = "{{ route('GradeClasses.get_sections', ":id") }}";
           url = url.replace(':id', grade_id);
      $.ajax({
           type: 'get',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
                 var sections=data.data
                 $('select#student_sections').empty()
                 $('select#student_sections').append(`<option value="" selected>{{__('Parent_trans.Choose')}}</option>`)
                 for(var d of sections){
                  $('select#student_sections').append(`<option value=${d.id}>${lang=='ar'?d.section_name.ar:d.section_name.en}</option>`)
                 }
                }
                else if(data.status===false){
                  }
           },
           error:function(reject){
           }
})


})


</script>