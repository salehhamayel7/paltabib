 <script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.editNurse').on('click',function(){
                var user_name = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/edit/nurse/"+user_name,function(data){
                   // alert(data.user.name);
                     $('#ADName').val(data.user.name);
                     $('#ADuName').val(data.user.user_name);
                         
                     $('#ADemail').val(data.user.email);
                     $('#ADgender').val(data.user.gender);
                     $('#ADaddress').val(data.user.address);
                     $('#ADphone').val(data.user.phone);
                     $('#ADsalary').val(data.nurse.salary);
             
                 });

                replaceContentToAddN();

                $('#ADpass').removeAttr("required");
                $('#passDev').hide();
                $('#imgAstrik').hide();
                $('#ATimage').removeAttr("required");
                $('#id_image').removeAttr("required");
                $("#send").attr("onClick","");
                $("#send").html("تعديل");
                $("#addNurseform").attr("action","/nurse/update/"+user_name);

            });

        });

    </script>