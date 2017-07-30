<div class="top_nav navbar-fixed-top">
          <div class="nav_menu">
            <nav>
              

              <ul class="nav navbar-nav navbar-left row" style="width:100%; margin: 0px;">

                <li class="col-sm-3 nav-user" style="padding: 0;">
                  <a style="" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="/images/users/{{$user->image}}" alt="">{{$user->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu" style="text-align: right; font-size: 13px; width: 100%;">
                    <li><a href="/dashboard/{{$href}}"> الرئيسية</a></li>
                    <hr style="margin:0px;">
                    <li><a style="padding-left: 0;" href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out pull-left"></i> تسجيل الخروج</a></li>
                  </ul>
                </li>



                <li role="presentation" class="dropdown col-md-1 col-sm-2">
                  <a  class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false" style="text-align: center;">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">{{count($new_msgs)}}</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list nav-msgs" role="menu">
                  <?php
                  $count=0;
                    foreach($new_msgs as $nmsg){
                      if($count<5){
                        ?>

                        <li style="text-align: right;">
                        <a href="/dashboard/{{$href}}/inbox/{{$nmsg->msg_id}}">
                          <span class="image"><img src="/images/users/{{$nmsg->image}}" alt="Profile Image" /></span>
                          <span>
                            <span>{{$nmsg->name}}</span>
                            <span class="time" style="float: left;position: inherit;">{{$nmsg->msg_time}}</span>
                          </span>
                          <span class="message">{{$nmsg->title}}</span>
                        </a>
                      </li>

                        <?php
                      }
                      $count++;
                    }
                  ?>
                    
                    <li>
                      <div class="text-center">
                        <a href="/dashboard/{{$href}}/inbox">
                          <strong>كل الرسائل الواردة</strong>
                          <i class="fa fa-angle-left"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>



                
                <div class="nav toggle pull-right">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              </ul>
              
            </nav>
          </div>
        </div>

        <form id="logout-form" action="/logout" method="POST" style="display: none;">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>