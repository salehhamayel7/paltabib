<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Pal Tabib</title>

       <!-- Bootstrap -->
      <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
      @include('includes.Datatables_links')
      <link href="{{asset('css/adminCSS.css')}}" rel="stylesheet">
      
    </head>
    <body>

      @include('includes.admin_nav')
      
  <div class="right_col" role="main">
    <div class="page-content">
      <div class="page-title">
        <div class="clearfix"></div>
          <div class="row">
          
          <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-success" style="margin-top: 25px;">
                <div class="panel-heading">All Registered Clinics</div>
                <div class="panel-body">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th> Clinic Name</th>
                          <th>Clinic Phone</th>
                          <th>Clinic Address</th>
                          <th>Manager Name</th>
                          <th>Manager ID</th>
                          <th>Manager Email</th>
                          <th>Manager Phone</th>
                          
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($clinics as $clinic)
                        <tr>
                         
						              <th>{{$clinic->clinic_name}}</th>
                          <th>{{$clinic->clinic_phone}}</th>
                          <th>{{$clinic->clinic_address}}</th>
                          <th>{{$clinic->name}}</th>
                          <th>{{$clinic->user_name}}</th>
                          <th>{{$clinic->email}}</th>
                          <th>{{$clinic->phone}}</th>
                          <th>

                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Action
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width: 20px;">
                                <li><a class="editClinic" data="{{$clinic->clinic_id}}"><i class="fa fa-edit"></i> Edit </a></li>
                                <li><a><i class="fa fa-minus-circle"></i> Ban </a></li>
                                <li class="deleteClinic" data="{{$clinic->clinic_id}}"><a><i class="fa fa-trash-o"></i> Delete </a></li>
                                
                              </ul>
                            </div>
                         
                        </tr>
                        @endforeach
                      
                      </tbody>
                    </table>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <!-- Modal -->
<div class="modal fade" id="editClinicModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/clinic/update') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="clinic_id" id="clinic_id" value="">
              <input type="hidden" name="old_user_name" id="old_user_name" value="">
        <small>Manager information</small>
          <div class="form-group">
                  <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                  <div class="col-md-6">
                      <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                  </div>
              </div>
          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-4 control-label">Password</label>

                  <div class="col-md-6">
                      <input id="password" type="password" class="form-control" name="password">

                  </div>
              </div>
                
              <div class="form-group">
                  <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                  <div class="col-md-6">
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                  </div>
              </div>
                
              <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name" class="col-md-4 control-label">Name</label>

                  <div class="col-md-6">
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                  </div>
              </div>

              <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                  <label for="role" class="col-md-4 control-label">Role</label>

                  <div class="col-md-6">
                      
                        <select value="{{ old('role') }}"  class="form-control" name="role" id="role">
                            <option value="Manager">manager only</option>
                            <option value="Manager,Doctor">Manager and Doctor</option>
                        </select>
                     
                  </div>
              </div>
              
                <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                  <label for="user_name" class="col-md-4 control-label">ID Number</label>

                  <div class="col-md-6">
                      <input value="{{ old('user_name') }}" id="user_name" type="text" class="form-control" name="user_name" required>

                      
                  </div>
              </div>

              <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                  <label for="address" class="col-md-4 control-label">Address</label>

                  <div class="col-md-6">
                      <input value="{{ old('address') }}" id="address" type="text" class="form-control" name="address" required>

                      
                  </div>
              </div>

              <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone" class="col-md-4 control-label">Phone</label>

                  <div class="col-md-6">
                      <input value="{{ old('phone') }}" id="phone" type="number" class="form-control" name="phone" required>

                  </div>
              </div>
                  
              
              
              <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                  <label for="gender" class="col-md-4 control-label">gender</label>

                  <div class="col-md-6">
                      
                        <select value="{{ old('gender') }}" class="form-control" name="gender" id="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                      
                  </div>
              </div>
              <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                  <label for="image" class="col-md-4 control-label">image</label>

                  <div class="col-md-6">
                      <input value="{{ old('image') }}" value="User_Avatar-512.png" id="image" type="file" accept="image/*" class="form-control" name="image">
                      
                  </div>
              </div>
              <hr>
              <small>Clinic information</small>
              <div class="form-group{{ $errors->has('clinic') ? ' has-error' : '' }}">
                  <label for="clinic" class="col-md-4 control-label">Clinic Name</label>

                  <div class="col-md-6">
                      <input value="{{ old('clinic') }}" id="clinic" type="text" class="form-control" name="clinic" required>

                      
                  </div>
              </div>
              <div class="form-group{{ $errors->has('clinic_address') ? ' has-error' : '' }}">
                  <label for="clinic_address" class="col-md-4 control-label">Clinic Address</label>

                  <div class="col-md-6">
                      <input value="{{ old('clinic_address') }}" id="clinic_address" type="text" class="form-control" name="clinic_address" required>

                  </div>
              </div>

              <div class="form-group{{ $errors->has('clinic_phone') ? ' has-error' : '' }}">
                  <label for="clinic_phone" class="col-md-4 control-label">Clinic Phone</label>

                  <div class="col-md-6">
                      <input value="{{ old('clinic_phone') }}" id="clinic_phone" type="text" class="form-control" name="clinic_phone" required>

                      
                  </div>
              </div>

              <hr>
              <small>If the manager is a doctor too</small>

              <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                  <label for="major" class="col-md-4 control-label">Major</label>

                  <div class="col-md-6">
                      <input value="{{ old('major') }}" id="major" type="text" class="form-control" name="major">

                  </div>
              </div>

              
              <div class="form-group{{ $errors->has('union_number') ? ' has-error' : '' }}">
                  <label for="union_number" class="col-md-4 control-label">Union number</label>

                  <div class="col-md-6">
                      <input value="{{ old('union_number') }}" id="union_number" type="number" class="form-control" name="union_number">

                  </div>
              </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>



    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- Custom Theme Scripts -->
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
  </body>
</html>
