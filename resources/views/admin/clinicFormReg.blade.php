@extends('admin/layouts.master')
@section('content')

      
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
                            <label for="email" class="col-md-4 control-label">E-Mail Address<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_name') ? ' has-error' : '' }}">
                            <label for="user_name" class="col-md-4 control-label">User Name<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('user_name') }}" id="user_name" type="text" class="form-control" name="user_name"  >

                                @if ($errors->has('user_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                   <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"  >

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  >
                            </div>
                        </div>
                         
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
                            <label for="role" class="col-md-4 control-label">Role<span style="color:red;"> *</span></label>

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
                        

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Address<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('address') }}" id="address" type="text" class="form-control" name="address">

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">Phone<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input placeholder="+_ _ _ _ _ _ _ _ _ _" value="{{ old('phone') }}" id="phone" type="text" class="form-control" name="phone">

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                            <label for="gender" class="col-md-4 control-label">Gender<span style="color:red;"> *</span></label>

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
                        <div class="form-group{{ $errors->has('id_image') ? ' has-error' : '' }}">
                            <label for="id_image" class="col-md-4 control-label">ID File/Image<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('id_image') }}" accept="image/*,.doc,.docx,.pdf" value="{{ old('id_image') }}" id="id_image" type="file" class="form-control" name="id_image"  >
                                @if ($errors->has('id_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                            <label for="image" class="col-md-4 control-label">image</label>

                            <div class="col-md-6">
                                <input value="{{ old('image') }}" value="{{ old('image') }}" id="image" type="file" accept="image/*" class="form-control" name="image">
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
                            <label for="clinic" class="col-md-4 control-label">Clinic Name<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('clinic') }}" id="clinic" type="text" class="form-control" name="clinic"  >

                                @if ($errors->has('clinic'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('clinic_address') ? ' has-error' : '' }}">
                            <label for="clinic_address" class="col-md-4 control-label">Clinic Address<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('clinic_address') }}" id="clinic_address" type="text" class="form-control" name="clinic_address">

                                @if ($errors->has('clinic_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic_address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('clinic_phone') ? ' has-error' : '' }}">
                            <label for="clinic_phone" class="col-md-4 control-label">Clinic Phone<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input placeholder="+_ _ _ _ _ _ _ _ _ _" value="{{ old('clinic_phone') }}" id="clinic_phone" type="text" class="form-control" name="clinic_phone">

                                @if ($errors->has('clinic_phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('clinic_phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('reg_proof') ? ' has-error' : '' }}">
                            <label for="reg_proof" class="col-md-4 control-label">Clinic Registration Proof<span style="color:red;"> *</span></label>

                            <div class="col-md-6">
                                <input value="{{ old('reg_proof') }}" accept="image/*,.doc,.docx,.pdf" value="{{ old('reg_proof') }}" id="reg_proof" type="file" class="form-control" name="reg_proof"  >
                                @if ($errors->has('reg_proof'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('reg_proof') }}</strong>
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
                                <input value="{{ old('union_number') }}" id="union_number"  type="text" class="form-control" name="union_number">

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
    
  
@endsection