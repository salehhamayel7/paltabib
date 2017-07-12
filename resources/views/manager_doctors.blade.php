<?php
if($user->role == 'Doctor'){
  $href='doctor';
}
elseif($user->role == 'Secretary'){
  $href='secretary';
}
else{
  $href='manager';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>الاطباء</title>
	

    
	 @include('includes.Datatables_links')
    @include('includes.links')
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>{{$clinic->name}}</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_info">
                <h2>مرحبا</h2>
                <h2>{{$user->name}}</h2>
              </div>
			        <div class="profile_pic">
                <img src="/images/users/{{$user->image}}" alt="..." class="img-circle profile_img">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
                       @include('includes.manager_sidebar')

            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
             @include('includes.menu-footer')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
                  @include('includes.topNav')

        <!-- /top navigation -->

        <!-- page content -->
		 <div class="right_col" role="main">
          <div class="">
            

            <div class="clearfix"></div>

            <div class="row">
              


              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
									
									<ul class="nav navbar-left panel_toolbox">
									 <li><a></a>
									  </li>
									 <li><a id = "collapse2" class="collapse-link" title = "hide/show"><i class="fa fa-chevron-up fa-lg"></i></a>
									  </li>
									<li><a onclick="replaceContentToAddD()" title = "اضافة طبيب"><i class="fa fa-plus fa-lg"></i></a>
									  </li>
									 
									 
									</ul>
									<h2 style="float:right;">ادارة الاطباء</h2>
									<script>
										window.onload = function(){
										
											document.getElementById('collapse2').click();
											document.getElementById('collapse2').click();
										};
									</script>
									<div class="clearfix"></div>
								  </div>
                  <div class="x_content" id="page_contentD">
                   
                    <table dir="rtl" id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>رقم الهوية</th>
                          <th>الاسم</th>
                          <th>الايميل</th>
                          <th>العنوان</th>
                          <th>الهاتف</th>
                          <th>التخصص</th>
                          <th>الراتب</th>
                          <th>الرقم النقابي</th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($doctors as $doctor)
                        <tr>
						            <th>{{$doctor->user_name}}</th>
                          <th>{{$doctor->name}}</th>
                          <th>{{$doctor->email}}</th>
                          <th>{{$doctor->address}}</th>
                          <th>{{$doctor->phone}}</th>
                          <th>{{$doctor->major}}</th>
                          <th>{{$doctor->salary}}</th>
                          <th> {{$doctor->union_number}}</th>
                          <th>
                          <a id="editDoctor" data="{{$doctor->user_name}}"  class="btn btn-success btn-xs editDoctor"><i class="fa fa-edit"></i> تعديل </a>
                                
                          <a href="/doctor/delete/{{$doctor->user_name}}" onclick="" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> حذف </a>
                                
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
		
		
		
		
									<div id="addDoctor" style="display:none;">										
										<form id="addDoctorform" method="post" action="/dashboard/manager/addDoctor" class="form-horizontal form-label-left" enctype="multipart/form-data">
										  <span dir="rtl" class="section">اضف معلومات الطبيب</span>
										  <input type="hidden" name="_token" value="{{csrf_token()}}">
                      <input type="hidden" name="ADclinic" value="{{ $clinic->id }}">
                    
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADName">الاسم <span class="required">*</span>
											</label>
											<div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" data-validate-length-range="15" data-validate-words="1"  required="required" type="text">
											</div>
											
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADuName">(رقم الهوية)اسم المستخدم<span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="اسم المستخدم" type="number" id="ADuName" name="ADuName" required="required"  class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group" id="passDev">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADpass">كلمة السر <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="كلمة السر" type="password" id="ADpass" name="ADpass" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADemail">الايميل <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input  title="الايميل" type="email" id="ADemail" name="ADemail" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADgender">الجنس<span class="required" required="required">*</span>
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
											  <input placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADphone">رقم الهاتف <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="رقم الهاتف" type="number" id="ADphone" name="ADphone" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ATimage">الصورة الشخصية <span class="required" id="imgAstrik">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" required="required" class="form-control col-md-7 col-xs-12" value="User_Avatar-512.png">
											</div>
										  </div>
                      <hr/>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADmajor">التخصص <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="مثال: اسنان" title="التخصص" type="text" id="ADmajor" name="ADmajor" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADsalary">الراتب <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الراتب" type="number" id="ADsalary" name="ADsalary" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADnumber">الرقم النقابي <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الرقم النقابي" type="number" id="ADnumber" name="ADnumber" required="required" data-validate-minmax="10,100" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="ln_solid"></div>
										  <div class="form-group">
											<div class="col-md-6 col-md-offset-3">
											  <button id="send" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
											  <a id="cancel" type="submit" href="" class="btn btn-primary"><i class="fa fa-times"></i> الغاء</a>
											</div>
										  </div>
										</form>
										</div>
										

        <!-- footer content -->
       @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>
@include('includes.scrtipts_src')
  @include('includes.Datatables_scripts')

    	  <script type="text/javascript" src="{{asset('js/managerJS.js')}}"></script>

    <script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.editDoctor').on('click',function(){
            var user_name = $(this).attr('data');
            
             $.get("/ajax/edit/doctor/"+user_name,function(data){
               
                $('#ADName').val(data.user.name);
                $('#ADuName').val(data.user.user_name); 
                $('#ADemail').val(data.user.email);
                $('#ADgender').val(data.user.gender);
                $('#ADaddress').val(data.user.address);
                $('#ADphone').val(data.user.phone);
                $('#ADmajor').val(data.doctor.major);
                $('#ADsalary').val(data.doctor.salary);
                $('#ADnumber').val(data.doctor.union_number);

             });
            replaceContentToAddD();
            $('#ADpass').removeAttr("required");      
            $('#ATimage').removeAttr("required");
            $("#send").attr("onClick","");
            $("#send").html("تعديل");
            $("#addDoctorform").attr("action","/doctor/update/"+user_name);

               });

        });


    </script>
	
  </body>
</html>