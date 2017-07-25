@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' :(($user->role == 'Secretary') ?  'patient.layouts.master' :  'manager.layouts.master' )))

@section('content')

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

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-content">

            
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
    
                <div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
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

                                  <div class="col-md-10 col-sm-9 col-xs-9">
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

                                  <div class="col-md-2 col-sm-3 col-xs-3">
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
@endsection