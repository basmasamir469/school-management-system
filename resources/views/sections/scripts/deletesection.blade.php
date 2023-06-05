<script>
    var lang=$(location).attr('href').includes('ar')?'ar':'en';
$(document).on('click', '#deleteSection', function (e) {
       e.preventDefault();
       var section_id=$(this).attr('section_id')
       var grade_id=$(this).attr('grade_id')
       var url = "{{ route('Sections.destroy', ":id") }}";
           url = url.replace(':id', section_id);
       $.ajax({
           type: 'delete',
           enctype: 'multipart/form-data',
           url: url,
           headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
           success:function(data){
                if(data.status===true){
                 $(`#deleteSectionModal${section_id}`).modal('hide');
                   swal("{{__('main_trans.data deleted successfully')}}","","success");
                 $(`#gradeTable${grade_id} tr#section${section_id}`).remove()
                }
                else if(data.status===false){
                  $(`#deleteSectionModal${section_id}`).modal('hide');
                  swal(data.msg,"", "");
                  }
           },
           error:function(reject){
           }
})
})
</script>