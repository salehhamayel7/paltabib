@extends('admin/layouts.master')
@section('content')

      
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
                          <th>Clinic Name</th>
                          <th>Clinic Phone</th>
                          <th>Clinic Address</th>
                          <th>Clinic Registration Proof</th>
                          <th>Manager Name</th>
                          <th>Manager ID</th>
                          <th>Manager Email</th>
                          <th>Manager Phone</th>
                          <th>Banned?</th>
                          <th>Actions</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($clinics as $clinic)
                        <tr>
                         
						    <th>{{$clinic->clinic_name}}</th>
                            <th>{{$clinic->clinic_phone}}</th>
                            <th>{{$clinic->clinic_address}}</th>
                            <th>
                              <form method="get" action="/file/download/{{$clinic->reg_proof}}">  
                                <button type="submit" class="btn btn-success btn-sm">Download</button>
                                </form>
                            </th>
                            <th>{{$clinic->name}}</th>
                            <th>
                                 <form method="get" action="/file/download/{{$clinic->id_image}}">  
                                <button type="submit" class="btn btn-success btn-sm">Download</button>
                                </form>
                            </th>
                            <th>{{$clinic->email}}</th>
                            <th>{{$clinic->phone}}</th>
                            <th>
                            @if($clinic->banned)
                                Banned
                            @else
                                Not Banned
                            @endif
                            </th>
                            <th>

                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Action
                                <span class="caret"></span>
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width: 20px;">
                                <li class="editClinic" data="{{$clinic->clinic_id}}"><a><i class="fa fa-edit"></i> Edit </a></li>
                                <li class="banClinic" data="{{$clinic->clinic_id}}"><a><i class="fa fa-minus-circle"></i> Un/Ban </a></li>
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
        <input type="hidden" name="clinic_id" id="clinic_id" value="">
        <input type="hidden" name="old_user_name" id="old_user_name" value="">
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
                            <label for="password" class="col-md-4 control-label">Password</label>

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
                            <label for="id_image" class="col-md-4 control-label">ID File/Image</label>

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
                            <label for="reg_proof" class="col-md-4 control-label">Clinic Registration Proof</label>

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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
       </form>
    </div>
  </div>
</div>
@endsection