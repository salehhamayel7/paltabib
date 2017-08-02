<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Pal Tabib</title>
       <link href="{{asset('css/homeCSS.css')}}" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
    <link href="{{asset('vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <!-- Styles -->
        <!-- Bootstrap -->
    <link href="{{asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    </head>
    <body>
    <div class="navbar-wrapper">
      <div class="container">

        <nav class="navbar navbar-default navbar-static-top navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="/">Pal Tabib</a>
            </div>
            
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                  
                <li id="homeN"><a href="/">Home</a></li>
                <li id="homeN"><a href="#about">About</a></li>
                <li id="pricingN"><a href="/pricing">Pricing</a></li>
                <li id="contactN"><a href="/contact">Contact</a></li>
               
              </ul>
              <ul class="nav navbar-nav navbar-right">
                @if (Route::has('login'))
                
                    @if (Auth::check())
                    <li>
                        <a href="{{ url('/home') }}">My Account</a>
                        </li>
                    <li>
                        <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">Logout</a>
                          </li>
                    @else
                    <li>
                        <a href="{{ url('/login') }}">Login</a>
                        </li>
                    @endif
                
            @endif
            </ul>
            </div>
          </div>
        </nav>

      </div>
    </div>



@yield('content')


<style>

</style>
       <!-- FOOTER -->
      <footer class="col-md-12 col-sm-12 col-xs-12">
         PalTabib - Clinic Managment System. All right resarved. @ 
         <a target="_Blank" href="http://www.palmec.ps">  (Palmec) </a>
      </footer>

   <!-- /.container -->

<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>

         <!-- jQuery -->
    <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
    <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    </body>
</html>