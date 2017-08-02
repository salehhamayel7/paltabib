@extends('home.layouts.master')
@section('content')



    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
          <img class="first-slide" style="filter: brightness(60%);"  src="{{$sliders[0]->image}}" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>{{$sliders[0]->title}}</h1>
              <p>{{$sliders[0]->description}}</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="second-slide" style="filter: brightness(60%);"  src="{{$sliders[1]->image}}" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>{{$sliders[1]->title}}</h1>
              <p>{{$sliders[1]->description}}</p>
            </div>
          </div>
        </div>
        <div class="item">
          <img class="third-slide" style="filter: brightness(60%);"  src="{{$sliders[2]->image}}" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>{{$sliders[2]->title}}</h1>
              <p>{{$sliders[2]->description}}</p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

      <!-- Three columns of text below the carousel -->
      <div class="row">
     
        <div class="col-lg-4 col-md-4">
          <img class="img-circle" src="{{$quick_menu[0]->image}}" alt="Generic placeholder image" width="140" height="140">
          <h2>{{$quick_menu[0]->title}}</h2>
          <p>{{$quick_menu[0]->description}}</p>
          <p><a class="btn btn-success" href="/pricing" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 col-md-4">
          <img class="img-circle" src="{{$quick_menu[1]->image}}" alt="Generic placeholder image" width="140" height="140">
          <h2>{{$quick_menu[1]->title}}</h2>
          <p>{{$quick_menu[1]->description}}</p>
          <p><a class="btn btn-success" href="/contact" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4 col-md-4">
          <img class="img-circle" src="{{$quick_menu[2]->image}}" alt="Generic placeholder image" width="140" height="140">
          <h2>{{$quick_menu[2]->title}}</h2>
          <p>{{$quick_menu[2]->description}}</p>
          <p><a class="btn btn-success" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->

      </div><!-- /.row -->


      <!-- START THE FEATURETTES -->

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">
            {{$sections[0]->title}}
          </h2>
          <p class="lead">
            {{$sections[0]->description}}
          </p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="{{$sections[0]->image}}" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7 col-md-push-5">
          <h2 class="featurette-heading">
            {{$sections[1]->title}}
          </h2>
          <p class="lead">
            {{$sections[1]->description}}
          </p>
          </div>
        <div class="col-md-5 col-md-pull-7">
          <img class="featurette-image img-responsive center-block" src="{{$sections[1]->image}}" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 class="featurette-heading">
            {{$sections[2]->title}}
          </h2>
          <p class="lead">
            {{$sections[2]->description}}
          </p>
        </div>
        <div class="col-md-5">
          <img class="featurette-image img-responsive center-block" src="{{$sections[2]->image}}" alt="Generic placeholder image">
        </div>
      </div>

      <hr class="featurette-divider">

      <!-- /END THE FEATURETTES -->

 </div>

 <script type="text/javascript">
   $('#homeN').addClass('active');
 </script>
 
@endsection