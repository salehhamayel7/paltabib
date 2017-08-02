@extends('manager/layouts.master')
@section('content')
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
                                  اسم العيادة<span style="color:red;"> *</span>
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input value="{{$clinic->address}}" title="العنوان" type="text" id="clinic_address" name="clinic_address" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_address">
                                 العنوان <span style="color:red;"> *</span>
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input value="{{$clinic->phone}}" title="الهاتف" type="text" id="clinic_phone" name="clinic_phone" required="required" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_phone">
                                 الهاتف <span style="color:red;"> *</span>
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="اثبات تسجيل العيادة" accept="image/*,.doc,.docx,.pdf" id="reg_proof" type="file" name="reg_proof" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="clinic_phone">
                                 اثبات تسجيل العيادة
                              </label>
                              </div>

                              <div class="item form-group">
                             
                              <div class="col-md-8 col-sm-8 col-xs-12">
                                <input title="الشعار" accept="image/*" id="logo" type="file" name="logo" class="form-control col-md-7 col-xs-12">
                              </div>
                               <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">
                                 الشعار
                              </label>
                              </div>
                       
                              <div class="ln_solid"></div>
                              <div class="form-group">
                              <div class="col-md-6">
                                <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ التغييرات </button>
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




@endsection