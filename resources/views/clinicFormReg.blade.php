<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Pal Tabib</title>
      <!-- Font Awesome -->
      <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
      <!-- Bootstrap -->
      <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
      
      <link href="{{asset('css/adminCSS.css')}}" rel="stylesheet">
    </head>
    <body>

      @include('includes.admin_nav')
      
  <div class="right_col" role="main">
    <div class="page-content">
      <div class="page-title">
        <div class="clearfix"></div>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success" style="margin-top: 25px;">
                <div class="panel-heading">Register a Clinic</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/registerClinic') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                  <small>Manager information</small>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                         
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Role</label>

                            <div class="col-md-6">
                                
                                 <select value="{{ old('role') }}"  class="form-control" name="role">
                                     <option value="Manager">manager only</option>
                                     <option value="Manager,Doctor">Manager and Doctor</option>
                                 </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('role') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                          <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">ID Number</label>

                            <div class="col-md-6">
                                <input value="{{ old('user_name') }}" id="user_name" type="text" class="form-control" name="user_name" required>

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">address</label>

                            <div class="col-md-6">
                                <input value="{{ old('address') }}" id="address" type="text" class="form-control" name="address" required>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone</label>

                            <div class="col-md-6">
                                <input value="{{ old('phone') }}" id="phone" type="number" class="form-control" name="phone" required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                           
                       
                        
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">gender</label>

                            <div class="col-md-6">
                                
                                 <select value="{{ old('gender') }}" class="form-control" name="gender">
                                     <option value="Male">Male</option>
                                     <option value="Female">Female</option>
                                 </select>
                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">image</label>

                            <div class="col-md-6">
                                <input value="{{ old('image') }}" value="User_Avatar-512.png" id="image" type="file" accept="image/*" class="form-control" name="image" required>
                                @if ($errors->has('image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <small>Clinic information</small>
                        <div class="form-group{{ $errors->has('clinic') ? ' has-error' : '' }}">
                            <label for="clinic" class="col-md-4 control-label">Clinic Name</label>

                            <div class="col-md-6">
                                <input value="{{ old('clinic') }}" id="clinic" type="text" class="form-control" name="clinic" required>

                                @if ($errors->has('clinic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('clinic_address') ? ' has-error' : '' }}">
                            <label for="clinic_address" class="col-md-4 control-label">Clinic Address</label>

                            <div class="col-md-6">
                                <input value="{{ old('clinic_address') }}" id="clinic_address" type="text" class="form-control" name="clinic_address" required>

                                @if ($errors->has('clinic_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('clinic_phone') ? ' has-error' : '' }}">
                            <label for="clinic_phone" class="col-md-4 control-label">Clinic Phone</label>

                            <div class="col-md-6">
                                <input value="{{ old('clinic_phone') }}" id="clinic_phone" type="text" class="form-control" name="clinic_phone" required>

                                @if ($errors->has('clinic_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <small>If the manager is a doctor too</small>

                        <div class="form-group{{ $errors->has('major') ? ' has-error' : '' }}">
                            <label for="major" class="col-md-4 control-label">Major</label>

                            <div class="col-md-6">
                                <input value="{{ old('major') }}" id="major" type="text" class="form-control" name="major">

                                @if ($errors->has('major'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('major') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('union_number') ? ' has-error' : '' }}">
                            <label for="union_number" class="col-md-4 control-label">Union number</label>

                            <div class="col-md-6">
                                <input value="{{ old('union_number') }}" id="union_number" type="number" class="form-control" name="union_number">

                                @if ($errors->has('union_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('union_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-success">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

          </div>
      </div>
    </div>
  </div>
         <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){

          $('#registere').addClass("active");

        });
    </script>
  </body>
</html>
