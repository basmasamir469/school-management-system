<script>
$(document).on('submit', '#deletePromotions', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
      var formData=new FormData($(this)[0]);

       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Promotions.destroy')}}",
           data: formData,
           processData: false,
           contentType: false,
           cache: false,
           success:function(data){
                if(data.status===true){
                 console.log(data.data)
                 $(`#deleteAllPromotions`).modal('hide');
                 swal("{{__('main_trans.data deleted successfully')}}","", "success");
                 $('tbody#promotions').empty();
                 $('tbody#promotions').append('<tr class="odd"><td valign="top" colspan="11" class="dataTables_empty">{{trans("main_trans.No data is found")}}</td></tr>')
                }
                else if(data.status===false){
                  $(`#deleteAllPromotions`).modal('hide');
                  swal("{{__('grades.failed to delete! something wrong is happened')}}","", "error");
                  }
           },
           error:function(reject){
           }
})
})




</script>