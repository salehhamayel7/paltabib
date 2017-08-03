<script type="text/javascript">

     

      $(document).ready(function()
        {
           
           $('.showmsg').on('click',function(){
                var msg_id = $(this).attr('msgid');
                $('.selected-mail').removeClass('selected-mail');
                $(this).children().addClass( "selected-mail" ).length;
                
                 $.get("/ajax/message/show/"+msg_id,function(data){
                   
                     $('.date').html(data.msg.created_at);
                     $('#sender_name').html(data.sender.name);
                     $('#sender_mail').html(data.sender.email);
                     $('#msgtitle').html(data.msg.title);
                     $('#msgbody').html((data.msg.message));
                     $("#deleteMSG").attr("href", "/message/delete/receiver/"+data.msg.id);
                     $("#replyMsg").attr("data", data.msg.id);
                  
                 });

                 $.get("/ajax/message/saw/"+msg_id);


            });


        });


        $('#replyMsg').on('click',function(){
                var msg_id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "/ajax/message/show/"+msg_id,
                    success: function(data)
                    {
                      $('#smsgtitle').val('رد على: '+data.msg.title);
                      $('textarea').val("\n\n-----------------\n"+data.msg.message);
                      $('#smsgreceiver').val(data.sender.user_name);
                      $("#compose").click();
                    }
                  });
            });


    </script>
