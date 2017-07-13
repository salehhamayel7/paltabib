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

    <title>المالية</title>
	
    
@include('includes.Datatables_links')
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
            @if($user->role == "Secretary")
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

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a title="عرض/اخفاء" class="collapse-link"><i class="fa fa-chevron-up fa-lg"></i></a>
                      </li>
                      <li class="dropdown">
                        <a title="القوائم المالية" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-caret-square-o-down fa-lg"></i></a>
                        <ul style="text-align: center;font-size: 14px;" class="dropdown-menu" role="menu">
                          <li><a href="/dashboard/{{$href}}/allBills">المستحقات</a>
                          </li>
                          <li><a href="/dashboard/{{$href}}/allExpenses">المصروفات</a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                    <h2 class="pull-right">الادارة المالية</h2>

                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">المستحقات</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">المصروفات</a>
                        </li>
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                          
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">

                                <ul class="nav navbar-left panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                </ul>
                              <h2 style="float:right;">فواتير المستحقات الحديثة</h2>
                                <div class="clearfix"></div>
                              </div>
                              @if(count($bills) > 0)
                             
                              <div class="x_content">
                                @foreach($bills as $bill)

                                 <?php
                                $doctorx = DB::table('users')
                                ->where('user_name', $bill->doctor_id)
                                ->first();

                                $pacientx = DB::table('users')
                                ->where('user_name', $bill->pacient_id)
                                ->first();


                              ?>
                                <article class="media event">
                                  <a class="pull-left">
                                    {{$bill->created_at}}
                                  </a>
                                  <div class="media-body">
                                    <p class="title"><strong>الطبيب: </strong>{{$doctorx->name}}</p>
                                    <p class="title"><strong>المريض: </strong>{{$pacientx->name}}</p>
                                    <p class="title"><strong>المبلغ: </strong>{{$bill->value}}</p>
                                    <br/>
                                    <p><strong>الوصف: </strong>{{$bill->description}}</p>
                                  </div>
                                </article>
                                <hr>
                              @endforeach
                            
                              </div>
                                <a href="/dashboard/{{$href}}/allBills" class="btn btn-success pull-left">كافة فواتير المستحقات</a>
                              @endif
                            </div>
                            </div>

                          <div class="col-md-6 col-sm-6 col-xs-12">

                          <div class="x_panel">
                              <div class="x_title">

                                <ul class="nav navbar-left panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                </ul>
                              <h2 style="float:right;">اضافة فاتورة مستحقة جديدة</h2>
                                <div class="clearfix"></div>
                              </div>

                              <form id="addBillsForm" action="/ajax/bill/create" method="post" class="form-horizontal form-label-left">
                                  {{ csrf_field() }}
                              
                              <div class="item form-group">
                              
                              <div class="col-md-8 col-sm-8 col-xs-12">
                              <select id="doctor" name="doctor" class="form-control col-md-7 col-xs-12" required="required">
                               <optgroup label="الاطباء">
                                    <?php
                                    foreach($doctors as $doctor){
                                      echo "<option value='".$doctor->user_name."'>".$doctor->name."(".$doctor->user_name.")"."</option>";

                                    }
                                    
                                    ?>
                               </optgroup>
                              </select>
                              </div>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doctor">
                                الطبيب المعالج
                              </label>
                              </div>

                               <div class="item form-group">
                              
                              <div class="col-md-8 col-sm-8 col-xs-12" >
                              <select id="pacient" name="pacient" class="form-control col-md-7 col-xs-12" required="required">
                                <optgroup label="المرضى">
                                    <?php
                                    foreach($pacients as $pacient){
                                      echo "<option value='".$pacient->user_name."'>".$pacient->name."(".$pacient->user_name.")"."</option>";

                                    }
                                    
                                    ?>
                               </optgroup>
                              </select>
                              </div>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pacient">
                                المريض
                              </label>
                              </div>                           
                              
                              <div class="item form-group">
                              
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="المبلغ" type="number" id="value" name="value" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                              </div>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                                المبلغ
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="الوصف والملاحظات" type="text" id="description" name="description" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                 الوصف والملاحظات
                              </label>
                              </div>
                       
                              <div class="ln_solid"></div>
                              <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="saveBill" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ الفاتورة </button>
                              </div>
                              </div>
                            </form>
                             
                            </div>   

                          </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                          <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="x_panel">
                              <div class="x_title">

                                <ul class="nav navbar-left panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                </ul>
                              <h2 style="float:right;">فواتير المصروفات الحديثة</h2>
                                <div class="clearfix"></div>
                              </div>
                              @if(count($expenses) > 0)
                             
                              <div class="x_content">
                                @foreach($expenses as $expense)

                                <article class="media event">
                                  <a class="pull-left">
                                    {{$expense->created_at}}
                                  </a>
                                  <div class="media-body">
                                    <p class="title"><strong>المبلغ: </strong>{{$expense->value}}</p>
                                    <p><strong>الوصف: </strong>{{$expense->description}}</p>
                                  </div>
                                </article>
                                <hr>
                              @endforeach
                            
                              </div>
                                <a href="/dashboard/{{$href}}/allExpenses" class="btn btn-success pull-left">كافة فواتير المصروفات</a>
                              @endif
                            </div>
                            </div>

                          <div class="col-md-6 col-sm-6 col-xs-12">

                          <div class="x_panel">
                              <div class="x_title">

                                <ul class="nav navbar-left panel_toolbox">
                                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                  </li>
                                </ul>
                                  <h2 style="float:right;">اضافة فاتورة مصروفة جديدة</h2>
                                <div class="clearfix"></div>
                              </div>

                              <form id="addExpensesForm" action="/ajax/expense/create" method="post" class="form-horizontal form-label-left">
                                  {{ csrf_field() }}
                              

                              <div class="item form-group">
                              
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="المبلغ" type="number" id="value" name="value" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                              </div>
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                                المبلغ
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="الوصف والملاحظات" type="text" id="description" name="description" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="description">
                                 الوصف والملاحظات
                              </label>
                              </div>
                       
                              <div class="ln_solid"></div>
                              <div class="form-group">
                              <div class="col-md-6 col-md-offset-3">
                                <button id="saveBill" type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ الفاتورة </button>
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


          </div>
        </div>
        <!-- /page content -->
		
		
		

        <!-- footer content -->
        @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>

    <button id="doneModal" style="display:none;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel pull-right">تنبيه</h3>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <<h2>تم حفط الفاتورة بنجاح</h2>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>

   @include('includes.scrtipts_src')
  
	  <script type="text/javascript" src="{{asset('js/managerJS.js')}}"></script>

    <script type="text/javascript">
      $(document).ready(function(){


        });
    </script>
  </body>
</html>