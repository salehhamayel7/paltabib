@extends('layouts.app')

@section('content')

<?php
if(Auth::user()->role == 'Doctor'){
$href='doctor';
}
elseif(Auth::user()->role == 'Secretary'){
$href='secretary';
}
elseif(Auth::user()->role == 'Pacient'){
$href='pacient';
}
else{
$href='manager';
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-success">
                <div class="panel-heading">لقد سجلت الدخول!</div>

                <div class="panel-body">
                    <div class="row" style="text-align: center;">
                       

                        <div class="col-md-4">
                            <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                <button style="color: #6f6b6b;" class="btn btn-secondary">
                                    تسجيل الخروج
                                </button>
                            </a>
                             
                        </div>


                         <div class="col-md-4">
                            <a href="/contactUs">
                                <button class="btn btn-primary">
                                    اتصل بنا
                                </button>
                            </a>
                             
                        </div>


                         <div class="col-md-4">
                            <a href="/dashboard/{{$href}}">
                                <button class="btn btn-success">
                                    الصفحة الرئيسية
                                </button>
                            </a>
                             
                        </div>


                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
 <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
       {{ csrf_field() }}
 </form>
@endsection
