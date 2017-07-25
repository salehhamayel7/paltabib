@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' : 'manager.layouts.master'))


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
        
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body" style=" text-align: center;">
        <img id="imageInModal" src="" alt="image" style="width:100%; max-height: 400px;"/>
      </div>
    </div>
  </div>
</div>


	@endsection