<!DOCTYPE html>
<html lang="en">
    <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>Pal Tabib</title>

       <!-- Bootstrap -->
      <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
      <!-- Font Awesome -->
      <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
      @include('includes.Datatables_links')
      <link href="{{asset('css/adminCSS.css')}}" rel="stylesheet">
      
    </head>
    <body>

      @include('includes.admin_nav')

      @yield('content')

    <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>

    
    <?php
        $url =  $_SERVER['REQUEST_URI'];

       if (strpos($url, 'allClinics') !== false) {
        ?>
            @include('admin.scripts.allClinics_script')
        <?php
        }
        else if (strpos($url, 'clinicRegistration') !== false) {
        ?>
            @include('admin.scripts.regClinic_script')
        <?php
        }
        else if (strpos($url, 'HomeConfig') !== false) {
        ?>
            @include('admin.scripts.homeConfig_script')
        <?php
        }
        else{
        ?>  
            @include('admin.scripts.home_script')

        <?php
        }
    ?>


    </body>
</html>