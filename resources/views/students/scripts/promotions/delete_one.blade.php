<script>
$(document).on('submit', '#deletePromotion', function (e) {
       e.preventDefault();
       var promotion_id=$(this).attr('promotion_id')
       var url = "{{ route('Promotions.destroy') }}";
       var formData=new FormData($(this)[0]);
       console.log(promotion_id)
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           data: formData,
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
                 $(`#deleteOnePromotion${promotion_id}`).modal('hide');
                   swal(data.msg,"","success");
                 $(`tbody#promotions tr#promotion${promotion_id}`).remove()
                }
                else if(data.status===false){
                  $(`#deleteOnePromotion${promotion_id}`).modal('hide');
                  swal(data.msg,"", "error");
                  }
           },
           error:function(reject){
           }
})
})
</script>