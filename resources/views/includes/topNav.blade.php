<div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <ul class="nav navbar-nav navbar-left">
               <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="/images/users/{{$user->image}}" alt="avatar">{{$user->name}}
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="/dashboard/{{$href}}"> الرئيسية</a></li>
                    <hr style="margin: 0px;"/>
                    <li><a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i>تسجيل الخروج</a></li>
                  </ul>
                </li>

                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                   <input type="hidden" name="_token" value="{{csrf_token()}}">
                </form>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">{{count($new_msgs)}}</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
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
              </ul>
            </nav>
          </div>
        </div>