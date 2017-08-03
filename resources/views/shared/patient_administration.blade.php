
@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' : 'manager.layouts.master'))

@section('content')


<!-- page content -->
<div class="right_col" role="main">
	<div class="page-content">


		<div class="clearfix"></div>

		<div class="row">



			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">

					<ul class="nav navbar-left panel_toolbox">
						<li><a></a>
						</li>
						<li><a id = "collapse2" class="collapse-link" title = "اعرض/اخف"><i class="fa fa-chevron-up fa-lg"></i></a>
						</li>
					<li><a onclick="replaceContentToAddN()" title = "اضافة مريض/ـة"><i class="fa fa-plus fa-lg"></i></a>
						</li>


					</ul>
					<h2 style="float:right;">ادارة المرضى</h2>
				
					<div class="clearfix"></div>
					</div>
					<div class="x_content" id="page_contentN">

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
			</div>
		</div>
	</div>
</div>
<!-- /page content -->




<div id="addNurse" style="display:none;">
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
              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADName') ? ' has-error' : '' }}">
                <input value="{{ old('ADName') }}" title="الاسم" name="ADName" id="ADName" class="form-control col-md-7 col-xs-12"     type="text">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الاسم</span>
              </div>
              @if ($errors->has('ADName'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADName') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADuName') ? ' has-error' : '' }}">
                <input value="{{ old('ADuName') }}" title="اسم المستخدم" type="text" id="ADuName" name="ADuName"   class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>اسم المستخدم</span>
              </div>
              @if ($errors->has('ADuName'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADuName') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADpass') ? ' has-error' : '' }}">
                <input  value="{{ old('ADpass') }}" title="كلمة المرور" type="password" id="ADpass" name="ADpass"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>كلمة المرور</span>
              </div>
              @if ($errors->has('ADpass'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADpass') }}
                </div>
            @endif

            <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADpass_2') ? ' has-error' : '' }}">
                <input  value="{{ old('ADpass_2') }}" title="تاكيد كلمة المرور" type="password" id="ADpass_2" name="ADpass_2"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>تاكيد كلمة المرور</span>
              </div>
              @if ($errors->has('ADpass_2'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADpass_2') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADemail') ? ' has-error' : '' }}">
                <input value="{{ old('ADemail') }}" title="الايميل" type="email" id="ADemail" name="ADemail"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الايميل</span>
              </div>
              @if ($errors->has('ADemail'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADemail') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADgender') ? ' has-error' : '' }}">
                <select value="{{ old('ADgender') }}" id="ADgender" name="ADgender" class="form-control col-md-7 col-xs-12">
                  <option value="Male">ذكر</option>
                  <option value="Female">انثى</option>
                </select>
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الجنس</span>
              </div>
              @if ($errors->has('ADgender'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADgender') }}
                </div>
            @endif


              
        </div>

          <div class="col-md-6 col-sm-12 col-xs-12 col-md-pull-6">
            
              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADaddress') ? ' has-error' : '' }}">
                <input value="{{ old('ADaddress') }}" title="العنوان" type="text" id="ADaddress" name="ADaddress"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>العنوان</span>
              </div>
              @if ($errors->has('ADaddress'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADaddress') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADjob') ? ' has-error' : '' }}">
                <input value="{{ old('ADjob') }}" title="الوظيفة" type="text" id="ADjob" name="ADjob"  class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>الوظيفة</span>
              </div>
              @if ($errors->has('ADjob'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADjob') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ADphone') ? ' has-error' : '' }}">
                <input value="{{ old('ADphone') }}" title="رقم الهاتف" type="text" id="ADphone" name="ADphone"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>رقم الهاتف</span>
              </div>
              @if ($errors->has('ADphone'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ADphone') }}
                </div>
            @endif

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ensurance') ? ' has-error' : '' }}">
                <input value="{{ old('ensurance') }}" title="رقم التامين" type="text" id="ensurance" name="ensurance"    class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2">رقم التامين</span>
              </div>
            @if ($errors->has('ensurance'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ensurance') }}
                </div>
            @endif
            

              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('id_image') ? ' has-error' : '' }}">
                <input accept="image/*,.doc,.docx,.pdf" title="ملف/صورة الهوية" type="file" id="id_image" name="id_image"  class="form-control col-md-7 col-xs-12">
                <span class="input-group-addon" id="basic-addon2"><span class="noRequered" style="color:red;">* </span>ملف/صورة الهوية</span>
              </div>
         
            @if ($errors->has('id_image'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('id_image') }}
                </div>
            @endif

            <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12 {{ $errors->has('ATimage') ? ' has-error' : '' }}">
                <input title="الصورة الشخصية" type="file" accept="image/*" id="ATimage" name="ATimage" class="form-control col-md-7 col-xs-12" value="User_Avatar-512.png">
                <span class="input-group-addon" id="basic-addon2">الصورة الشخصية</span>
              </div>
         
          @if ($errors->has('ATimage'))
                <div class="error-msg input-group col-md-6 col-md-offset-3 col-sm-12 col-xs-12">
                    {{ $errors->first('ATimage') }}
                </div>
            @endif


           </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-sm-12 col-xs-12 checkss" style="margin-top: -10px;">
                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <input value="{{ old('ADsalary') }}" type="checkbox" name="married" id="married" class="js-switch"  />
                    <label class="control-label">متزوج؟</label>
                  </div>

                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <input value="{{ old('ADsalary') }}" type="checkbox" name="smoker" id="smoker" class="js-switch" />
                    <label class="control-label">مدخن؟</label>
                      
                  </div>

                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <input value="{{ old('ADsalary') }}" type="checkbox" name="drunk" id="drunk" class="js-switch"  />
                    <label class="control-label">يتعاطى الكحول؟</label>

                  </div>


                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                      <input value="{{ old('ADsalary') }}" type="checkbox" name="sot" id="sot" class="js-switch"  /> 
                    <label class="control-label">يتعاطى المخدرات؟</label>
                    </div>
                  

                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <input value="{{ old('ADsalary') }}" type="checkbox" name="disablity" id="disablity" class="js-switch"  /> 
                    <label class="control-label">هل يعاني من اعاقة؟</label>
                        
                  </div>

                  <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <input value="{{ old('ADsalary') }}" type="checkbox" name="touchy" id="touchy" class="js-switch" /> 
                    <label class="control-label">يعاني من الحساسية؟</label>
                  </div>
            </div>
              <div class="col-md-6 col-sm-12 col-xs-12" dir="ltr">

                  
              <div class="input-group col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
                <input value="{{ old('allergic_from') }}" type="text" name="allergic_from" id="tags_1" type="text" class="tags form-control" />
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
      <h4 class="panel-title">التاريخ الماضي - Past History (PH)</h4>
    </a>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">

        <div class="form-group">
        <textarea   class="form-control" name="ph" id="ph" rows="4">{{ old('ph') }}</textarea>
      </div>

      </div>
    </div>
  </div>
  <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingThree" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      <h4 class="panel-title">التفاصيل السكانية - Demographic Details</h4>
    </a>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">

      <div class="form-group">
        <textarea  class="form-control" name="dd" id="dd" rows="4">{{ old('dd') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingFour" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
      <h4 class="panel-title">تاريخ تقديم الشكوى - History of Presenting Complaint (HPC)</h4>
    </a>
    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
      <div class="panel-body">

      <div class="form-group">
        <textarea  class="form-control" name="hpc" id="hpc" rows="4">{{ old('hpc') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingFive" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
      <h4 class="panel-title">تقديم شكوى - Presenting Complaint (PC)</h4>
    </a>
    <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
      <div class="panel-body">

      <div class="form-group">
        <textarea  class="form-control" name="pc" id="pc" rows="4">{{ old('pc') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingSix" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
      <h4 class="panel-title">تاريخ المخدرات - Drug History (DH)</h4>
    </a>
    <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
      <div class="panel-body">

      <div class="form-group">
        <textarea  class="form-control" name="dh" id="dh" rows="4">{{ old('dh') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingNine" data-toggle="collapse" data-parent="#accordion" href="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
      <h4 class="panel-title">التاريخ الاجتماعي - Social History (SH)</h4>
    </a>
    <div id="collapseNine" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingNine">
      <div class="panel-body">

      <div class="form-group">
        <textarea  class="form-control" name="sh" id="sh" rows="4">{{ old('sh') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingTen" data-toggle="collapse" data-parent="#accordion" href="#collapseTen" aria-expanded="false" aria-controls="collapseTen">
      <h4 class="panel-title">التحقيق المنهجي - Systematic Enquiry (SE)</h4>
    </a>
    <div id="collapseTen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTen">
      <div class="panel-body">

      <div class="form-group">
        <label for="exampleTextarea"></label>
        <textarea  class="form-control" name="se" id="se" rows="4">{{ old('se') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingEleven" data-toggle="collapse" data-parent="#accordion" href="#collapseEleven" aria-expanded="false" aria-controls="collapseEleven">
      <h4 class="panel-title">الفحص العام - General/On Examination (OE)</h4>
    </a>
    <div id="collapseEleven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingEleven">
      <div class="panel-body">

      <div class="form-group">
        <label for="exampleTextarea"></label>
        <textarea  class="form-control" name="oe" id="oe" rows="4">{{ old('oe') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingTwelve" data-toggle="collapse" data-parent="#accordion" href="#collapseTwelve" aria-expanded="false" aria-controls="collapseTwelve">
      <h4 class="panel-title">نظام القلب والأوعية الدموية - Cardiovascular System (CVS)</h4>
    </a>
    <div id="collapseTwelve" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwelve">
      <div class="panel-body">

      <div class="form-group">
        <label for="exampleTextarea"></label>
        <textarea  class="form-control" name="cvs" id="cvs" rows="4">{{ old('cvs') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingThirteen" data-toggle="collapse" data-parent="#accordion" href="#collapseThirteen" aria-expanded="false" aria-controls="collapseThirteen">
      <h4 class="panel-title">الجهاز التنفسي - Respiratory System (RS)</h4>
    </a>
    <div id="collapseThirteen" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThirteen">
      <div class="panel-body">

      <div class="form-group">
        <label for="exampleTextarea"></label>
        <textarea  class="form-control" name="rs" id="rs" rows="4">{{ old('rs') }}</textarea>
      </div>

      </div>
    </div>
  </div>


    <div class="panel">
    <a class="panel-heading collapsed" role="tab" id="headingSeven" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
      <h4 class="panel-title">تاريخ العائلة - Family History (FH)</h4>
    </a>
    <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
      <div class="panel-body">

      <div class="form-group">
        <label for="exampleTextarea"></label>
        <textarea  class="form-control" name="fh" id="fh" rows="4">{{ old('fh') }}</textarea>
      </div>

      </div>
    </div>
  </div>

    <div class="text-center">
        <button id="send" type="submit" onClick="" class="btn btn-success"><i class="fa fa-floppy-o"></i> اضف</button>
        <a id="cancel" href="" class="btn btn-primary"><i class="fa fa-times"></i> الغاء</a>
      </div>

      
</div>
</form>
</div>


@endsection