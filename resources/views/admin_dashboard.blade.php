<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Pal Tabib</title>
      <!-- Font Awesome -->
      <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
      <!-- Bootstrap -->
      <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
      
      <link href="{{asset('css/adminCSS.css')}}" rel="stylesheet">
    </head>
    <body>

      @include('includes.admin_nav')
      
  <div class="right_col" role="main">
          <div class="page-content">
            <div class="page-title">
            <div class="clearfix"></div>

            <div class="row">
          <!-- top tiles -->
          <div class="row tile_count" style="margin: 0; padding: 35px;">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Totle Clinics</span>
              <div class="count green">{{$clinics_count}}</div>
              <span class="count_bottom"><i class="green">4% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count">{{$users_count}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>3% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Number of doctors</span>
              <div class="count">{{$doctors_count}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Number of patients</span>
              <div class="count">{{$patients_count}}</div>
              <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Number of nurses</span>
              <div class="count">{{$nurses_count}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Total appoinments</span>
              <div class="count green">{{$appointments_count}}</div>
              <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
            </div>
          </div>
          <!-- /top tiles -->
           </div>
  </div>
    </div>
  </div>
         <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function(){

          $('#statistics').addClass("active");

        });
    </script>
  </body>
</html>
