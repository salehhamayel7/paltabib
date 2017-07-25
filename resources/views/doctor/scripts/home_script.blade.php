<script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.cancelAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });


            $('.approveAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/approve/"+id,function(data){
                   // alert(data.user.name);
                  var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });
            });



            $('.disapprovedAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });
            
            $('#get-id').on('click',function(){
               $('#id-form').submit();
            });

        });

    </script>