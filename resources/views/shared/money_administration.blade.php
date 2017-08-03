
@extends(($user->role == 'Doctor')? 'doctor.layouts.master': (($user->role == 'Secretary') ? 'secretary.layouts.master' : 'manager.layouts.master'))


@section('content')


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
                <ul style="text-align: center;font-size: 14px;" class="dropdown-menu money-menu" role="menu">
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
                  
                  <div class="col-md-6 col-md-push-6 col-sm-6 col-xs-12">

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
                      <select  data-container="body" id="doctor" name="doctor" data-live-search="true" class="selectpicker form-control col-md-7 col-xs-12" required="required">
                        <optgroup label="الاطباء">
                        @if($href != 'doctor')
                            <?php
                            foreach($doctors as $doctor){
                              echo "<option value='".$doctor->user_name."'>".$doctor->name."(".$doctor->user_name.")"."</option>";

                            }
                            
                            ?>
                            @else
                              <option value='{{$user->user_name}}'>{{$user->name}}({{$user->user_name}})</option>
                            @endif
                        </optgroup>
                      </select>
                      </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="doctor">
                        الطبيب المعالج
                      </label>
                      </div>
                     

                        <div class="item form-group">
                      
                      <div class="col-md-8 col-sm-8 col-xs-12" >
                      <select data-container="body" id="pacient" name="pacient"  data-live-search="true" class="selectpicker form-control col-md-7 col-xs-12" required="required">
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
                        <input title="المبلغ المطلوب" type="number" id="value" name="value" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                        المبلغ المطلوب
                      </label>
                      </div>

                      <div class="item form-group">
                      <div class="col-md-8 col-sm-8 col-xs-12">
                        <input title="المبلغ المدفوع" type="number" id="paid_value" name="paid_value" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="value">
                        المبلغ المدفوع
                      </label>
                      </div>

                      <div class="item form-group">
                      
                      <div class="col-md-8 col-sm-8 col-xs-12" >
                      <select data-container="body" id="currency" name="currency"  data-live-search="true" class="selectpicker form-control col-md-7 col-xs-12" required="required">
                        <optgroup label="العملة">
                            <?php
                            foreach($currencies as $currency){
                              echo "<option value='".$currency->currency_code."'>".$currency->currency_code."</option>";

                            }
                            
                            ?>
                        </optgroup>
                      </select>
                      </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">
                        العملة
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

                  <div class="col-md-6 col-md-pull-6 col-sm-6 col-xs-12">
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

                        $writter = DB::table('users')
                        ->where('user_name', $bill->source)
                        ->first();


                      ?>
                        <article class="media event">
                          <a class="billTimec">
                            {{$bill->created_at}}
                          </a>
                          <div class="media-body">
                          <p class="title"><strong>رقم الفاتورة: </strong>{{$bill->id}}</p>
                            <p class="title"><strong>المحرر: </strong>{{$writter->name}}</p>
                            <br>
                            <p class="title"><strong>الطبيب: </strong>{{$doctorx->name}}</p>
                            <p class="title"><strong>المريض: </strong>{{$pacientx->name}}</p>
                            <br/>
                            <p><strong>الوصف: </strong>{{$bill->description}}</p>
                            <br/>
                            <p class="title"><strong>المبلغ المطلوب: </strong>{{$bill->value}} {{$bill->currency}}</p>
                            <p class="title"><strong>المبلغ المدفوع: </strong>{{$bill->paid_value}} {{$bill->currency}}</p>
                              <a class="pull-left">
                                <strong> الباقي: </strong>
                                {{$bill->value - $bill->paid_value}} {{$bill->currency}}
                              </a>
                            
                          </div>
                        </article>
                        <hr>
                      @endforeach
                      </div>
                        <a href="/dashboard/{{$href}}/allBills" class="btn btn-success pull-left">كافة فواتير المستحقات</a>
                      @endif
                    </div>
                    </div>

                  
                </div>
                <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-push-6">

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
                      
                      <div class="col-md-8 col-sm-8 col-xs-12" >
                      <select data-container="body" id="currency" name="currency"  data-live-search="true" class="selectpicker form-control col-md-7 col-xs-12" required="required">
                        <optgroup label="العملة">
                            <?php
                              foreach($currencies as $currency){
                                echo "<option value='".$currency->currency_code."'>".$currency->currency_code."</option>";
                              }
                            ?>
                        </optgroup>
                      </select>
                      </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">
                        العملة
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

                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-pull-6">
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
                          <?php
                        
                        $writter = DB::table('users')
                        ->where('user_name', $expense->source)
                        ->first();

                      ?>
                        <article class="media event">
                          <a class="pull-left">
                            {{$expense->created_at}}
                          </a>
                          <div class="media-body">
                          <p class="title"><strong>رقم الفاتورة: </strong>{{$expense->id}}</p>
                            <p class="title"><strong>المحرر: </strong>{{$writter->name}}</p>
                            <br>
                            <p class="title"><strong>المبلغ: </strong>{{$expense->value}} {{$bill->currency}}</p>
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

                  
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>


  </div>
</div>
<!-- /page content -->
		

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

@endsection