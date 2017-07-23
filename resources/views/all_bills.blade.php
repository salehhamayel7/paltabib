<?php
use App\User;
use App\Doctor;
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

    <title>المستحقات</title>

   @include('includes.links')
   @include('includes.Datatables_links')
    
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title navbar-fixed-top" style="border: 0;">
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
									<h2 style="float:right;">كافة الفواتير</h2>
									
									<div class="clearfix"></div>
								  </div>
                  <div class="x_content" id="page_contentD">
                   
                    <table dir="rtl" id="datatable-buttons" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>رقم الفاتورة</th>
                          <th>التاريخ</th>
                          <th>الطبيب المعالج</th>
                          <th>المريض</th>
                          <th>المبلغ المطلوب</th>
                          <th>البلغ المدفوع</th>
                          <th>الملاحظات</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($bills as $bill)
                        <?php $pacientx = DB::table('users')->where('user_name', '=', $bill->pacient_id)->first(); ?>
                        <tr title="اضغط لمزيد من الخيارات" class="billInfo" data="{{$bill->id}}">
						              <th>{{$bill->id}}</th>
                          <th>{{$bill->created_at}}</th>
                          <th>{{$bill->name}}</th>
                          <th>{{$pacientx->name}}</th>
                          <th>{{$bill->value}}</th>ر
                          <th>{{$bill->paid_value}}</th>
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

        <!-- footer content -->
        @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>

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

  @include('includes.scrtipts_src')
  @include('includes.Datatables_scripts')

   

    <script type="text/javascript">
      $(document).ready(function(){

         $('.billInfo').on('click',function(){
                var bill_id = $(this).attr('data');
               
                 $.get("/ajax/bill/show/"+bill_id,function(data){

                     $('#billTime').val(data.bill.created_at);
                     $('#billID').val(data.bill.id);
                     $('#billDoctor').val(data.doctor.user_name);
                     $('#billPacient').val(data.pacient.user_name);
                     $('#billValue').val(data.bill.value);
                     $('#billPainValue').val(data.bill.paid_value);
                     $("#billDesc").val(data.bill.description);
                     $('#myModal').modal('show');

                 });


            });
           


      });
    </script>
  </body>
</html>
