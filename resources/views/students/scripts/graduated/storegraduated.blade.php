<script>
$(document).on('submit', '#storeGraduatedForm', function (e) {
       e.preventDefault();
       $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
      });
       var formData = new FormData($(this)[0]);
       $.ajax({
           type: 'post',
           enctype: 'multipart/form-data',
           url: "{{route('Graduated.store')}}",
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
                  swal("{{__('main_trans.failed to save')}}","", "error");
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



</script>