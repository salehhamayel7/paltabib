 <script type="text/javascript">
    
      $(document).ready(function()
        {
          var href = document.URL;
          if(href.indexOf("histories") >= 0){
            $('#tab_content33').addClass('active in');
            $('#firstTab').removeClass('active');
            $('#thirdTab').addClass('active');
            $('#tab_content11').removeClass('active in');

          }
          $('.col-md-55').on('click',function(){
                var image_name = $(this).attr('data');
                $('#imageInModal').attr('src','/images/histories/'+image_name);
                $('#imageModal').modal('show');
          });
        });
    </script>