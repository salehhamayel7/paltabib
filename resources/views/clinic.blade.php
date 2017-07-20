<?php

use App\User;

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

    <title>عيادتي </title>

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
            <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> عدد المواعيد </span>
              <div class="count green">{{$appointments_count}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> عدد الاحداث </span>
              <div class="count green">{{$events_count}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> عدد المرضى</span>
              <div class="count green">{{$patients_count}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> عدد الممرضين</span>
              <div class="count green">{{$nurses_count}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> عدد السكرتاريا</span>
              <div class="count green">{{$secretaries_count}}</div>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> عدد الاطباء</span>
              <div class="count green">{{$doctors_count}}</div>
            </div>
          </div>
          <!-- /top tiles -->
            <div class="clearfix"></div>
              <div class="row">
              <div class="col-md-12"style="width: 100%;">
                <div class="x_panel">
                  <div class="x_title">

                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                      <h2 style="float:right;">  تعديل معلومات العيادة <small><a id="get-id"> عرض/تحميل اثبات تسجيل العيادة </a></small></h2>
                      <form id="id-form" method="get" action="/file/download/{{$clinic->reg_proof}}">
                          </form>
                          
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" >

                            <form id="addBillsForm" action="/ajax/clinic/update" method="post" class="form-horizontal form-label-left col-md-8 col-md-offset-2 col-sm-12" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                              <div class="item form-group">
                              
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input value="{{$clinic->name}}" title="اسم العيادة" type="text" id="clinic_name" name="clinic_name" required="required"  class="form-control col-md-7 col-xs-12">
                              </div>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_name">
                                اسم العيادة
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input value="{{$clinic->address}}" title="العنوان" type="text" id="clinic_address" name="clinic_address" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_address">
                                 العنوان
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input value="{{$clinic->phone}}" title="الهاتف" type="text" id="clinic_phone" name="clinic_phone" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_phone">
                                 الهاتف
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="الهاتف" accept="image/*,.doc,.docx,.pdf" id="reg_proof" type="file" name="reg_proof" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_phone">
                                 اثبات تسجيل العيادة
                              </label>
                              </div>
                       
                              <div class="ln_solid"></div>
                              <div class="form-group">
                              <div class="col-md-6">
                                <button id="saveBill" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ التغييرات </button>
                              </div>
                              </div>
                            </form>
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
<!-- Switchery -->
    <script src="{{asset('../vendors/switchery/dist/switchery.min.js')}}"></script>
    
    <script type="text/javascript">
      $(document).ready(function(){

         $('#get-id').on('click',function(){
               $('#id-form').submit();
            });
         
      });
    </script>
  </body>
</html>
