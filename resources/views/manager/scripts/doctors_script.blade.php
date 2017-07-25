<script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.editDoctor').on('click',function(){
            var user_name = $(this).attr('data');
            
             $.get("/ajax/edit/doctor/"+user_name,function(data){
               
                $('#ADName').val(data.user.name);
                $('#ADuName').val(data.user.user_name); 
                $('#ADemail').val(data.user.email);
                $('#ADgender').val(data.user.gender);
                $('#ADaddress').val(data.user.address);
                $('#ADphone').val(data.user.phone);
                $('#ADmajor').val(data.doctor.major);
                $('#ADsalary').val(data.doctor.salary);
                $('#ADnumber').val(data.doctor.union_number);

             });
            replaceContentToAddD();
            $('#ADpass').removeAttr("required");
            $('#id_image').removeAttr("required");      
            $('#ATimage').removeAttr("required");
            $("#send").attr("onClick","");
            $("#send").html("تعديل");
            $("#addDoctorform").attr("action","/doctor/update/"+user_name);

               });

               

        });


    </script>