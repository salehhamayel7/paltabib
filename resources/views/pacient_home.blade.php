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

    <title>الرئيسية </title>
    @include('includes.links')
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title navbar-fixed-top" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>PalTabib</span></a>
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
           @include('includes.patient_sidebar')
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
					
					          <h2 style="float:right;"> الرئيسية </h2>
					 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
				  
				  <div class="col-md-9 col-sm-9 col-xs-12">

                      <!-- start of user-activity-graph -->
							 
						<div class="x_panel">
						  <div class="x_title">
							<ul class="nav navbar-left panel_toolbox">
							  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
							  </li>		
                   <a href="/dashboard/pacient/allAppointments" class="btn btn-round btn-success"><i class="fa fa-calendar"></i> كافة المواعيد </a>					  
							</ul>
							<h2 style="float:right;"> المواعيد القادمة </h2>
							<div class="clearfix"></div>
						  </div>
						  <div class="x_content">
						  

							<table dir="rtl" class="table table-striped">
                <thead>
                  <tr>
                    <td>الطبيب</td>
                    <td>العيادة</td>
                    <td>العنوان</td>
                    <td>التاريخ</td>
                    <td>الوقت</td>
                    <td></td>
                  </tr>
                </thead>
               

							  <tbody>
                  @foreach($nextAppoinments as $nAppoinment)
								<tr>
								  <th scope="row">{{$nAppoinment->name}}</th>
								  <td>{{$nAppoinment->clinic_name}}</td>
								  <td>{{$nAppoinment->location}}</td>
                  <td>{{$nAppoinment->date}}</td>
                  <td>{{$nAppoinment->time}}</td>
								  <td>
                    <button data-id="{{$nAppoinment->id}}" type="button" class="btn btn-danger cancelAppoin" data-toggle="modal" data-target="#myModal2">
                    الغاء
                    </button></td>
								</tr>
                @endforeach
							  </tbody>
							</table>

						  </div>
						</div>
             
                      <!-- end of user-activity-graph -->

                      <div id="showArea" class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs right" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">الأحداث القادمة</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">تعديل المعلومات الشخصية</a>
                          </li>
                         
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div dir="rtl" role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              @foreach($nextEvents as $event)
                              <?php
                                $date = new DateTime($event->date);
                              
                              ?>
                              <li>
                                <div class="message_date">
                                  <h3 class="date text-info"><?php echo $date->format('d'); ?></h3>
                                  <p class="month"><?php echo $date->format('M'); ?></p>
                                  <h5 class="heading">{{$event->time}}</h5>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading">{{$event->event_name}}</h4>
                                  <blockquote class="message">
                                    <h5 class="heading">العيادة: {{$event->name}} | العنوان: {{$event->address}}</h5>
                                    {{$event->event_description}}
                                    </blockquote>
								                  <br />
                                </div>
                              </li>
                             @endforeach

                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div dir="rtl" role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                           <form id="addPatintform" method="post" action="/pacient/update/{{$user->user_name}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
										  
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
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id_image">ملف/صورة الهوية
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input accept="image/*,.doc,.docx,.pdf" title="الصورة الشخصية" type="file" accept="image/*" id="id_image" name="id_image" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      
                      <hr>

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

                      <li title="اسم المستخدم">
                          <i class="fa fa-user user-profile-icon"></i>{{$user->user_name}}
                        </li>

                          <form id="id-form" method="get" action="/file/download/{{$user->id_image}}">
                          </form>
                        <li id="get-id" title="البطاقة الشخصية">
                          <i class="fa fa-id-card user-profile-icon"></i>
                                <a>عرض/تحميل</a>
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
                         
                      </ul>

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


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-right" id="exampleModalLabel">تاكيد؟</h4>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>هل انت متاكد من الغاء الموعد؟</h2>
      </div>
      <div class="modal-footer">
        <button data="" id="confirmCancel" style="font-size:16px;" type="button" class="btn btn-danger">نعم</button>
        <button style="font-size:16px;" type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
      </div>
    </div>
  </div>
</div>



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
	  <form id="msform" method="post" action="/dashboard/pacient/changeProfilePic" enctype="multipart/form-data">
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
@include('includes.scrtipts_src')

    <script type="text/javascript">
      $(document).ready(function()
        {
           
          
          
            $('#myModal2').on('show.bs.modal', function (event) {
              var button = $(event.relatedTarget); // Button that triggered the modal
              var id = button.data('id'); // Extract info from data-* attributes
              $('#confirmCancel').attr('data' , id);
            });

          

          $('#confirmCancel').on('click',function()
          {

            var id = $(this).attr('data');
            $.get("/ajax/appointment/delete/"+id,function(){
              location.reload();
             });
          });

        });
    </script>
  </body>
</html>