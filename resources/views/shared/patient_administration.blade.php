
@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' : 'manager.layouts.master'))

@section('content')



<style>
	.input-group-addon{
		    min-width: 120px;
	}
	.input-group input{
		    text-align: right;
  }
  
</style>
<!-- page content -->
<div class="right_col" role="main">
  <div class="page-content">
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
                  <th>اسم المستخدم</th>
                  <th>بطاقة الهوية</th>
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
                  <th>
                  <form method="get" action="/file/download/{{$pacirnt->id_image}}">  
                    <button type="submit" class="btn btn-success btn-sm">عرض/تحميل</button>
                    </form>
                    </th>
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
                  <form id="addPatintform" method="post" action="/pacient/create" class="form-horizontal form-label-left" enctype="multipart/form-data" dir="rtl">
                  {{ csrf_field() }}
                  <!-- start accordion -->
              <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">

              <div class="panel">
                <a class="panel-heading" role="tab" id="headingOne" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <h4 class="panel-title">المعلومات الشخصية والاساسية (متطلب)</h4>
                </a>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    
                    <div class="panel-body">

                    <div class="row" dir="ltr">
                      <div class="col-md-6 col-sm-12 col-xs-12 col-md-push-6">
                        	<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input placeholder="مثال: صالح" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12" data-validate-length-range="15" data-validate-words="1"  required="required" type="text">
														<span class="input-group-addon" id="basic-addon2">الاسم</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="اسم المستخدم" type="text" id="ADuName" name="ADuName" required="required"  class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">اسم المستخدم</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="كلمة المرور" type="password" id="ADpass" name="ADpass" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">كلمة المرور</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input  title="الايميل" type="email" id="ADemail" name="ADemail" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">الايميل</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<select id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
															<option value="Male">ذكر</option>
															<option value="Female">انثى</option>
														</select>
														<span class="input-group-addon" id="basic-addon2">الجنس</span>
													</div>
                          	<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" class="form-control col-md-7 col-xs-12" value="User_Avatar-512.png">
														<span class="input-group-addon" id="basic-addon2">الصورة الشخصية</span>
													</div>
                      </div>

                      <div class="col-md-6 col-sm-12 col-xs-12 col-md-pull-6">
                        
													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input placeholder="المدينة/القرية" title="العنوان" type="text" id="ADaddress" name="ADaddress" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">العنوان</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="الوظيفة" type="text" id="ADjob" name="ADjob" required="required" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">الوظيفة</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="رقم الهاتف" type="number" id="ADphone" name="ADphone" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">رقم الهاتف</span>
													</div>

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input title="رقم التامين" type="number" id="ensurance" name="ensurance" required="required" data-validate-length-range="100" data-validate-words="1" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">رقم التامين</span>
													</div>

												

													<div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
														<input accept="image/*,.doc,.docx,.pdf" title="ملف/صورة الهوية" type="file" id="id_image" name="id_image" required="required" class="form-control col-md-7 col-xs-12">
														<span class="input-group-addon" id="basic-addon2">ملف/صورة الهوية</span>
													</div>
                      </div>
                    </div>

                    <div class="row">
                       <div class="col-md-6 col-sm-12 col-xs-12 checkss" style="margin-top: -10px;">
                             <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <input type="checkbox" name="married" id="married" class="js-switch"  />
                                <label class="control-label">متزوج؟</label>
                              </div>

                              <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <input type="checkbox" name="smoker" id="smoker" class="js-switch" />
                                <label class="control-label">مدخن؟</label>
                                  
                              </div>

                              <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                <input type="checkbox" name="drunk" id="drunk" class="js-switch"  />
                                <label class="control-label">يتعاطى الكحول؟</label>

                              </div>


                              <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                  <input type="checkbox" name="sot" id="sot" class="js-switch"  /> 
                                <label class="control-label">يتعاطى المخدرات؟</label>
                                </div>
                              

                              <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                      <input type="checkbox" name="disablity" id="disablity" class="js-switch"  /> 
                                <label class="control-label">هل يعاني من اعاقة؟</label>
                                    
                              </div>

                              <div class="form-group col-md-6 col-sm-6 col-xs-6">
                                      <input type="checkbox" name="touchy" id="touchy" class="js-switch" /> 
                                <label class="control-label">يعاني من الحساسية؟</label>
                              </div>
                       </div>
                         <div class="col-md-6 col-sm-12 col-xs-12" dir="ltr">

                              
                         <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                            <input type="text" name="allergic_from" id="tags_1" type="text" class="tags form-control" />
                              <div id="suggestions-container" style="position: relative; float: left; "></div>
                            <span class="input-group-addon" style="    max-width: 120px;" id="basic-addon2">ما الحساسية التي يعاني <br> منها(كلمات مفتاحية)</span>
													</div>
                        
                        </div>
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


     @endsection