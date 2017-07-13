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


    <!-- bootstrap-progressbar -->
    <link href="{{asset('vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
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
          <div class="page-content">
           
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li> 
                    </ul>
					
					        <h2 style="float:right;"> لوحة التحكم </h2>
					 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
				  <div class="col-md-9 col-sm-9 col-xs-12">

             <div class="row top_tiles">
                <div style="float:left;" class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                  <a href="/dashboard/manager/inbox">
                    <div class="tile-stats">
                  <h3>الرسائل </h3>
                   <div class="count">{{count($new_msgs)}}</div>
                  <div class="icon"><i class="fa fa-comments"></i></div>
                  <p>يوجد {{count($new_msgs)}} رسائل جديدة </p>
                </div>
			        	</a>
              </div>

              <div style="float:right;" class="animated flipInY col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <a href="#home_press">
                  <div class="tile-stats">
                <h3>احداث اليوم</h3>
                <div class="count">{{$events_number}}</div>
                    <div class="icon"><i class="fa fa-check-square-o"></i></div>
                    <p>يوجد {{$events_number}} احداث لليوم</p>
                </div>
				        </a>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">

                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
					            <h2 style="float:right;">ملخص مالي للشهر الحالي</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">


                      <div class="col-md-6">
                        <div class="row" style="text-align: left;">
							            <div style="text-align: center; margin-bottom: 17px">
                              <ul class="verticle_bars list-inline">
                                <li onclick="window.location.href = '/dashboard/manager/allBills';">
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-info" role="progressbar" data-transitiongoal="<?php echo $billsPercentage ?>"></div>
                                  </div>
                                </li>
                                <li onclick="window.location.href = '/dashboard/manager/allExpenses';">
                                  <div class="progress vertical progress_wide bottom">
                                    <div class="progress-bar progress-bar-success" role="progressbar" data-transitiongoal="<?php echo $expencesPercentage ?>"></div>
                                  </div>
                                </li>
                              </ul>
                            </div>
							          <div class="divider"></div>

                            <ul class="legend list-unstyled">

                              <li onclick="window.location.href = '/dashboard/manager/allBills';">
                                <p>
                                  <span class="icon"><i class="fa fa-square blue"></i> <?php echo $billsPercentage."%"; ?></span> <span class="name">الدخل</span>
                                </p>
                              </li>
                              <li onclick="window.location.href = '/dashboard/manager/allExpenses';">
                                <p>
                                  <span class="icon"><i class="fa fa-square green"></i> <?php echo $expencesPercentage."%"; ?></span> <span class="name">المصروفات</span>
                                </p>
                              </li>
                            </ul>

							        </div>
                      </div>
                      <div class="col-md-6 col-sm-12">
					              <h3 style="margin:18px; float:right;">التقدم المالي الشهري</h3>
                      </div>
                         <a style="font-size: 17px;" href="/dashboard/manager/money" class="btn btn-success btn-lg moneyBTN"> انتقل للمالية للمزيد </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>            


                      <div id="showArea" class="" role="tabpanel" data-example-id="togglable-tabs" style="margin-bottom: 100px;">
                        <ul id="myTab" class="nav nav-tabs bar_tabs right" role="tablist">
                          <li id="home_press" role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">الاحداث</a>
                          </li>
                           @if($user->role == "Manager,Doctor")
                          <li id="x_press" role="presentation" class=""><a href="#tab_content3" role="tab" id="x-tab" data-toggle="tab" aria-expanded="false">المواعيد  </a>
                          </li>
                          @endif
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">تعديل المعلومات الشخصية</a>
                          </li>
                         
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div dir="rtl" role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                              <div class="row">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                              <div class="x_panel">
                                <div class="x_title">

                                  <ul class="nav navbar-left panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                  </ul>
                                <h2 style="float:right;"> الاحداث القادمة</h2>
                                  <div class="clearfix"></div>
                                </div>
                                  
                                <div class="x_content">
                                  @foreach($nextEvents as $event)
                                  <article class="media event">
                                    <button data="{{$event->id}}" title="حذف" type="button" class="close pull-left deleteEvent">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                    <div data="{{$event->id}}" class="editEvent" title="تعديل">
                                      <a class="pull-left">
                                        {{$event->date}}
                                      </a>

                                      <a class="pull-left">
                                        {{$event->time}}
                                      </a>
                                      <div class="media-body">
                                        <a class="title">{{$event->event_name}}</a>
                                        <p>{{$event->event_description}}</p>
                                      </div>
                                    </div>
                                  </article>
                                  <hr>
                                @endforeach
                              
                                </div>
                                {{$today_events->links()}}
                              </div>
                            </div>

                           <div class="col-md-6 col-sm-12 col-xs-12">
                              <div class="x_panel">
                                <div class="x_title">

                                  <ul class="nav navbar-left panel_toolbox">
                                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                    </li>
                                  </ul>
                                <h2 style="float:right;">احداث اليوم</h2>
                                  <div class="clearfix"></div>
                                </div>
                                  
                                <div class="x_content">
                                  @foreach($today_events as $event)
                                  <article class="media event editEvent" data="{{$event->id}}" title="تعديل">
                                    <a class="pull-left">
                                      {{$event->time}}
                                    </a>
                                    <div class="media-body">
                                      <a class="title">{{$event->event_name}}</a>
                                      <p>{{$event->event_description}}</p>
                                    </div>
                                  </article>
                                  <hr>
                                @endforeach
                              
                                </div>
                                {{$today_events->links()}}
                              </div>
                            </div>
                                
                              </div>
                           

                            <!-- end recent activity -->
                            <div class="col-md-6 pull-right">
                               <a data-toggle="modal" data-target="#addEventModal" class="btn btn-success"> اضافة حدث </a>
                            </div>
                          </div>

                           @if($user->role == "Manager,Doctor")
                          <div dir="rtl" role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="x-tab">
                          <div class="col-md-7">
                            <div class="x_panel">
                            <div class="x_title">

                            <ul class="nav navbar-left panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                            </ul>
                            <h2 style="float:right;">مواعيد بانتظار التاكيد</h2>
                            <div class="clearfix"></div>
                          </div>
                            <div class="x_content">

                              <table class="table table-striped cc">
                                <thead>
                                  <tr>
                                    
                                    <th>اسم المريض</th>
                                    <th>التاريخ</th>
                                    <th>الوقت</th>
                                    <th>خيارات</th>
                                  </tr>
                                </thead>
                                <tbody>

                                  @foreach($appointmentsx as $appointment)
                                  <tr>
                                  <?php  $pacientx = User::where('user_name' ,'=', $appointment->pacient_id)->first(); ?>
                                    <td>{{$pacientx->name}}</td>
                                    <td>{{$appointment->date}}</td>
                                    <td>{{$appointment->time}}</td>
                                    <th>
                                      <button data="{{$appointment->id}}" type="button" class="btn btn-success btn-sm approveAppointment">تاكيد</button>
                                      <button data="{{$appointment->id}}" type="button" class="btn btn-danger btn-sm disapprovedAppointment">الغاء</button>
                                    </th>
                                  </tr>
                                  @endforeach
                                </tbody>
                              </table>
                              </div>
                            </div>
                          </div>

                <div class="col-md-5">
                <div class="x_panel">
                  <div class="x_title">

                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
					          <h2 style="float:right;">مواعيد اليوم</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div id="todaysAppointments" class="x_content">
                     @foreach($appointments as $appointment)

                    <article class="media event">
                      <a class="pull-left">
                        {{$appointment->time}}
                      </a>
                      <div class="media-body">
                        <?php  $pacientx = User::where('user_name' ,'=', $appointment->pacient_id)->first(); ?>
                        <a class="title">{{$pacientx->name}}</a>
						            <button id="cancelAppointment" data="{{$appointment->id}}" type="button" class="btn btn-danger btn-xs cancelAppointment">الغاء</button>
                      </div>
                    </article>
                    <hr/>
                  @endforeach
                  </div>
                  {{$appointments->links()}}
                </div>
              </div>
                 
                          </div>   
                          @endif                       
                          <div dir="rtl" role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                           <form id="editManager" method="post" action="/manager/edit" class="form-horizontal form-label-left" enctype="multipart/form-data">
										  		<input value="{{$user->user_name}}" type="hidden" name="originalUN">
                          {{ csrf_field() }}
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADName">الاسم 
											</label>
											<div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
											  <input value="{{$user->name}}" placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" required="required" type="text">
											</div>
											
										  </div>
										
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADemail">الايميل 
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input value="{{$user->email}}" title="الايميل" type="email" id="ADemail" name="ADemail" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

                      <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADuName">رقم الهوية
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input value="{{(int)$user->user_name}}" title="رقم الهوية" type="number" id="ADuName" name="ADuName" required="required" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>

                      <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADpass">كلمة المرور 
											</label>
											<div style="float:center;" class="col-md-6 col-sm-6 col-xs-12">
											  <input title="كلمة المرور" name="ADpass" id="ADpass" class="form-control col-md-7 col-xs-12" type="password">
											</div>
											
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADgender">الجنس
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<select value="{{$user->gender}}" id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
                        <?php

                            if($user->gender == "Male"){
                              echo '<option value="Male" selected>ذكر</option>';
                            }
                            else{
                               echo '<option value="Male">ذكر</option>';
                            }


                            if($user->gender == "Female"){
                              echo '<option value="Female" selected>انثى</option>';
                            }
                            else{
                               echo '<option value="Female">انثى</option>';
                            }
                        ?>
                        
											</select>
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADaddress">العنوان/مكان السكن 
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input value="{{$user->address}}" placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADphone">رقم الهاتف 
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input value="{{(int)$user->phone}}" title="رقم الهاتف" type="number" id="ADphone" name="ADphone" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
										  
										  <div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="ATimage">الصورة الشخصية 
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											  <input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
											</div>
										  </div>
                      

											  <input type="hidden" value="{{$user->role}}" name="role">
                        <?php
                          if($user->role == "Manager,Doctor"){
                            $doctor = Doctor::where('user_name' ,'=', $user->user_name)->first();
                           ?>
                           <hr/>
                           <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADsalary">الراتب
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{(int)$doctor->salary}}" title="الراتب" type="number" id="ADsalary" name="ADsalary" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                          </div>
                          </div>

                          <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADmajor">التخصص
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{$doctor->major}}" title="التخصص" type="text" id="ADmajor" name="ADmajor" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                          </div>
                          </div>

                           <div class="item form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ADunionNUM">الرقم النقابي
                          </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <input value="{{(int)$doctor->union_number}}" title="الرقم النقابي" type="number" id="ADunionNUM" name="ADunionNUM" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                          </div>
                          </div>

                           <?php 
                          }
                        ?>
										 
										  <div class="ln_solid"></div>
										  <div class="form-group">
											<div class="col-md-6 col-md-offset-3">
											  <button id="editInfo" type="submit" onClick="" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ التغييرات</button>
											</div>
										  </div>
										</form>
                            <!-- end user projects -->

                          </div>
                          
                        </div>
                      </div>
                    </div>
				  
                    <div dir="rtl" class="col-md-3 col-sm-3 col-xs-12 profile_right">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <button title="Change Picture" type="button" data-toggle="modal" data-target="#myModal">
                            <img class="img-responsive avatar-view" src="/images/users/{{$user->image}}" alt="Avatar" title="Change the avatar">
                          </button>
                        </div>
                      </div>
                      <h3>{{$user->name}}</h3>

                      <ul class="list-unstyled user_data">

                      <li title="رقم الهوية">
                          <i class="fa fa-id-card user-profile-icon"></i>{{$user->user_name}}
                        </li>


                         <li title="الجنس">
                          <i class="fa fa-venus-mars user-profile-icon"></i>{{$user->gender}}
                        </li>

                        <li title="العنوان"><i class="fa fa-map-marker user-profile-icon"></i>{{$user->address}}
                        </li>
						
						            <li title="الايميل">
                          <i class="fa fa-envelope user-profile-icon"></i>{{$user->email}}
                        </li>
						
						            <li title="رقم الهاتف">
                          <i class="fa fa-phone-square user-profile-icon"></i>{{$user->phone}}
                        </li>
                         <?php
                          if($user->role == "Manager,Doctor"){
                           ?>

                        <li title="التخصص">
                          <i class="fa fa-briefcase user-profile-icon"></i>{{$doctor->major}}
                        </li>

                        <li title="الرقم النقابي">
                          <i class="fa fa-sort-numeric-asc user-profile-icon"></i>{{$doctor->union_number}}
                        </li>

                        <?php
                          }
                          ?>

                      </ul>

                    </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->

       




