  
<nav class="navbar navbar-default" style="margin-bottom: 0;">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Pal Tabib</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li>
          <a class="user-profile"  style="padding:0px 12px;">
            <img style="height: 50px;" class="img-circle img-thumbnail" 
                  src="/images/users/{{ Auth::user()->image}}" alt="avatar">
            {{ Auth::user()->name }}
          </a>                   
        </li>
        <li id="statistics"><a href="/dashboard/admin">Statistics</a></li>
        <li id="homeconfig"><a href="/dashboard/admin/HomeConfig">Home Page Config</a></li>
        <li id="allclicnics"><a href="/dashboard/admin/allClinics">All Clinics</a></li>
        <li id="registere"><a href="/dashboard/admin/clinicRegistration">Registere a Clinic</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        
         <li>                    
          <a href="{{ url('/logout') }}"
                onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
                Log out
            </a>
                    
          </li>

            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
              </form>

        </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>