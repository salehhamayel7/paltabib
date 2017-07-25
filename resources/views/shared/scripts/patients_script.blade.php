<!-- jQuery Tags Input -->
    <script src="{{asset('../vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('../vendors/switchery/dist/switchery.min.js')}}"></script>
    
    <script type="text/javascript">
      $(document).ready(function()
        {


            $('#home-tabb').on('click',function(){

           });

           $('.editPacient').on('click',function(){

                var user_name = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/edit/pacient/"+user_name,function(data){
                   // alert(data.user.name);
                     $('#ADName').val(data.user.name);
                     $('#ADuName').val(data.user.user_name);
                     $('#ADemail').val(data.user.email);
                     $('#ADgender').val(data.user.gender);
                     $('#ADaddress').val(data.user.address);
                     $('#ADphone').val(data.user.phone);
                     $('#ADjob').val(data.pacient.job);
                     $('#ensurance').val(data.pacient.ensurance_number);

                     $('#ph').val(data.pacient.past_history);
                     $('#dd').val(data.pacient.demo_details);
                     $('#hpc').val(data.pacient.history_of_comp);
                     $('#pc').val(data.pacient.present_comp);
                     $('#dh').val(data.pacient.drug_history);
                     $('#sh').val(data.pacient.social_history);
                     $('#se').val(data.pacient.systematic_en);
                     $('#oe').val(data.pacient.on_exam);
                     $('#cvs').val(data.pacient.cardio_system);
                     $('#rs').val(data.pacient.respiratory_system);
                     $('#fh').val(data.pacient.family_history);

                     //$('#tags_1').tagsinput('add', 'some tag');

                     $('#tags_1').val(data.pacient.allergic_from);

                     if(data.pacient.smoking){
                       //var element = $('#smoker');
                       //changeSwitchery(element, true);
                       //$('#smoker').prop('checked', true);
                       $('#smoker').trigger('click');
                     }
                      if(data.pacient.married){
                       $('#married').trigger('click');
                     }
                      if(data.pacient.allergic){
                       $('#touchy').trigger('click');
                     }
                      if(data.pacient.alcohol){
                       $('#drunk').trigger('click');
                     }
                      if(data.pacient.drugs){
                       $('#sot').trigger('click');
                     }
                      if(data.pacient.disability){
                       $('#disablity').trigger('click');
                     }
             
                 });

                replaceContentToAddP();

                $('#ADpass').removeAttr("required");
                $('#ATimage').removeAttr("required");
                $("#send").attr("onClick","");
                $("#send").html("حفط التغييرات");
                $("#addPatintform").attr("action","/pacient/update/"+user_name);

            });
            

        });

    </script>