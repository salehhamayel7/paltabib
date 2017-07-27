<script type="text/javascript">
      $(document).ready(function(){

          $('#payments').addClass("active");

          
          $('.editCard').on('click',function(){
              var id = $(this).attr('data');
              
              $.get("/paymen_method/get/"+id,function(data){
                  $('#cardtitle').val(data.method.title);
                  $('#carddescription').val(data.method.description);
                  $("#cardprice").val(data.method.price);
                  $("#methodID").val(data.method.id);
                  
                  $('#editcardmodal').modal('show');
                });
            });

        });
    </script>