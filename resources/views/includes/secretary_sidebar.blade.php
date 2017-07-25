<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>القوائم</h3>
    <ul class="nav side-menu">
      <li><a href="/dashboard/secretary"><i class="fa fa-home"></i> الصفحة الرئيسية</a>
      </li>
      <li><a href="/dashboard/secretary/pacients"><i class="fa fa-edit"></i>ادارة المرضى</a>
      </li>
      <li><a><i class="fa fa-comments"></i> البريد <span class="fa fa-chevron-down pull-left"></span></a>
        <ul class="nav child_menu">
          <li><a href="/dashboard/secretary/inbox">البريد الوارد</a></li>
          <li><a href="/dashboard/secretary/outbox">البريد الصادر</a></li>
        </ul>
      </li>
      <li><a href="/dashboard/secretary/money"><i class="fa fa-usd"></i>المالية
        <span class="badge bg-green pull-left notificationsX">
        {{$money_notification}}
        </span>
      </a></li>
      <li><a href="/dashboard/secretary/calendar"><i class="fa fa-calendar"></i>التقويم</a>
      </li>
    </ul>
  </div>

</div>