<?php
if($user->role == 'Doctor'){
  $href='doctor';
}
elseif($user->role == 'Secretary'){
  $href='secretary';
}
elseif($user->role == 'Pacient'){
  $href='pacient';
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

    <title>سجل المريض</title>
	
	 <script type="text/javascript" src="{{asset('js/managerJS.js')}}"></script>

    <!-- Bootstrap -->
    <link href="{{asset('../vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('../vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('../vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('../vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
	  <!-- Datatables -->
    <link href="{{asset('../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="{{asset('../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('../vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('../build/css/custom.min.css')}}" rel="stylesheet">
     <link href="{{asset('css/custumCSS.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>
                 @if($user->role == 'Pacient')
                  PalTabib
                @else
                  {{$clinic->name}}
                @endif
                </span></a>
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

             @elseif($user->role == "Pacient")
              @include('includes.patient_sidebar')
            @else

             @include('includes.manager_sidebar')

            @endif            <!-- /sidebar menu -->

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

            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                     
                      @if($user->role != "Pacient")
                      <a href="/dashboard/{{$href}}/patientsRecords" class="btn btn-round btn-success"> سجلات المرضى <i class="fa fa-arrow-left"></i></a>
                      @endif
                      
                    </ul>
                    <h2 class="pull-right">سجل المريض</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li id="firstTab" role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">المعلومات الشخصية</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">الملف المرضي</a>
                        </li>
                        <li id="thirdTab" role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">تاريخ العلاج</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                         
                          <div class="profile_img col-md-4 col-sm-12 col-xs-12 pull-right" style=" margin-top: 10px;">
                                <div id="crop-avatar" style="text-align:center;">
                                  <!-- Current avatar -->
                                    <img style="height: 319px;" class="img-responsive avatar-view" src="/images/users/{{$patient->image}}" alt="Avatar">
                                </div>
                              </div>
                        
                          <div class="col-md-8 col-sm-12 col-xs-12" style="top: 10px;">
                            <div style="text-align: center; font-size: 22px; top: 10px;">
                              {{$patient->name}}
                            </div>
                            
                            <ul class="list-group col-md-8 col-sm-12 col-md-offset-2" style="margin-top: 20px; font-size: 14px;">
                              <li class="list-group-item" title="رقم الهوية">
                                <i class="fa fa-id-card user-profile-icon"></i>{{$patient->user_name}}
                                </li>
                              <li class="list-group-item" title="الجنس">
                                <i class="fa fa-venus-mars user-profile-icon"></i>{{$patient->gender}}
                              </li>
                               <li class="list-group-item" title="متزوج؟">
                                <i class="fa fa-circle-o-notch user-profile-icon"></i>
                                  <?php
                                    if($patient->married){
                                      echo 'متزوج';
                                    }
                                    else{
                                       echo "غير متزوج";
                                    }

                                  ?>
                              </li>
                              <li class="list-group-item" title="العنوان">
                                <i class="fa fa-map-marker user-profile-icon"></i>{{$patient->address}}
                              </li>
                              <li class="list-group-item" title="الايميل">
                                <i class="fa fa-envelope user-profile-icon"></i>{{$patient->email}}
                              </li>
                              <li class="list-group-item" title="الهاتف">
                                <i class="fa fa-phone-square user-profile-icon"></i>{{$patient->phone}}
                              </li>
                              <li class="list-group-item" title="الوظيفة">
                                <i class="fa fa-suitcase user-profile-icon"></i>{{$patient->job}}
                              </li>
                              <li class="list-group-item" title="رقم التامين">
                                <i class="fa fa-sort-numeric-asc user-profile-icon"></i>{{$patient->ensurance_number}}
                              </li>
                            </ul>
                          </div>

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                        <div>
                           <div class="col-md-2 col-sm-12 col-md-offset-1 patientInfoMini">
                             <?php
                              if($patient->allergic){
                                echo '<i class="fa fa-check-square-o topIcons" aria-hidden="true"></i> <h1 class="iconText  ">يعاني من الحساسية</h1> ';
                              }
                              else{
                                echo '<i class="fa fa-square-o topIcons" aria-hidden="true"></i>  <h1 class="iconText  ">لا يعاني من الحساسية  </h1>';
                              }

                            ?>
                          </div>
                           <div class="col-md-2 col-sm-12 patientInfoMini">
                            <?php
                              if($patient->disability){
                                echo '<i class="fa fa-check-square-o topIcons" aria-hidden="true"></i> <h1 class="iconText">لديه اعاقة </h1> ';
                              }
                              else{
                                echo '<i class="fa fa-square-o topIcons" aria-hidden="true"></i>  <h1 class="iconText  ">ليس لديه اعاقة   </h1>';
                              }

                            ?>
                          </div>
                           <div class="col-md-2 col-sm-12 patientInfoMini">
                            <?php
                              if($patient->drugs){
                                echo '<i class="fa fa-check-square-o topIcons" aria-hidden="true"></i> <h1 class="iconText  ">يتعاطى المخدرات </h1> ';
                              }
                              else{
                                echo '<i class="fa fa-square-o topIcons" aria-hidden="true"></i>  <h1 class="iconText  ">لا يتعاطى المخدرات  </h1>';
                              }

                            ?>
                          </div>
                           <div class="col-md-2 col-sm-12 patientInfoMini">
                            <?php
                            if($patient->alcohol){
                              echo '<i class="fa fa-check-square-o topIcons" aria-hidden="true"></i> <h1 class="iconText  "> يشرب الكحول </h1> ';
                            }
                            else{
                              echo '<i class="fa fa-square-o topIcons" aria-hidden="true"></i>  <h1 class="iconText  ">لا يشرب الكحول</h1>';
                            }

                            ?>
                          </div>
                           <div class="col-md-2 col-sm-12 patientInfoMini" style="margin-bottom: 24px;">
                             <?php
                            if($patient->smoking){
                              echo '<i class="fa fa-check-square-o topIcons" aria-hidden="true"></i> <h1 class="iconText">يدخن </h1> ';
                            }
                            else{
                              echo '<i class="fa fa-square-o topIcons" aria-hidden="true"></i>  <h1 class="iconText">لا يدخن </h1>';
                            }

                            ?>
                          </div>
                        </div>
                          
                          
                          <div>
                            <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Demographic Details</div>
                              <div class="panel-body">
                                {{$patient->demo_details}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Past History (PH)</div>
                              <div class="panel-body">
                                {{$patient->past_history}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Presenting Complaint (PC)</div>
                              <div class="panel-body">
                                {{$patient->present_comp	}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">History of Presenting Complaint (HPC)</div>
                              <div class="panel-body">
                                {{$patient->history_of_comp}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Social History (SH)</div>
                              <div class="panel-body">
                                {{$patient->social_history}}
                              </div>
                            </div>
                          </div>

                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Drug History (DH)</div>
                              <div class="panel-body">
                                {{$patient->drug_history}}
                              </div>
                            </div>
                          </div><div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">General/On Examination (OE)</div>
                              <div class="panel-body">
                                {{$patient->on_exam}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Systematic Enquiry (SE)</div>
                              <div class="panel-body">
                                {{$patient->systematic_en}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Family History (FH)</div>
                              <div class="panel-body">
                                {{$patient->family_history}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12 col-md-offset-2">
                            <div class="panel panel-default">
                              <div class="panel-heading">Respiratory System (RS)</div>
                              <div class="panel-body">
                                {{$patient->respiratory_system}}
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="panel panel-default">
                              <div class="panel-heading">Cardiovascular System (CVS)</div>
                              <div class="panel-body">
                                {{$patient->cardio_system}}
                              </div>
                            </div>
                          </div>
                          </div>
                           

                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content33" aria-labelledby="profile-tab">
                          
                          <div class="x_content">
                            <ul class="list-unstyled timeline">
                              @foreach($histories as $history)
                              <li>
                                <div class="block">
                                  <div title="{{$history->created_at}}" class="tags">
                                    <a class="tag">
                                      <span>{{$history->created_at}}</span>
                                    </a>
                                  </div>
                                  <div class="block_content">
                                  @if($history->image)
                                     <div class="col-md-55" data="{{$history->image}}">
                                        <div class="thumbnail" style="max-height: 85px;margin-bottom: 0px;">
                                          <div class="image view view-first">
                                            <img style="max-height: 84; width: 100%; display: block;" src="/images/histories/{{$history->image}}" alt="image" />
                                            <div class="mask" style="height: 75px;">
                                              <p>اضغط للعرض</p>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                  @endif
                                  <div>
                                    @if($user->role=='Pacient')
                                     <h3 class="title">
                                            <a>الطبيب: {{$history->name}}</a>
                                        </h3>
                                     <h3 class="title">
                                            <a>العيادة: {{$history->clinic_name}}</a>
                                        </h3>
                                        @endif
                                    <h3 class="title">
                                            <a>المرض: {{$history->illness}}</a>
                                        </h3>
                                         <h3 class="title">
                                            <a>العلاج: {{$history->treatment}}</a>
                                        </h3>
                                        @if($history->notes)
                                          <h2 class="excerpt">الملاحظات: {{$history->notes}}
                                          </h2>
                                         @endif
                                        
                                  </div>
                                    
                                      </div>
                                    </div>
                                  </li>
                                  @endforeach
                                </ul>
                                {{$histories->links()}}
                              </div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              <div class="clearfix"></div>
            
          </div>
        </div>
        <!-- /page content -->
        
		

        <!-- footer content -->
        @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>

<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" style=" text-align: center;">
        <img id="imageInModal" src="" alt="image" style="width:100%; max-height: 400px;"/>
      </div>
    </div>
  </div>
</div>

    <!-- jQuery -->
    <script src="{{asset('../vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('../vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('../vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('../vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('../vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('../vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('../vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->  

    <script src="{{asset('../vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('../vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('../vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('../vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('../vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('../vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('../vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('../vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('../vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	  <!-- Datatables -->
    <script src="{{asset('../vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('../vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('../vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('../vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('../build/js/custom.min.js')}}"></script>
    <script src="{{asset('../js/managerJS.js')}}"></script>
    <script type="text/javascript">
    
      $(document).ready(function()
        {
          var href = document.URL;
          if(href.indexOf("histories") >= 0){
            $('#tab_content33').addClass('active in');
            $('#firstTab').removeClass('active');
            $('#thirdTab').addClass('active');
            $('#tab_content11').removeClass('active in');

          }
          $('.col-md-55').on('click',function(){
                var image_name = $(this).attr('data');
                $('#imageInModal').attr('src','/images/histories/'+image_name);
                $('#imageModal').modal('show');
          });
        });
    </script>
	
  </body>
</html>