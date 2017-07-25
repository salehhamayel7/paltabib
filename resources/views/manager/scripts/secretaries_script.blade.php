<script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.editSecretary').on('click',function(){
            var user_name = $(this).attr('data');
           // alert(user_name);
             $.get("/ajax/edit/secretary/"+user_name,function(data){
               // alert(data.user.name);
                $('#ADName').val(data.user.name);
                $('#ADuName').val(data.user.user_name);
                 
                  $('#ADemail').val(data.user.email);
                  $('#ADgender').val(data.user.gender);
                  $('#ADaddress').val(data.user.address);
                  $('#ADphone').val(data.user.phone);
                  $('#ADsalary').val(data.secretary.salary);
             
             });
            replaceContentToAddS();
            $('#clicicinput').hide();
            $('#ADclinic').removeAttr("required");
            $('#ADpass').removeAttr("required");
            $('#ATimage').removeAttr("required");
            $('#id_image').removeAttr("required");
            $("#send").attr("onClick","");
            $("#send").html("تعديل");
            $("#addSecform").attr("action","/secretary/update/"+user_name);

              });

              

        });


    </script>