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

    <title>الممرضين</title>

   @include('includes.Datatables_links')
    @include('includes.links')
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title navbar-fixed-top" style="border: 0;">
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
            @if($user->role == "Doctor")

             @include('includes.doctor_sidebar')

            @elseif($user->role == "Secretary")
              @include('includes.secretary_sidebar')
            @else

             @include('includes.manager_sidebar')

            @endif

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
									<li><a onclick="replaceContentToAddN()" title = "اضافة ممرض/ـة"><i class="fa fa-plus fa-lg"></i></a>
									  </li>


									</ul>
									<h2 style="float:right;">ادارة الممرضين</h2>
								
									<div class="clearfix"></div>
								  </div>
                  <div class="x_content" id="page_contentN">

                    <table dir="rtl" id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>رقم الهوية</th>
                          <th>الاسم</th>
                          <th>الايميل</th>
                          <th>العنوان</th>
                          <th>الهاتف</th>
                          <th>الجنس</th>
            						  <th>الراتب</th>
            						  <th></th>
                        </tr>
                      </thead>


                      <tbody>

                     @foreach($nurses as $nurse)
                       <tr>
                          <th>{{ $nurse->user_name }}</th>
                          <th>{{ $nurse->name }}</th>
                          <th>{{ $nurse->email }}</th>
                          <th>{{ $nurse->address }}</th>
                          <th>{{ $nurse->phone }}</th>
                          <th>{{ $nurse->gender }}</th>
                          <th>{{ $nurse->salary }}</th>
                         
                          <th>
                          <a id="editNurse" onclick = "" data="{{ $nurse->user_name }}" class="btn btn-success btn-xs editNurse"><i class="fa fa-edit"></i> تعديل </a>

                          <a id="deleteNurse" href="/ajax/delete/nurse/{{ $nurse->user_name }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> حذف </a>
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




									<div id="addNurse" style="display:none;">
										<form id="addNurseform" method="POST" action="/nurses/create" class="form-horizontal form-label-left" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="ADclinic" value="{{$clinic->id}}">
										  <span dir="rtl" class="section">اضف معلومات الممرض</span>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADName">الاسم <span class="required">*</span>
											</label>
											<div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" name="ElevelName" required="required" type="text">
											</div>

										  </div>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADuName"> رقم الهوية <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="اسم المستخدم" type="number" id="ADuName" name="ADuName" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADpass">كلمة السر <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="كلمة السر" type="password" id="ADpass" name="ADpass" required="required" class="form-control col-md-7 col-xs-12" data-validate-minmax="6,100">
											</div>
										  </div>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADemail">الايميل <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الايميل" type="email" id="ADemail" name="ADemail" required="required" class="form-control col-md-7 col-xs-12">
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
											  <input placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADphone">رقم الهاتف <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input placeholder="xxxxxxxxx" title="رقم الهاتف" type="number" id="ADphone" name="ADphone" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

                      <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ATimage">الصورة الشخصية <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                      </div>
                      </div>

                      <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADsalary">الراتب <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الراتب" type="number" id="ADsalary" name="ADsalary" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

										  <div class="ln_solid"></div>
										  <div class="form-group">
											<div class="col-md-6 col-md-offset-3">
											  <button id="send" type="submit" onClick="" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
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
           
           $('.editNurse').on('click',function(){
                var user_name = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/edit/nurse/"+user_name,function(data){
                   // alert(data.user.name);
                     $('#ADName').val(data.user.name);
                     $('#ADuName').val(data.user.user_name);
                         
                     $('#ADemail').val(data.user.email);
                     $('#ADgender').val(data.user.gender);
                     $('#ADaddress').val(data.user.address);
                     $('#ADphone').val(data.user.phone);
                     $('#ADsalary').val(data.nurse.salary);
             
                 });

                replaceContentToAddN();

                $('#ADpass').removeAttr("required");
                $('#passDev').hide();
                $('#imgAstrik').hide();
                $('#ATimage').removeAttr("required");
                $("#send").attr("onClick","");
                $("#send").html("تعديل");
                $("#addNurseform").attr("action","/nurse/update/"+user_name);

            });

        });

    </script>

  </body>
</html>
