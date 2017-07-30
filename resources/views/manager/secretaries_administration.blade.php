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
													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" data-validate-length-range="15" data-validate-words="1"  required="required" type="text">
														<span class="input-group-addon" id="basic-addon2">الاسم</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input title="اسم المستخدم" type="text" id="ADuName" name="ADuName" required="required"  class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">اسم المستخدم</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input title="كلمة المرور" type="password" id="ADpass" name="ADpass" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">كلمة المرور</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input  title="الايميل" type="email" id="ADemail" name="ADemail" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">الايميل</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<select id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
															<option value="Male">ذكر</option>
															<option value="Female">انثى</option>
														</select>
														<span class="input-group-addon" id="basic-addon2">الجنس</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">العنوان</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input title="رقم الهاتف" type="number" id="ADphone" name="ADphone" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">رقم الهاتف</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" class="form-control col-md-7 col-xs-12" value="User_Avatar-512.png">
														<span class="input-group-addon" id="basic-addon2">الصورة الشخصية</span>
													</div>

													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input accept="image/*,.doc,.docx,.pdf" title="ملف/صورة الهوية" type="file" id="id_image" name="id_image" required="required" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">ملف/صورة الهوية</span>
													</div>

													<hr/>


													<div class="input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
														<input title="الراتب" type="number" id="ADsalary" name="ADsalary" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">الراتب</span>
													</div>

									
													
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