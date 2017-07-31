<script type="text/javascript">
      $(document).ready(function(){

          $('#payments').addClass("active");

          
          $('.editCard').on('click',function(){
              var id = $(this).attr('data');
              
              $.get("/paymen_method/get/"+id,function(data){
                    $('#cardtype').val(data.method.type);
                    $('#cardmethod').val(data.method.method);
                    $("#cardprice").val(data.method.price);
                    $("#methodID").val(data.method.id);
                    $("#carddes1").val(data.method.description1);
                    $("#carddes2").val(data.method.description2);
                    $("#carddes3").val(data.method.description3);
                    $("#carddes4").val(data.method.description4);
                    $("#carddes5").val(data.method.description5);
                  $('#editcardmodal').modal('show');
                });
            });

        });
    </script>