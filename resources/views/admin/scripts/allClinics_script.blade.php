<script src="{{asset('build/js/custom.min.js')}}"></script>
    <script src="{{asset('vendors/moment/min/moment.min.js')}}"></script>
     @include('includes.Datatables_scripts')
    <script type="text/javascript">
      $(document).ready(function(){

          $('#allclicnics').addClass("active");


          $('.deleteClinic').on('click',function(){

            var r = confirm("Are you sure you want to delete this clinic?");
            if (r == true) {
                 var clinic_id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "/ajax/clinic/delete/"+clinic_id,
                    success: function(data)
                    {
                      location.reload(true);
                    }
                });
            } 

          });


          $('.editClinic').on('click',function(){

            var clinic_id = $(this).attr('data');
               $.ajax({
                  type: "GET",
                  url: "/ajax/clinic/get/"+clinic_id,
                  success: function(data)
                  {
                    
                      $('#email').val(data.user.email);
                      $('#name').val(data.user.name);
                      $('#role').val(data.user.role);
                      $('#user_name').val(data.user.user_name);
                      $('#old_user_name').val(data.user.user_name);
                      $('#address').val(data.user.address);
                      $('#phone').val(data.user.phone);
                      $('#gender').val(data.user.gender);
                    
                      $('#clinic').val(data.clinic.name);
                      $('#clinic_id').val(data.clinic.id);
                      $('#clinic_address').val(data.clinic.address);
                      $('#clinic_phone').val(data.clinic.phone);

                      if(data.user.role == 'Manager,Doctor'){
                          $('#major').val(data.doctor.major);
                          $('#union_number').val(data.doctor.union_number);
                      }

                      $('#editClinicModal').modal('show');
                  }
              });
                 
          });

        });
    </script>
  