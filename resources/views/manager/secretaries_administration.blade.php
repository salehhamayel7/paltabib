@extends('manager/layouts.master')
@section('content')

<style>
	.input-group-addon{
		    min-width: 127px;
	}
	.input-group input{
		    text-align: right;
	}
</style>

        <!-- page content -->
		 <div class="right_col" role="main">
          <div class="page-content">

            <div class="clearfix"></div>
            <div class="row">
     
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
									
									<ul class="nav navbar-left panel_toolbox">
									 <li><a></a>
									  </li>
									 <li><a id = "collapse2" class="collapse-link" title = "اعرض/اخف"><i class="fa fa-chevron-up fa-lg"></i></a>
									  </li>
									<li><a onclick="replaceContentToAddS()" title = "اضافة سكرتير"><i class="fa fa-plus fa-lg"></i></a>
									  </li>
									 
									 
									</ul>
									<h2 style="float:right;">ادارة السكرتاريا</h2>
									
									<div class="clearfix"></div>
								  </div>
                  <div class="x_content" id="page_contentS">
                   
                    <table dir="rtl" id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                           <th>اسم المستخدم</th>
                          <th>بطاقة الهوية</th>
                          <th>الاسم</th>
                          <th>الايميل</th>
                          <th>العنوان</th>
                          <th>الهاتف</th>
						              <th>الراتب</th>
						              <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($secretaries as $sec)
                        <tr>
						              <th>{{$sec->user_name}}</th>
                           <th>
                          <form method="get" action="/file/download/{{$sec->id_image}}">  
                            <button type="submit" class="btn btn-success btn-sm">عرض/تحميل</button>
                            </form>
                           </th>
                          <th>{{$sec->name}}</th>
                          <th>{{$sec->email}}</th>
                          <th>{{$sec->address}}</th>
                          <th>{{$sec->phone}}</th>
                          
                          <th>{{$sec->salary}}</th>
                        
                          <th>
                          <a id="editSecretary" onclick = "" data="{{$sec->user_name}}" class="btn btn-success btn-xs editSecretary"><i class="fa fa-edit"></i> تعديل </a>
                                
                          <a href="/secretary/delete/{{$sec->user_name}}" onclick="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> حذف </a>
                          </th>
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
        <!-- /page content -->
		
		
		
		
<div id="addSec" style="display:none;">										
	<form id="addSecform" method="post" action="/dashboard/manager/addSec" class="form-horizontal form-label-left" enctype="multipart/form-data">
		<span dir="rtl" class="section">اضف معلومات السكرتير</span>
		<input type="hidden" name="_token" value="{{csrf_token()}}">
		<input type="hidden" name="ADclinic" value="{{$clinic->id}}">

		<div class="row" dir="ltr">
				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADName') ? ' has-error' : '' }}">
					<input value="{{ old('ADName') }}" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" type="text">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الاسم</span>
				</div>
				@if ($errors->has('ADName'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADName') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADuName') ? ' has-error' : '' }}">
					<input value="{{ old('ADuName') }}" title="اسم المستخدم" type="text" id="ADuName" name="ADuName" class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>اسم المستخدم</span>
				</div>
				@if ($errors->has('ADuName'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADuName') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADpass') ? ' has-error' : '' }}">
					<input title="كلمة المرور" type="password" id="ADpass" name="ADpass"  class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>كلمة المرور</span>
				</div>
				@if ($errors->has('ADpass'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADpass') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADpass_2') ? ' has-error' : '' }}">
					<input title="تاكيد كلمة المرور" type="password" id="ADpass_2" name="ADpass_2"  class="form-control col-md-7 col-xs-12">
						<span class="input-group-addon" id="basic-addon2">تاكيد كلمة المرور</span>
						</div>
							@if ($errors->has('ADpass_2'))
								<div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
										{{ $errors->first('ADpass_2') }}
								</div>
						@endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADemail') ? ' has-error' : '' }}">
					<input value="{{ old('ADemail') }}" title="الايميل" type="email" id="ADemail" name="ADemail"  class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الايميل</span>
				</div>
				@if ($errors->has('ADemail'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADemail') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADgender') ? ' has-error' : '' }}">
					<select value="{{ old('ADgender') }}" id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
						<option value="Male">ذكر</option>
						<option value="Female">انثى</option>
					</select>
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الجنس</span>
				</div>
				@if ($errors->has('ADgender'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADgender') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADaddress') ? ' has-error' : '' }}">
					<input value="{{ old('ADaddress') }}" title="العنوان" type="text" id="ADaddress" name="ADaddress"  class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>العنوان</span>
				</div>
				@if ($errors->has('ADaddress'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADaddress') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADphone') ? ' has-error' : '' }}">
					<input value="{{ old('ADphone') }}" title="رقم الهاتف" type="text" id="ADphone" name="ADphone"  class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>رقم الهاتف</span>
				</div>
				@if ($errors->has('ADphone'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADphone') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ATimage') ? ' has-error' : '' }}">
					<input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" class="form-control col-md-7 col-xs-12" value="User_Avatar-512.png">
					<span class="input-group-addon" id="basic-addon2">الصورة الشخصية</span>
				</div>
				@if ($errors->has('ATimage'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ATimage') }}
                </div>
            @endif

				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('id_image') ? ' has-error' : '' }}">
					<input accept="image/*,.doc,.docx,.pdf" title="ملف/صورة الهوية" type="file" id="id_image" name="id_image"  class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>ملف/صورة الهوية</span>
				</div>
				@if ($errors->has('id_image'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('id_image') }}
                </div>
            @endif

				<hr/>


				<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12 {{ $errors->has('ADsalary') ? ' has-error' : '' }}">
					<input value="{{ old('ADsalary') }}" title="الراتب" type="text" id="ADsalary" name="ADsalary"  data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
					<span class="input-group-addon" id="basic-addon2">الراتب</span>
				</div>
				@if ($errors->has('ADsalary'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADsalary') }}
                </div>
            @endif


				
				<div class="ln_solid"></div>
				<div class="form-group">
				<div class="col-md-6 col-md-offset-5">
						<button id="send" type="submit" onClick="validataddTeacher()" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
					<a id="cancel" type="submit" href="" class="btn btn-primary"><i class="fa fa-times"></i> الغاء</a>
				</div>
				</div>
			</div>

	</form>
</div>
										

@endsection   