<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('click', '#deleteClass', function (e) {
       e.preventDefault();
       var gclass_id=$(this).attr('gclass_id')
       var url = "{{ route('GradeClasses.destroy', ":id") }}";
           url = url.replace(':id', gclass_id);
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
                 $(`#deleteClassModal${gclass_id}`).modal('hide');
                 if(lang=='en'){
                   swal(data.msg,"","success");
                 }else{
                   swal(data.msg,"", "success");
                 }
                 $(`#classTable tr#grade_class${gclass_id}`).remove()
                }
                else if(data.status===false){
                  swal(data.msg, "error");
                  }
           },
           error:function(reject){
           }
})
})

$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});


$("#delete_classes").click(function(){
  if($('input[name="grade_classes"]:checked').length > 0){
        $("#deleteCheckedModal").modal('show')
  }
});

$(document).on('click', '#delete_checked', function (e) {
       e.preventDefault();
      var classes_ids=[];
      $('input[name="grade_classes"]:checked').each(function(){
        classes_ids.push($(this).attr('grade_class'))
      })
      $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url:"{{route('GradeClasses.deleteChecked')}}",
           data:{
            'checked_rows':JSON.stringify(classes_ids),
            __token:'{{csrf_token()}}'
          },
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
           success:function(data){
            console.log(data.data)
                if(data.status===true){
                 $(`#deleteCheckedModal`).modal('hide');
                   swal(data.msg,"","success");
                 for(var id of classes_ids)
                $(`#classTable tr#grade_class${id}`).remove()
                }
                else if(data.status===false){
                  swal(data.msg, "error");
                  }
           },
           error:function(reject){
           }
})


})

</script>