@extends('admin/layouts.master')
@section('content')

      
  <div class="right_col" role="main">
    <div class="page-content">
      <div class="page-title">
        <div class="clearfix"></div>
          <div class="row" style="margin-top: 20px;">

            <div class="col-md-10 col-md-offset-1">
              <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Slider Configurations
                      </a>
                    </h4>
                  </div>
                  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body" style="padding-bottom: 0px;">
                      <div class="row">

                      <div class="col-md-7 col-sm-12 col-xs-12" style="padding: 20px;">
                      Add a Slide
                      <hr>
                      <form method="POST" action="/slider/add" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Slider Title</span>
                        <input id="Stitle" name="title" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon2">Slider Image</span>
                        <input id="Simage" name="image" required type="file" accept="image/*" class="form-control" aria-describedby="basic-addon2">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon3">Slider Description</span>
                        <textarea id="Sdescription" name="description" required rows="" cols="" class="form-control" placeholder="Description" aria-describedby="basic-addon3"></textarea> 
                      </div>

                      <br>
                      <div class="input-group col-md-offset-3 col-md-8 col-sm-12 col-xs-12">
                        <input value="Add Slider" type="submit" class="btn btn-success" id="basic-addon3"></input>
                      </div>

                      </form>
                      
                      </div>

                      <div class="col-md-5 col-sm-12 col-xs-12" style="padding: 20px;">

                      All Sliders
                      <hr>
                    <table class="table sliderTable">
                        
                          <tbody>
                            @foreach($sliders as $slider)
                            <tr>
                              <th scope="row">Slider id: {{$slider->id}}</th>
                              <td><a class="PreviewSlide" data="{{$slider->id}}"> Preview</a></td>
                            <th>

                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width: 20px;">
                                    <li><a class="showSlide" data="{{$slider->id}}"><i class="fa fa-eye"></i> Show </a></li>
                                    <li><a class="EditSlide" data="{{$slider->id}}"><i class="fa fa-edit"></i> Edit </a></li>
                                    <li><a class="DeleteSlide" data="{{$slider->id}}"><i class="fa fa-trash-o"></i> Delete </a></li>
                                  </ul>
                                </div>
                            
                            </th>
                            </tr>

                          @endforeach


                          </tbody>
                        </table>
                          {{ $sliders->links() }}
                      </div>

                    </div>
                  </div>
                  </div>
                </div>
                <div class="panel panel-default">
                  <div class="panel-heading" role="tab" id="headingTwo">
                    <h4 class="panel-title">
                      <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Page Content Configurations
                      </a>
                    </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="panel-body">
                        <div class="row">

                      <div class="col-md-7 col-sm-12 col-xs-12" style="padding: 20px;">
                      Add a Section
                      <hr>
                      <form method="POST" action="/section/add" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Section Title</span>
                        <input id="Setitle" name="title" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
                      </div>
                      <br>

                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon2">Section Image</span>
                        <input id="Seimage" name="image" required type="file" accept="image/*" class="form-control" aria-describedby="basic-addon2">
                      </div>
                      <br>
                      <div class="input-group">
                        <span class="input-group-addon" id="basic-addon3">Section Description</span>
                        <textarea id="Sedescription" name="description" required rows="" cols="" class="form-control" placeholder="Description" aria-describedby="basic-addon3"></textarea> 
                      </div>

                      <br>
                      <div class="input-group col-md-offset-3 col-md-8 col-sm-12 col-xs-12">
                        <input value="Add Section" type="submit" class="btn btn-success" id="basic-addon3"></input>
                      </div>

                      </form>
                      
                      </div>

                      <div class="col-md-5 col-sm-12 col-xs-12" style="padding: 20px;">

                      All Sections
                      <hr>
                    <table class="table sliderTable">
                        
                          <tbody>
                            @foreach($sections as $section)
                            <tr>
                              <th scope="row">Section id: {{$section->id}}</th>
                              <td><a class="PreviewSection" data="{{$section->id}}"> Preview</a></td>
                            <th>

                                <div class="dropdown">
                                  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    Action
                                    <span class="caret"></span>
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" style="min-width: 20px;">
                                    <li><a class="showSection" data="{{$section->id}}"><i class="fa fa-eye"></i> Show </a></li>
                                    <li><a class="EditSection" data="{{$section->id}}"><i class="fa fa-edit"></i> Edit </a></li>
                                    <li><a class="DeleteSection" data="{{$section->id}}"><i class="fa fa-trash-o"></i> Delete </a></li>
                                  </ul>
                                </div>
                            
                            </th>
                            </tr>

                          @endforeach


                          </tbody>
                        </table>
                          {{ $sections->links() }}
                      </div>

                    </div>
                    </div>
                  </div>
                </div>
               
              </div>
              
            </div>
          </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="slideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel">Slide View</h5>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

       
          <!-- Indicators -->
         
            <div class="item">
              <img id="slideImg" class="first-slide" style="filter: brightness(60%); max-height: 365px;object-fit: cover; display: block;min-width: 100%;"  src="http://lorempixel.com/1000/300/abstract/qwe2" alt="First slide">
              <div class="container">
                <div class="carousel-caption">
                  <h1 id="slideTitle">sdfsdfsdfsdf</h1>
                  <p id="slideDes">sdfsd fsd fsd sd fsd fds fsd fds fsd fsd</p>
                </div>
              </div>
            </div>
         
        
        <!-- /.carousel -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="sectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width: 100%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel">Section View</h5>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="row featurette">
        <div class="col-md-7">
          <h2 id="sectionTitle" class="featurette-heading">
            
          </h2>
          <p id="sectionDes" class="lead">
            
          </p>
        </div>
        <div class="col-md-5">
          <img style="width:100%;" id="sectionImg" class="featurette-image img-responsive center-block" src="" alt="Generic placeholder image">
        </div>
      </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editslideModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel">Edit Slide</h5>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <form method="POST" action="/slider/update" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="Eslideid" name="id" value="">
            <div class="input-group">
            <span class="input-group-addon" id="basic-addon1">Slider Title</span>
            <input id="eStitle" name="title" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
          </div>
          <br>

          <div class="input-group">
            <span class="input-group-addon" id="basic-addon2">Slider Image</span>
            <input id="eSimage" name="image" type="file" accept="image/*" class="form-control" aria-describedby="basic-addon2">
          </div>
          <br>
          <div class="input-group">
            <span class="input-group-addon" id="basic-addon3">Slider Description</span>
            <textarea id="eSdescription" name="description" required rows="" cols="" class="form-control" placeholder="Description" aria-describedby="basic-addon3"></textarea> 
          </div>

      </div>
      <div class="modal-footer">
            <input value="Save changes" type="submit" class="btn btn-success" id="basic-addon3"></input>
      </div>
       </form>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pull-left" id="exampleModalLabel">Edit Section</h5>
        <button type="button" class="close pull-right" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="POST" action="/section/update" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" id="Esectionid" name="id" value="">
          <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Section Title</span>
          <input id="Esectiontitle" name="title" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
        </div>
        <br>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon2">Section Image</span>
          <input id="Esectionimage" name="image" type="file" accept="image/*" class="form-control" aria-describedby="basic-addon2">
        </div>
        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Section Description</span>
          <textarea id="Esectiondescription" name="description" required rows="" cols="" class="form-control" placeholder="Description" aria-describedby="basic-addon3"></textarea> 
        </div>

        <br>
        <div class="input-group col-md-offset-3 col-md-8 col-sm-12 col-xs-12">
          <input value="Update Section" type="submit" class="btn btn-success" id="basic-addon3"></input>
        </div>

        </form>
    </div>
  </div>
</div>
@endsection

    
  