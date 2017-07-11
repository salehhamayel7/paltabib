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

    <title>المصروفات</title>

    <!-- Bootstrap -->
    <link href="{{asset('../vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('../vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{asset('../vendors/nprogress/nprogress.css')}}" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{asset('../vendors/iCheck/skins/flat/green.css')}}" rel="stylesheet">
    <!-- Datatables -->
    <link href="{{asset('../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css')}}" rel="stylesheet">
    
    <!-- bootstrap-progressbar -->
    <link href="{{asset('../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet">
    <!-- JQVMap -->
    <link href="{{asset('../vendors/jqvmap/dist/jqvmap.min.css')}}" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{asset('../build/css/custom.min.css')}}" rel="stylesheet">
	<link href="{{asset('../css/custumCSS.css')}}" rel="stylesheet">
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
          <div class="">
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
									    <a href="/dashboard/manager/money" class="btn btn-round btn-success"> رجوع <i class="fa fa-arrow-left"></i></a>
									</ul>
									<h2 style="float:right;">فواتير المصروفات</h2>
									<script>
										window.onload = function(){
										
											document.getElementById('collapse2').click();
											document.getElementById('collapse2').click();
										};
									</script>
									<div class="clearfix"></div>
								  </div>
                  <div class="x_content" id="page_contentD">
                   
                    <table dir="rtl" id="datatable-buttons" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th>رقم الفاتورة</th>
                          <th>المبلغ</th>
                          <th>الملاحظات</th>
                        </tr>
                      </thead>


                      <tbody>
                      @foreach($expenses as $expense)
                        <tr title="اضغط لمزيد من الخيارات" class="expenseInfo" data="{{$expense->id}}">
						              <th>{{$expense->id}}</th>
                          <th>{{$expense->value}}</th>
                          <th>{{$expense->description}}</th>
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
          <form id="updateBillForm" action="/dashboard/manager/updateExpense" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">

          <p class="title billLabel"><strong>رقم الفاتورة: </strong>
            <input class="form-control col-md-5 col-xs-12" type="number" name="expenseID" id="expenseID" readonly>
            </input></p>

            <p class="title billLabel"><strong>التاريخ: </strong>
            <input class="form-control col-md-5 col-xs-12" type="text" name="expenseTime" id="expenseTime" readonly>
            </input></p>

            <p class="title billLabel"><strong>المبلغ: </strong>
            <input class="form-control col-md-5 col-xs-12" type="number" name="expenseValue" id="expenseValue">
            </input></p>
            <br/>
            <p class="title billLabel"><strong>الوصف: </strong>
            <input class="form-control col-md-5 col-xs-12" type="text" id="expenseDesc" name="expenseDesc"></input>
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

    <!-- jQuery -->
    <script src="{{asset('../vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('../vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('../vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{asset('../vendors/nprogress/nprogress.js')}}"></script>
    <!-- Chart.js -->
    <script src="{{asset('../vendors/Chart.js/dist/Chart.min.js')}}"></script>
    <!-- gauge.js -->
    <script src="{{asset('../vendors/gauge.js/dist/gauge.min.js')}}"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{asset('../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('../vendors/iCheck/icheck.min.js')}}"></script>
    <!-- Skycons -->
    <script src="{{asset('../vendors/skycons/skycons.js')}}"></script>
    <!-- Flot -->
    <script src="{{asset('../vendors/Flot/jquery.flot.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.pie.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.time.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.stack.js')}}"></script>
    <script src="{{asset('../vendors/Flot/jquery.flot.resize.js')}}"></script>
    <!-- Flot plugins -->
    <script src="{{asset('../vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
    <script src="{{asset('../vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
    <script src="{{asset('../vendors/flot.curvedlines/curvedLines.js')}}"></script>
    <!-- DateJS -->
    <script src="{{asset('../vendors/DateJS/build/date.js')}}"></script>
    <!-- JQVMap -->
    <script src="{{asset('../vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
    <script src="{{asset('../vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('../vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="{{asset('../vendors/moment/min/moment.min.js')}}"></script>
    <script src="{{asset('../vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
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
      $(document).ready(function(){

         $('.expenseInfo').on('click',function(){
                var expense_id = $(this).attr('data');
               
                 $.get("/ajax/expense/show/"+expense_id,function(data){

                     $('#expenseTime').val(data.expense.created_at);
                     $('#expenseID').val(data.expense.id);
                     $('#expenseValue').val(data.expense.value);
                     $("#expenseDesc").val(data.expense.description);
                     $('#myModal').modal('show');

                 });


            });
           


      });
    </script>
  </body>
</html>
