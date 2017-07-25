<script type="text/javascript">
      $(document).ready(function()
        {
           
          
          
            $('#myModal2').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget); // Button that triggered the modal
              var id = button.data('id'); // Extract info from data-* attributes
              $('#confirmCancel').attr('data' , id);
            });

          

          $('#confirmCancel').on('click',function()
          {

            var id = $(this).attr('data');
            $.get("/ajax/appointment/delete/"+id,function(){
              location.reload();
             });
          });

            $('#get-id').on('click',function(){
               $('#id-form').submit();
            });

        });
    </script>