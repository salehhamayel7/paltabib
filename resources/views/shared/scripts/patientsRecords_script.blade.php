<script type="text/javascript">
      $(document).ready(function()
        {

            $('.viewRecord').on('click',function(){
              var user_name = $(this).attr('data');
              var href=(document.URL).replace("patientsRecords", "record/"+user_name);
              window.location.href=href;
              //location.reload();
            });

        });


    </script>