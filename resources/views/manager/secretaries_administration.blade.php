@extends('manager/layouts.master')
@section('content')

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
                     
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADName">الاسم <span class="required">*</span>
											</label>
											<div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" required="required" type="text">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADuName">اسم المستخدم<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="رقم الهوية" type="text" id="ADuName" name="ADuName" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group" id = "passDev">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADpass">كلمة السر <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="كلمة السر" type="password" id="ADpass" name="ADpass" required="required" data-validate-min="6" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADemail">الايميل <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="xxxxxx@xxxx.xxx" title="الايميل" type="email" id="ADemail" name="ADemail" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADgender">الجنس<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<select id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
											  <option value="Male">ذكر</option>
											  <option value="Female">انثى</option>
											</select>
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADaddress">العنوان <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required"  class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADphone">رقم الهاتف <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="+xxx-xxx-xxxxxx" title="رقم الهاتف" type="text" id="ADphone" name="ADphone" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										 
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ATimage">الصورة الشخصية
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

                      <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_image">ملف/صورة الهوية<span class="required" id="imgAstrik">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input accept="image/*,.doc,.docx,.pdf" title="ملف/صورة الهوية" type="file" id="id_image" name="id_image" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

                      <hr>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADsalary">الراتب <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الراتب" type="number" id="ADsalary" name="ADsalary" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
									
										  <div class="ln_solid"></div>
										  <div class="form-group">
											<div class="col-md-6 col-md-offset-3">
											  <button id="send" type="submit" onClick="validataddTeacher()" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
											  <a id="cancel" type="submit" href="" class="btn btn-primary"><i class="fa fa-times"></i> الغاء</a>
											</div>
										  </div>
										</form>
									</div>
										

    @endsection   