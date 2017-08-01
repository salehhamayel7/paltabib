

@extends('home.layouts.master')
@section('content')


<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="margin-top: 40px; min-height: 500px;">


<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Pricing Table
            <small>You can choose what is right for you</small>
        </h1>
    </div>
</div>
 @foreach($methods as $method)

  <div class="col-md-4">
        <div class="panel panel-success text-center">
            <div class="panel-heading">
                <h3 class="panel-title">{{$method->type}}</h3>
            </div>
            <div class="panel-body">
                <span class="price"><sup>$</sup>{{$method->price - 1}}<sup>99</sup></span>
                <span class="period">{{$method->method}}</span>
            </div>
            <ul class="list-group">
                <li class="list-group-item">{{$method->description1}}</li>
                <li class="list-group-item">{{$method->description2}} </li>
                <li class="list-group-item">{{$method->description3}}</li>
                <li class="list-group-item">{{$method->description4}}</li>
                <li class="list-group-item">{{$method->description5}}</li>
                <li class="list-group-item"><a href="/contact" class="btn btn-success">Join Us</a>
                </li>
            </ul>
        </div>
    </div>

    @endforeach
    
</div>


 <script type="text/javascript">
   $('#pricingN').addClass('active');
 </script>

@endsection