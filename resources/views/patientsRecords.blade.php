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

    <title>السجلات والمراجعات</title>
	
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
            @if($user->role == 'Doctor')

             @include('includes.doctor_sidebar')

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
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                    </ul>
                    <h2 class="pull-right"> ادارة السجلات والمراجعات</h2>
                    <div class="clearfix"></div>
                    
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">مراجعة جديدة</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">سجلات المرضى</a>
                        </li>
                        
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          <form action="/history/add" method="POST" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="patient">المريض
                              </label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                              <select required="required" id="patient" name="patient" class="form-control col-md-7 col-xs-12">
                                @foreach($patients as $patient)
                                  <option value="{{$patient->user_name}}">{{$patient->name}} ({{$patient->user_name}})</option>
                                @endforeach
                              </select>
                              </div>
                              </div>

                             <div class="item form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="illness">المرض 
                              </label>
                              <div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
                                <input title="المرض" name="illness" id="illness" class="form-control col-md-7 col-xs-12" required="required" type="text">
                              </div>
                              </div>
                            
                              
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="treatment">العلاج 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input title="العلاج" type="text" id="treatment" name="treatment" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="notes">ملاحظات 
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <textarea style="resize: vertical;" title="ملاحظات" type="text" id="notes" name="notes" class="form-control col-md-7 col-xs-12">
                                  </textarea>
                                </div>
                              </div>
                            
                              
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ATimage">صورة
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="file" accept="image/*" id="ATimage" name="ATimage" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              

                            
                              <div class="ln_solid"></div>
                              <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="editInfo" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضافة مراجعة </button>
                              </div>
                              </div>
                          </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                          
                          <div class="col-md-12 col-sm-12 col-xs-12">
                            <h4>اضغط لعرض السجل</h4>

                            <div class="x_panel">
                            
                             
                              <div class="x_content" id="page_contentP">
                                <table dir="rtl" id="datatable-buttons" class="table table-striped table-bordered">
                                  <thead>
                                    <tr>
                                      <th>رقم الهوية</th>
                                      <th>الاسم</th>
                                      <th>الجنس</th>
                                      <th>الايميل</th>
                                      <th>مكان السكن/العنوان</th>
                                      <th>الهاتف</th>
                                      <th>الوظيفة</th>
                                      <th>الرقم التامين</th>
                                     
                                    </tr>
                                  </thead>


                                  <tbody>
                                  
                                    @foreach($pacients as $patient)
                                      <tr class="viewRecord" data="{{$patient->user_name}}" title="عرض السجل">
                                          <th>{{ $patient->user_name }}</th>
                                          <th>{{ $patient->name }}</th>
                                          <th>{{ $patient->gender }}</th>
                                          <th>{{ $patient->email }}</th>
                                          <th>{{ $patient->address }}</th>
                                          <th>{{ $patient->phone }}</th>
                                          <th>{{ $patient->job }}</th>
                                          <th>{{ $patient->ensurance_number }}</th>
                                        
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
                </div>
              </div>
            
          </div>
        </div>
        <!-- /page content -->
		
		

        <!-- footer content -->
        @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>
@include('includes.scrtipts_src')
  @include('includes.Datatables_scripts')


    <script type="text/javascript">
      $(document).ready(function()
        {

            $('.viewRecord').on('click',function(){
              var user_name = $(this).attr('data');
              var href=(document.URL).replace("patientsRecords", "record/"+user_name);
              window.location.href=href;
              //location.reload();
            });

        });


    </script>
	
  </body>
</html>