<script type="text/javascript">
      $(document).ready(function(){

          $('#homeconfig').addClass("active");
             var href=document.URL;
          if (href.indexOf("sections") >= 0){
            $('#collapseOne').removeClass("in");
            $('#collapseTwo').addClass("in");
          }


             $('.PreviewSlide').on('click',function(){
              var id = $(this).attr('data');
              
              $.get("/slider/get/"+id,function(data){
                  $('#slideTitle').html(data.slide.title);
                  $('#slideDes').html(data.slide.description);
                  $("#slideImg").attr('src',data.slide.image);
                  $('#slideModal').modal('show');
                });
            });

             $('.DeleteSlide').on('click',function(){
              var id = $(this).attr('data');

              var r = confirm("Are you sure you want to delete that slide with id "+id+"!");
                if (r == true) {
                    $.get("/slider/delete/"+id,function(){
                           location.reload(true);

                    });
                } 
              
              
            });

            $('.EditSlide').on('click',function(){
              var id = $(this).attr('data');

                $.get("/slider/get/"+id,function(data){
                  $('#eStitle').val(data.slide.title);
                  $('#eSdescription').val(data.slide.description);
                  $('#Eslideid').val(data.slide.id);
                  $('#editslideModal').modal('show');

                });
            });

            $('.showSlide').on('click',function(){
              var id = $(this).attr('data');

                $.get("/slider/show/"+id,function(){

                });
            });


            
            $('.PreviewSection').on('click',function(){
              var id = $(this).attr('data');
              
              $.get("/section/get/"+id,function(data){
                  $('#sectionTitle').html(data.section.title);
                  $('#sectionDes').html(data.section.description);
                  $("#sectionImg").attr('src',data.section.image);
                  $('#sectionModal').modal('show');
                });
            });


            
            $('.showSection').on('click',function(){
              var id = $(this).attr('data');

                $.get("/section/show/"+id,function(){

                });
            });

            $('.EditSection').on('click',function(){
              var id = $(this).attr('data');

                $.get("/section/get/"+id,function(data){
                  $('#Esectiontitle').val(data.section.title);
                  $('#Esectiondescription').val(data.section.description);
                  $('#Esectionid').val(data.section.id);
                  $('#editSectionModal').modal('show');

                });
            });


            $('.DeleteSection').on('click',function(){
              var id = $(this).attr('data');

              var r = confirm("Are you sure you want to delete that section with id "+id+"!");
                if (r == true) {
                    $.get("/section/delete/"+id,function(){
                           location.reload(true);

                    });
                } 
            });


        });
    </script>