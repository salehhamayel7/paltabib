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

   
    @include('includes.Datatables_links')
   @include('includes.links')
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
@include('includes.scrtipts_src')
  @include('includes.Datatables_scripts')

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
