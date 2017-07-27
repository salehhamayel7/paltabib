<script type="text/javascript">

     

      $(document).ready(function()
        {
           
           $('.showmsg').on('click',function(){
                var msg_id = $(this).attr('msgid');
               
                 $.get("/ajax/message/show/"+msg_id,function(data){
                   
                     $('.date').html(data.msg.created_at);
                     $('#sender_name').html(data.sender.name);
                     $('#sender_mail').html(data.sender.email);
                     $('#msgtitle').html(data.msg.title);
                     $('#msgbody').html(data.msg.message);
                     $("#deleteMSG").attr("href", "/message/delete/receiver/"+data.msg.id);
                     $("#replyMsg").attr("data", data.msg.id);
                  
                 });

                 $.get("/ajax/message/saw/"+msg_id);


            });


          $("#sendMsgFrom").submit(function(e) {

              var url = "/send/msg"; // the script where you handle the form input.

              $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#sendMsgFrom").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                         $("#closeCompose").click();
                         $("#msgModal").click();
                         $('#smsgtitle').val('');
                         $('#editor').val("");
                    }
                  });

              e.preventDefault(); // avoid to execute the actual submit of the form.
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
                      $('#editor').val("\n\n-----------------\n"+data.msg.message);
                      $('#smsgreceiver').val(data.sender.user_name);
                      $("#compose").click();
                    }
                  });
            });


    </script>