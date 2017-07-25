<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <h3>القوائم</h3>
    <ul class="nav side-menu">
      <li><a href="/dashboard/manager"><i class="fa fa-home"></i> الصفحة الرئيسية</span></a>
      </li>
      <li><a href="/dashboard/manager/myClinic"><i class="fa fa-building"></i>عيادتي</span></a>
      </li>
      <li><a><i class="fa fa-edit"></i> الادارة <span class="fa fa-chevron-down pull-left"></span></a>
        <ul class="nav child_menu">
          <li><a href="/dashboard/manager/doctors">ادارة الاطباء</a></li>
          <li><a href="/dashboard/manager/secretaries">ادارة السكرتاريا</a></li>
          <li><a href="/dashboard/manager/nurses">ادارة الممرضين</a></li>
          <li><a href="/dashboard/manager/pacients">ادارة المرضى</a></li>
        </ul>
      </li>
      <li><a><i class="fa fa-comments"></i> البريد <span class="fa fa-chevron-down pull-left"></span></a>
        <ul class="nav child_menu">
          <li><a href="/dashboard/manager/inbox">البريد الوارد</a></li>
          <li><a href="/dashboard/manager/outbox">البريد الصادر</a></li>
        </ul>
      </li>
      <li><a href="/dashboard/manager/money"><i class="fa fa-usd"></i>المالية 
        
        <span class="badge bg-green pull-left notificationsX">
         {{$money_notification}}
        </span>
          
      </a>
      </li>
      <li><a href="/dashboard/manager/patientsRecords"><i class="fa fa-book"></i>سجل المرضى والمراجعات</a>
      </li>
      <li><a href="/dashboard/manager/search"><i class="fa fa-search"></i>البحث</a>
      </li>
      @if($user->role == "Manager,Doctor")
      <li><a href="/dashboard/manager/myCalendar"><i class="fa fa-calendar"></i>التقويم (مواعيدي)</a>
      </li>
      @endif
        <li><a href="/dashboard/manager/calendar"><i class="fa fa-calendar"></i>تقويم الاطباء</a>
      </li>
    </ul>
  </div>
</div>