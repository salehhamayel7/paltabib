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

    <title>المرضى </title>
    
    <!-- Bootstrap -->
    <link href="{{asset('../vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('../vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('../vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('../vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- bootstrap-wysiwyg -->
    <link href="{{asset('../vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{asset('../vendors/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <!-- Switchery -->
    <link href="{{asset('../vendors/switchery/dist/switchery.min.css')}}" rel="stylesheet">
    <!-- starrr -->
    <link href="{{asset('../vendors/starrr/dist/starrr.css')}}" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <script type="text/javascript" src="{{asset('../js/managerJS.js')}}"></script>

    <!-- Datatables -->
      <link href="{{asset('../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('../build/css/custom.min.css')}}" rel="stylesheet">
	  <link href="{{asset('css/custumCSS.css')}}" rel="stylesheet">
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



              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                 
                  <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">ادارة المرضى</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">اضافة مريض</a>
                        </li>
                       
                      </ul>
                      <div id="myTabContent2" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                             
                  <div class="x_content" id="page_contentP">

                    <table dir="rtl" id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>رقم الهوية</th>
                          <th>الاسم</th>
                          <th>الجنس</th>
                          <th>الايميل</th>
                          <th>مكان السكن/العنوان</th>
                          <th>الهاتف</th>
                           <th>الوظيفة</th>
                          <th>الرقم التامين</th>
                          <th></th>
                        </tr>
                      </thead>


                      <tbody>
                       
                        @foreach($pacirnts as $pacirnt)
                       <tr>
                          <th>{{ $pacirnt->user_name }}</th>
                          <th>{{ $pacirnt->name }}</th>
                          <th>{{ $pacirnt->gender }}</th>
                          <th>{{ $pacirnt->email }}</th>
                          <th>{{ $pacirnt->address }}</th>
                          <th>{{ $pacirnt->phone }}</th>
                          <th>{{ $pacirnt->job }}</th>
                          <th>{{ $pacirnt->ensurance_number }}</th>
                         
                          <th>
                          <a id="editPacient" onclick = "" data="{{ $pacirnt->user_name }}" class="btn btn-success btn-xs editPacient"><i class="fa fa-edit"></i> عرض/تعديل </a>

                          <a id="deletePacirnt" href="/ajax/delete/pacient/{{ $pacirnt->user_name }}" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> حذف </a>
                          </th>
                                    </tr>
                        @endforeach

                      </tbody>
                    </table>
                  </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                         <form id="addPatintform" method="post" action="/pacient" class="form-horizontal form-label-left" enctype="multipart/form-data" dir="rtl">
                          {{ csrf_field() }}
                          <!-- start accordion -->
                      <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

                      <div class="panel">
                        <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          <h4 class="panel-title">المعلومات الشخصية والاساسية (متطلب)</h4>
                        </a>
                        <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                           
                           <div class="panel-body">
                             

                          <div class="col-md-6 col-xs-12">

                            <div class="form-group">
                        <label class="control-label">متزوج؟</label>
                              <input type="checkbox" name="married" id="married" class="js-switch"  /> 
                      </div>

                       <div class="form-group">
                        <label class="control-label">مدخن؟</label>
                         <input type="checkbox" name="smoker" id="smoker" class="js-switch" /> 
                      </div>

                      <div class="form-group">
                        <label class="control-label">يتعاطى الكحول؟</label>
                        <input type="checkbox" name="drunk" id="drunk" class="js-switch"  />
                      </div>


                      <div class="form-group">
                        <label class="control-label">يتعاطى المخدرات؟</label>
                          <input type="checkbox" name="sot" id="sot" class="js-switch"  /> 
                        </div>
                     

                      <div class="form-group">
                        <label class="control-label">هل يعاني من اعاقة؟</label>
                              <input type="checkbox" name="disablity" id="disablity" class="js-switch"  /> 
                           
                      </div>

                      <div class="form-group">
                        <label class="control-label">يعاني من الحساسية؟</label>
                              <input type="checkbox" name="touchy" id="touchy" class="js-switch" /> 
                          
                      </div>


                      <div class="form-group">
                        <label class="control-label">ما الحساسية التي يعاني منها(كلمات مفتاحية)</label>
                     
                          <input type="text" name="allergic_from" id="tags_1" type="text" class="tags form-control" value="" />
                          <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                       
                      </div>
                          </div>


                          <div class="col-md-6 col-xs-12">
                            <label for="ADName">اسم المريض</label>
                            <input aria-describedby="اسم المريض" title="الاسم" name="ADName" id="ADName" class="form-control"  required="required" type="text">
                          
                          <label for="ADName">رقم الهوية</label>
                            <input aria-describedby="رقم الهوية" title="رقم الهوية" type="number" id="ADuName" name="ADuName" class="form-control" required="required">
                          
                          <label for="ADpass">كلمة السر</label>
                            <input aria-describedby="كلمة السر" title="كلمة السر" name="ADpass" id="ADpass" class="form-control"  required="required" type="password">
                          
                          <label for="ADemail">الايميل</label>
                            <input aria-describedby="الايميل" title="الايميل" name="ADemail" id="ADemail" class="form-control"  required="required" type="email">
                          
                          <label for="ADgender">الجنس</label>
                            <select aria-describedby="الجنس" title="الجنس" id="ADgender" name="ADgender" class="form-control" required="required">
                              <option value="Male">ذكر</option>
                              <option value="Female">انثى</option>
                            </select>

                            <label for="ADaddress">العنوان/مكان السكن</label>
                            <input aria-describedby="العنوان/مكان السكن" title="العنوان/مكان السكن" name="ADaddress" id="ADaddress" class="form-control"  required="required" type="text">
                          
                          <label for="ADjob">الوظيفة</label>
                            <input aria-describedby="الوظيفة" title="الوظيفة" name="ADjob" id="ADjob" class="form-control"  required="required" type="text">
                          
                          <label for="ADphone">رقم الهاتف</label>
                            <input aria-describedby="رقم الهاتف" title="رقم الهاتف" name="ADphone" id="ADphone" class="form-control"  required="required" type="number">
                          
                          <label for="ensurance">رقم التامين</label>
                            <input aria-describedby="رقم التامين" title="رقم التامين" name="ensurance" id="ensurance" class="form-control"  required="required" type="number">
                          
                          <label for="ATimage">الصورة الشخصية</label>
                            <input aria-describedby="الصورة الشخصية" title="الصورة الشخصية" name="ATimage" id="ATimage" class="form-control"  required="required" type="file" accept="image/*" id="ATimage">
                          </div>
                          

                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          <h4 class="panel-title">Past History (PH)</h4>
                        </a>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                          <div class="panel-body">

                           <div class="form-group">
                            <textarea class="form-control" name="ph" id="ph" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>
                      <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          <h4 class="panel-title">Demographic Details</h4>
                        </a>
                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                          <div class="panel-body">

                          <div class="form-group">
                            <textarea class="form-control" name="dd" id="dd" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingFour" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                          <h4 class="panel-title">History of Presenting Complaint (HPC)</h4>
                        </a>
                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
                          <div class="panel-body">

                          <div class="form-group">
                            <textarea class="form-control" name="hpc" id="hpc" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingFive" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                          <h4 class="panel-title">Presenting Complaint (PC)</h4>
                        </a>
                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
                          <div class="panel-body">

                          <div class="form-group">
                            <textarea class="form-control" name="pc" id="pc" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingSix" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                          <h4 class="panel-title">Drug History (DH)</h4>
                        </a>
                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
                          <div class="panel-body">

                          <div class="form-group">
                            <textarea class="form-control" name="dh" id="dh" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingNine" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                          <h4 class="panel-title">Social Hstory (SH)</h4>
                        </a>
                        <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
                          <div class="panel-body">

                          <div class="form-group">
                            <textarea class="form-control" name="sh" id="sh" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTen" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
                          <h4 class="panel-title">Systematic Enquiry (SE)</h4>
                        </a>
                        <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
                          <div class="panel-body">

                          <div class="form-group">
                            <label for="exampleTextarea"></label>
                            <textarea class="form-control" name="se" id="se" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingEleven" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
                          <h4 class="panel-title">General/On Examination (OE)</h4>
                        </a>
                        <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
                          <div class="panel-body">

                          <div class="form-group">
                            <label for="exampleTextarea"></label>
                            <textarea class="form-control" name="oe" id="oe" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingTwelve" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
                          <h4 class="panel-title">Cardiovascular System (CVS)</h4>
                        </a>
                        <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
                          <div class="panel-body">

                          <div class="form-group">
                            <label for="exampleTextarea"></label>
                            <textarea class="form-control" name="cvs" id="cvs" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingThirteen" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
                          <h4 class="panel-title">Respiratory System (RS)</h4>
                        </a>
                        <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
                          <div class="panel-body">

                          <div class="form-group">
                            <label for="exampleTextarea"></label>
                            <textarea class="form-control" name="rs" id="rs" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>


                       <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="headingSeven" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                          <h4 class="panel-title">Family History (FH)</h4>
                        </a>
                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
                          <div class="panel-body">

                          <div class="form-group">
                            <label for="exampleTextarea"></label>
                            <textarea class="form-control" name="fh" id="fh" rows="4"></textarea>
                          </div>

                          </div>
                        </div>
                      </div>

                       <div class="text-center">
                           <button id="send" type="submit" onClick="" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
											  <a id="cancel" onclick="document.getElementById('home-tabb').click();" class="btn btn-primary"><i class="fa fa-times"></i> الغاء</a>
                         </div>

                         
                    </div>
                    </form>
                    <!-- end of accordion -->
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

    <!-- jQuery -->
    <script src="{{asset('../vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('../vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('../vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('../vendors/nprogress/nprogress.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('../vendors/iCheck/icheck.min.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('../vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <!-- bootstrap-wysiwyg -->
    <script src="{{asset('../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js')}}"></script>
    <script src="{{asset('../vendors/jquery.hotkeys/jquery.hotkeys.js')}}"></script>
    <script src="{{asset('../vendors/google-code-prettify/src/prettify.js')}}"></script>
    <!-- jQuery Tags Input -->
    <script src="{{asset('../vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
    <!-- Switchery -->
    <script src="{{asset('../vendors/switchery/dist/switchery.min.js')}}"></script>
    <!-- Select2 -->
    <script src="{{asset('../vendors/select2/dist/js/select2.full.min.js')}}"></script>
   
    <!-- Autosize -->
    <script src="{{asset('../vendors/autosize/dist/autosize.min.js')}}"></script>
    <!-- jQuery autocomplete -->
    <script src="{{asset('../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js')}}"></script>
    <!-- starrr -->
    <script src="{{asset('../vendors/starrr/dist/starrr.js')}}"></script>
	<!-- Datatables -->
    <script src="{{asset('../vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
    <script src="{{asset('../vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('../vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('../vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('../vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <!-- Custom Theme Scripts -->
    <script src="{{asset('../build/js/custom.min.js')}}"></script>

    <script type="text/javascript">
      $(document).ready(function()
        {


            $('#home-tabb').on('click',function(){

           });

           $('.editPacient').on('click',function(){

                var user_name = $(this).attr('data');
               // alert(user_name);
                 $.get("/ajax/edit/pacient/"+user_name,function(data){
                   // alert(data.user.name);
                     $('#ADName').val(data.user.name);
                     $('#ADuName').val(data.user.user_name);
                     $('#ADemail').val(data.user.email);
                     $('#ADgender').val(data.user.gender);
                     $('#ADaddress').val(data.user.address);
                     $('#ADphone').val(data.user.phone);
                     $('#ADjob').val(data.pacient.job);
                     $('#ensurance').val(data.pacient.ensurance_number);

                     $('#ph').val(data.pacient.past_history);
                     $('#dd').val(data.pacient.demo_details);
                     $('#hpc').val(data.pacient.history_of_comp);
                     $('#pc').val(data.pacient.present_comp);
                     $('#dh').val(data.pacient.drug_history);
                     $('#sh').val(data.pacient.social_history);
                     $('#se').val(data.pacient.systematic_en);
                     $('#oe').val(data.pacient.on_exam);
                     $('#cvs').val(data.pacient.cardio_system);
                     $('#rs').val(data.pacient.respiratory_system);
                     $('#fh').val(data.pacient.family_history);

                     //$('#tags_1').tagsinput('add', 'some tag');

                     $('#tags_1').val(data.pacient.allergic_from);

                     if(data.pacient.smoking){
                       //var element = $('#smoker');
                       //changeSwitchery(element, true);
                       //$('#smoker').prop('checked', true);
                       $('#smoker').trigger('click');
                     }
                      if(data.pacient.married){
                       $('#married').trigger('click');
                     }
                      if(data.pacient.allergic){
                       $('#touchy').trigger('click');
                     }
                      if(data.pacient.alcohol){
                       $('#drunk').trigger('click');
                     }
                      if(data.pacient.drugs){
                       $('#sot').trigger('click');
                     }
                      if(data.pacient.disability){
                       $('#disablity').trigger('click');
                     }
             
                 });

                replaceContentToAddP();

                $('#ADpass').removeAttr("required");
                $('#ATimage').removeAttr("required");
                $("#send").attr("onClick","");
                $("#send").html("حفط التغييرات");
                $("#addPatintform").attr("action","/pacient/update/"+user_name);

            });
            

        });

    </script>

  </body>
</html>
