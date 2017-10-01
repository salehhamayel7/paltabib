@extends('patient.layouts.master')

@section('content')

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

        
    <!-- selectpicker -->
    <link href="{{asset('vendors/bootstrap-select-master/dist/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <!-- FullCalendar -->
    <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/fullcalendar/dist/fullcalendar.print.css')}}" rel="stylesheet" media="print">

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
                 
                  <div class="x_content">

                    <div id='calendar'></div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

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
              <form id="antoform" class="form-horizontal calender" role="form" method="POST" action="/pactient/appointment/create">
                {{ csrf_field() }}
                <input type="hidden" name="date" id="newEventDate">
                <input type="hidden" name="patient" value="{{$user->user_name}}">
                
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
                    <input type="number" name="duration" value="10" class="form-control">
                  </div>
                  <label class="col-sm-3 control-label">مدة الموعد(دقيقة)</label>
                </div>

               <div class="form-group">
                  <div class="col-sm-9">
                    <select data-size="5" class="selectpicker form-control" data-live-search="true" name="doctor_id" required="required">
                      
                      @foreach($doctorS as $doctor)
                         <option value="{{$doctor->user_name}}">{{$doctor->name}} ({{$doctor->user_name}})</option>
                      @endforeach
                    </select>

                  </div>
                  <label class="col-sm-3 control-label">الطبيب</label>
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
                    <input type="number" id="duration" name="duration" value="10" class="form-control">
                  </div>
                  <label class="col-sm-3 control-label">مدة الموعد(دقيقة)</label>
                </div>

               <div class="form-group">
                  <div class="col-sm-9">
                    <a id="patientLink">
                      <input type="text" class="form-control" id="Eventdoctor" name="doctor_id" readonly>
                    </a>
                    
                  </div>
                  <label class="col-sm-3 control-label">الطبيب</label>
                </div>

                 <div class="col-md-9" style="font-size: 16px;">
                    <label id="notapprover">
                      <i class="fa fa-times fa-lg" style="color:red;" aria-hidden="true"></i> لم يتم تاكيده
                    </label>

                     <label id="approver">
                      <i class="fa fa-check fa-lg" style="color:green;" aria-hidden="true"></i> تم تاكيده
                    </label>
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
   
    
@endsection
