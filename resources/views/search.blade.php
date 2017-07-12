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

    <title>البحث </title>

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
          <div class="">

            
            <div class="clearfix"></div>

            <div class="row">
                <div style="margin-top: 15px;" class="col-md-6 col-md-offset-3 col-sm-12">
                  <div class="input-group" id="adv-search">
                      <input type="text" class="form-control" placeholder="ابحث في سجلات المرضى" />
                      <div class="input-group-btn">
                          <div class="btn-group" role="group">
                              <div class="dropdown dropdown-lg">
                              <button type="button" class="btn btn-default" data-toggle="collapse" data-target="#filter-panel">
                               خيارات متقدمة <span class="glyphicon glyphicon-cog"></span> 
                              </button>
                              <button title="ابحث" type="button" class="btn btn-success">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                </button>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
    
                <div class="col-md-8 col-md-offset-2">
                  <div id="filter-panel" class="collapse filter-panel">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <form class="form-inline" role="form">
                              <div class="searchChoises">
                                <div class="pull-right" style="padding-right: 15px;">
                                  <input onchange="alert('asdasd');" type="checkbox" class="flat">
                                  <label> بحث باستخدام: </label>
                                </div>
                                
                                <div class="form-group searchChoisesx">
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage">متزوج؟</label>
                                    <input type="checkbox" name="married" id="married" class=" form-control js-switch"  />                                
                                </div>
                                <div class="form-group searchChoisesx">
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage">مدخن؟</label>
                                    <input type="checkbox" name="smoker" id="smoker" class="form-control js-switch" />                                
                                </div> 
                                <div class="form-group searchChoisesx">
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage">يتعاطى الكحول؟</label>
                                     <input type="checkbox" name="drunk" id="drunk" class="form-control js-switch"  />                                
                                </div> 
                                <div class="form-group searchChoisesx">
                                    <label class="filter-col" style="margin-right:0;" for="pref-perpage">يتعاطى المخدرات؟</label>
                                    <input type="checkbox" name="sot" id="sot" class="form-control  js-switch"  />
                                </div> 
                              </div>
                              
                              <div class="x_content">

                                  <div class="col-xs-10">
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                      <div class="tab-pane active" id="home-r">
                                        <h4 class="lead">البحث في السجل المرضي</h4>
                                       
                                       </div>
                                      <div class="tab-pane" id="profile-r">
                                        <h4 class="lead">البحث في تاريخ المراجعات</h4>

                                      </div>
                                      
                                    </div>
                                  </div>

                                  <div class="col-xs-2">
                                    <!-- required for floating -->
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs tabs-right">
                                      <li class="active"><a href="#home-r" data-toggle="tab">السجل</a>
                                      </li>
                                      <li><a href="#profile-r" data-toggle="tab">التاريخ</a>
                                      </li>
                                     
                                    </ul>
                                  </div>

                                </div>

                               
                                <div class="form-group">    
                                    <button type="submit" class="btn btn-success filter-col">
                                        <span class="glyphicon glyphicon-record"></span> بحث متقدم 
                                    </button>  
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
         
      });
    </script>
  </body>
</html>