<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="exampleModalLabel">حمل الصورة الشخصية الجديدة</h4>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form id="msform" method="post" action="/dashboard/manager/changeProfilePic" enctype="multipart/form-data">
       <input type="file" id="photo" name="photo" placeholder="Personal Photo" accept="image/*" title = "Personal Photo" required />
      <input value="{{$user->user_name}}" id="user_name" name="user_name" type="hidden">
      {{ csrf_field() }}
	  </div>
      <div class="modal-footer ">
        <button type="button" class="btn btn-secondary pull-left" data-dismiss="modal">اغلاق</button>
        <input type="submit" value="حفظ" class="btn btn-success pull-left"></input>
		</form>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-right" id="eventModalLabel">اضافة حدث</h4>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="EventForm" method="post" action="/event/add">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">عنوان الحدث</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="name" id="eventTitle">
            </div>
          </div>
<br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">وصف الحدث</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="description" id="eventDescription">
            </div>
          </div>

          <br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">التاريخ</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="date" class="form-control" name="date" id="eventDate">
            </div>
          </div>
<br><br>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">الساعة</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="time" class="form-control" name="time" id="eventTime">
            </div>
          </div>
          <br>          
        </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="eventAction">حفظ</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
      </div>
      </form>  
    </div>
  </div>
</div>


@include('includes.scrtipts_src')

    <script type="text/javascript">
      $(document).ready(function()
        {
           
           $('.cancelAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });


            $('.approveAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/approve/"+id,function(data){
                   // alert(data.user.name);
                  var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });
            });



            $('.disapprovedAppointment').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/appointment/delete/"+id,function(data){
                   // alert(data.user.name);
                   var href=(document.URL).replace("#showArea", "");
                   window.location.href=(href +  '#showArea');
                   location.reload();
                 });

               

            });


            $('.editEvent').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/event/get/"+id,function(data){
                    
                   $('#eventTitle').val(data.event.event_name);
                     $('#eventTime').val(data.event.time);
                     $('#eventDate').val(data.event.date);
                     $('#eventDescription').val(data.event.event_description);
                     $('#eventAction').html("تعديل");
                     $("#EventForm").attr('action','/event/update/'+data.event.id);
                     $('#eventModalLabel').html("تعديل حدث");
                     $('#addEventModal').modal('show');

                 });

               

            });

            $('.deleteEvent').on('click',function(){

                var id = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/event/delete/"+id,function(data){
                    
                   location.reload();

                 });

               

            });


        });

    </script>

     <!-- footer content -->
       @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>

  </body>
</html>
