<?php
use App\User;
use App\Doctor;
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

    <title>الصفحة الرئيسية</title>
    
    @include('includes.links')
    @include('includes.Datatables_links')
    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{asset('../vendors/bootstrap-select-master/dist/css/bootstrap-select.min.css')}}">

  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view" >
            <div class="navbar nav_title navbar-fixed-top" style="border: 0;">
              <a href="/dashboard/{{$href}}" class="site_title"><img style="max-height: 50px;" src="/images/clinics_logos/{{$clinic->logo}}"></img> <span>{{$clinic->name}}</span></a>
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
            @include('includes.doctor_sidebar')

            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
             @include('includes.menu-footer')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
           @include('includes.topNav')
        <!-- /top navigation -->


        @yield('content')


        <!-- footer content -->
       @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>
    @include('includes.scrtipts_src')


    <?php
        $url =  $_SERVER['REQUEST_URI'];

       if (strpos($url, 'inbox') !== false) {
        ?>
            @include('shared.scripts.inbox_script')
        <?php
        }
        else if (strpos($url, 'outbox') !== false) {
        ?>
            @include('shared.scripts.outbox_script')
        <?php
        }
        else if (strpos($url, 'pacients') !== false) {
        ?>
            @include('includes.Datatables_scripts')
            @include('shared.scripts.patients_script')
        <?php
        }
        else if (strpos($url, 'patientsRecords') !== false) {
        ?>
            @include('includes.Datatables_scripts')
            @include('shared.scripts.patientsRecords_script')
        <?php
        }
        
        else if (strpos($url, 'record') !== false) {
        ?>
            @include('shared.scripts.record_script')
        <?php
        }
        else if (strpos($url, 'calendar') !== false) {
        ?>
         
          <!-- FullCalendar -->
          <script src="{{asset('../vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>
          <script src="{{asset('../js/full-calendar-doc.js')}}"></script>
        <?php
        }
        else if (strpos($url, 'money') !== false) {
             ?>  
                @include('doctor.scripts.money_script')

            <?php
        }
        else{
        ?>  
            @include('doctor.scripts.home_script')

        <?php
        }
    ?>
    <!-- selectpicker -->
    <script src="{{asset('../vendors/bootstrap-select-master/dist/js/bootstrap-select.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/managerJS.js')}}"></script>

  </body>
</html>

