<script type="text/javascript">

     

      $(document).ready(function()
        {
           
           $('.showmsg').on('click',function(){
                var msg_id = $(this).attr('msgid');
               
                 $.get("/ajax/message/show/"+msg_id,function(data){
                   
                     $('.date').html(data.msg.created_at);
                     $('#sender_name').html(data.resiver.name);
                     $('#sender_mail').html(data.resiver.email);
                     $('#msgtitle').html(data.msg.title);
                     $('#msgbody').html((data.msg.message));
                     $("#deleteMSG").attr("href", "/message/delete/sender/"+data.msg.id);
                     $("#replyMsg").attr("data", +data.msg.id);
                  
                 });
            });

        });


        $('#replyMsg').on('click',function(){
                var msg_id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "/ajax/message/show/"+msg_id,
                    success: function(data)
                    {
                      $('#smsgtitle').val('Reply to: '+data.msg.title);
                      $('#editor').val("\n\n"+data.msg.message);
                      $('#smsgreceiver').val(data.sender.user_name);
                      $("#compose").click();
                    }
                  });
            });


    </script>