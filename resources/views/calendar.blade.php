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

    <title>الحجوزات</title>

   
    <!-- selectpicker -->
    <link href="{{asset('vendors/bootstrap-select-master/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">

  @include('includes.links')

  </head>

  <body class="nav-md" dir="rtl">
    <input type="hidden" id="userType" value="{{$href}}">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span> PalTabib</span></a>
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
               @elseif($user->role == "Pacient")
              @include('includes.patient_sidebar')
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
            <div class="page-title">
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <h2 style="float:right;">التقويم <small> اضغط للاضافة والتعديل </small></h2>
                    <div class="clearfix"></div>
                  </div>
                  @if($href=="secretary" || $href=="pacient")
                  <div class="row" style="text-align: center; margin: 20px;">
                    <label for="doctorCal" style="display: inline-block; font-size: 19px; position: relative; top: 4px;">الطبيب</label>
                  <select title="اختر الطبيب لعرض تقويمه" name="doctorCal" id="doctorCal" class="selectpicker  col-md-4  col-sm-12" data-live-search="true">
                    @foreach($doctorS as $doctor)
                         <option value="{{$doctor->user_name}}">{{$doctor->name}} ({{$doctor->user_name}})</option>
                      @endforeach
                  </select>
                  </div>
                  @endif
                  <div class="x_content">

                    <div id='calendar'></div>

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
</div>
    <!-- calendar modal -->
    <div id="CalenderModalNew" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close pull-left" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title pull-right" id="myModalLabel">اضافة موعد جديد</h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form" method="POST" action="/appointment/create">
                {{ csrf_field() }}
                <input type="hidden" name="date" id="newEventDate">
                <input type="hidden" name="doctor_id" id="doctor_id">
                <div class="form-group">
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" name="title" required="required">
                      <option value="#26B99A">موعد جديد</option>
                      <option value="#3a87ad">مراجعة</option>
                    </select>
                  </div>
                  <label class="col-sm-3 control-label">العنوان</label>
                </div>

                <div class="form-group">
                  <div class="col-sm-9">
                    <input type="time" name="time" value="09:00" class="form-control">
                  </div>
                  <label class="col-sm-3 control-label">الوقت</label>
                </div>

               <div class="form-group">
                  <div class="col-sm-9">
                    <select data-size="5" class="selectpicker form-control" data-live-search="true" name="patient" required="required">
                      @if($href == "pacient")
                        <option value="{{$user->user_name}}">{{$user->name}} ({{$user->user_name}})</option>
                      @else
                      @foreach($patients as $patient)
                         <option value="{{$patient->user_name}}">{{$patient->name}} ({{$patient->user_name}})</option>
                      @endforeach
                      @endif
                    </select>

                  </div>
                  <label class="col-sm-3 control-label">المريض</label>
                </div>
              
            </div>
          </div>
          <div class="modal-footer">
            <div class="pull-left">
               <button type="button" class="btn btn-default antoclose" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-success antosubmit">حفظ الموعد</button>
          </div>
           
           </form>
        </div>
      </div>
    </div>
</div>
    <div id="CalenderModaledit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close pull-left" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 class="modal-title pull-right" id="myModalLabel">تعديل الموعد </h4>
          </div>
          <div class="modal-body">
            <div id="testmodal" style="padding: 5px 20px;">
              <form id="antoform" class="form-horizontal calender" role="form" method="POST" action="/appointment/edit">
                {{ csrf_field() }}
                <input type="hidden" name="date" id="editEventDate">
                <input type="hidden" name="appoinmentID" id="appoinmentID">
                <div class="form-group">
                  <div class="col-sm-9">
                    <select class="selectpicker form-control" id="Eventtitle" name="title" required="required">
                      <option value="#26B99A">موعد جديد</option>
                      <option value="#3a87ad">مراجعة</option>
                    </select>
                  </div>
                  <label class="col-sm-3 control-label">العنوان</label>
                </div>

                <div class="form-group">
                  <div class="col-sm-9">
                    <input type="time" id="Eventtime" name="time" value="09:00" class="form-control">
                  </div>
                  <label class="col-sm-3 control-label">الوقت</label>
                </div>

               <div class="form-group">
                  <div class="col-sm-9">
                    <a href="/dashboard/{{$href}}/record/" title="سجل المريض" id="patientLink">
                      <input type="text" class="form-control" id="Eventpatient" name="patient" readonly>
                    </a>
                    
                  </div>
                  <label class="col-sm-3 control-label">المريض</label>
                </div>
              
            </div>
          </div>
          <div class="modal-footer">
            <i title="حذف" class="fa fa-trash fa-lg deleteEvent"></i>
            <div class="pull-left">
              <button type="button" class="btn btn-default antoclose" data-dismiss="modal">اغلاق</button>
              <button type="submit" class="btn btn-success antosubmit">حفظ التغييرات</button>
          </div>
           
           </form>
        </div>
      </div>
    </div>
   </div>
   
    <!-- /calendar modal -->

     @include('includes.scrtipts_src')

    <!-- selectpicker -->
    <script src="{{asset('../vendors/bootstrap-select-master/dist/js/bootstrap-select.min.js')}}"></script>
    <!-- FullCalendar -->
    <script src="{{asset('../vendors/fullcalendar/dist/fullcalendar.min.js')}}"></script>

     @if($user->role == "Doctor")

      <script src="{{asset('../js/full-calendar-doc.js')}}"></script>

            @elseif($user->role == "Secretary")
              <script src="{{asset('../js/full-calendar-sec.js')}}"></script>
               @elseif($user->role == "Pacient")
              <script src="{{asset('../js/full-calendar-pat.js')}}"></script>
              
            @else

             <script src="{{asset('../js/full-calendar-doc.js')}}"></script>

            @endif
    
    
  </body>
</html>