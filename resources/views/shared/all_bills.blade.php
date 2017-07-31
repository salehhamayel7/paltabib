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

      <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
            
            <ul class="nav navbar-left panel_toolbox">
              <li><a></a>
              </li>
              <li><a id = "collapse2" class="collapse-link" title = "hide/show"><i class="fa fa-chevron-up fa-lg"></i></a>
              </li>
                <a href="/dashboard/{{$href}}/money" class="btn btn-round btn-success"> رجوع <i class="fa fa-arrow-left"></i></a>
            </ul>
            <h2 style="float:right;">كافة الفواتير المستحقة <small>اضغط على الفاتورة للمزيد</small></h2>
            
            <div class="clearfix"></div>
            </div>
            <div class="x_content" id="page_contentD">
              <table dir="rtl" id="datatable-buttons" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>رقم الفاتورة</th>
                    <th>التاريخ</th>
                    <th>المحرر</th>
                    <th>الطبيب المعالج</th>
                    <th>المريض</th>
                    <th>المبلغ المطلوب</th>
                    <th>البلغ المدفوع</th>
                    <th>المبلغ المتبقي</th>
                    <th>الملاحظات</th>
                  </tr>
                </thead>


                <tbody>
                @foreach($bills as $bill)
                  <?php
                    $pacientx = DB::table('users')->where('user_name', '=', $bill->pacient_id)->first(); 
                    $writter = DB::table('users')->where('user_name', '=', $bill->source)->first();
                  ?>
                  <tr title="اضغط لمزيد من الخيارات" class="billInfo" data="{{$bill->id}}">
                    <th>{{$bill->id}}</th>
                    <th>{{$bill->created_at}}</th>
                    <th>{{$writter->name}}</th>
                    <th>{{$bill->name}}</th>
                    <th>{{$pacientx->name}}</th>
                    <th>{{$bill->value}}</th>
                    <th>{{$bill->paid_value}}</th>
                    <th>{{$bill->remained_value}}</th>
                    <th>{{$bill->description}}</th>
                    
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


 <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title pull-right" id="exampleModalLabel">ملخص فاتورة</h3>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <article class="media event">
          <div class="media-body">
          <form id="updateBillForm" action="/dashboard/{{$href}}/updateBill" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

          <p class="title billLabel"><strong>رقم الفاتورة: </strong>
            <input class="form-control col-md-5 col-xs-12" type="number" name="billID" id="billID" readonly>
            </input></p>

            <p class="title billLabel"><strong>التاريخ: </strong>
            <input class="form-control col-md-5 col-xs-12" type="text" name="billTime" id="billTime" readonly>
            </input></p>

             <p class="title billLabel"><strong>المحرر: </strong>
            <input class="form-control col-md-5 col-xs-12" type="text" name="billSource" id="billSource" readonly>
            </input></p>

            <p class="title billLabel"><strong>الطبيب: </strong>
             <select id="billDoctor" name="billDoctor" class="form-control col-md-5 col-xs-12" required="required">
                 <optgroup label="الاطباء">
                    <?php
                    foreach($doctors as $doctor){
                      echo "<option value='".$doctor->user_name."'>".$doctor->name."(".$doctor->user_name.")"."</option>";

                    }
                    
                    ?>
                </optgroup>
              </select>
            </p>
            <p class="title billLabel"><strong>المريض: </strong>
              <select id="billPacient" name="billPacient" class="form-control col-md-5 col-xs-12" required="required">
                <optgroup label="المرضى">
                    <?php
                    foreach($pacients as $pacient){
                      echo "<option value='".$pacient->user_name."'>".$pacient->name."(".$pacient->user_name.")"."</option>";

                    }
                    
                    ?>
                </optgroup>
              </select>
            </p>
            <p class="title billLabel"><strong>المبلغ المطلوب: </strong>
            <input class="form-control col-md-5 col-xs-12" type="number" name="billValue" id="billValue">
            </input></p>
            <p class="title billLabel"><strong>المبلغ المدفوع: </strong>
            <input class="form-control col-md-5 col-xs-12" type="number" name="billPainValue" id="billPainValue">
            </input></p>
            <br/>
            <p class="title billLabel"><strong>الوصف: </strong>
            <input class="form-control col-md-5 col-xs-12" type="text" id="billDesc" name="billDesc"></input>
            </p>
            
          </div>
        </article>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success"><i class="fa fa-floppy-o"></i> حفظ التغييرات </button>
        <button type="button" class="btn btn-success"><i class="fa fa-print"></i> طباعة</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection