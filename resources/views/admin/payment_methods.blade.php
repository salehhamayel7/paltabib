
 @extends('admin/layouts.master')
@section('content')

<div class="right_col" role="main">
  <div class="page-content">
    <div class="page-title">
      <div class="clearfix"></div>
        <div class="row col-md-10 col-md-offset-1" style="margin-top: 35px;">

          @foreach($methods as $method)

          <div class="col-md-4">
                <div class="panel panel-success text-center">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{$method->type}}</h3>
                    </div>
                    <div class="panel-body">
                        <span class="price"><sup>$</sup>{{$method->price - 1}}<sup>99</sup></span>
                        <span class="period">per month</span>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>{{$method->description1}}</strong></li>
                        <li class="list-group-item"><strong>{{$method->description2}}</strong> </li>
                        <li class="list-group-item"><strong>{{$method->description3}}</strong></li>
                        <li class="list-group-item"><strong>{{$method->description4}}</strong></li>
                        <li class="list-group-item"><strong>{{$method->description5}}</strong></li>
                        <li  data="{{$method->id}}" class="list-group-item editCard"><a class="btn btn-success">Edit</a>
                        </li>
                    </ul>
                </div>
            </div>

             @endforeach
            

        </div>  
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="editcardmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Payment Method</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="/payment_method/edit" enctype="multipart/form-data">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="id" id="methodID">
          <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Type</span>
          <input id="cardtype" name="type" required type="text" class="form-control" placeholder="type" aria-describedby="basic-addon1">
        </div>
        <br>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Method</span>
          <input id="cardmethod" name="method" required type="text" class="form-control" placeholder="Method" aria-describedby="basic-addon1">
        </div>
        <br>

         <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Method Price</span>
          <input id="cardprice" name="price" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
        </div>
        <br>

       
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Description 1</span>
          <input id="carddes1" name="carddes1" required type="text" class="form-control" aria-describedby="basic-addon1">
        </div>

        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Description 2</span>
          <input id="carddes2" name="carddes2" required type="text" class="form-control" aria-describedby="basic-addon1">
        </div>

        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Description 3</span>
          <input id="carddes3" name="carddes3" required type="text" class="form-control" aria-describedby="basic-addon1">
        </div>

        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Description 4</span>
          <input id="carddes4" name="carddes4" required type="text" class="form-control" aria-describedby="basic-addon1">
        </div>

        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Description 5</span>
          <input id="carddes5" name="carddes5" required type="text" class="form-control" aria-describedby="basic-addon1">
        </div>

        <br>
        
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input value="Save Changes" type="submit" class="btn btn-success" id="basic-addon3"></input>      
        </div>
        </form>
    </div>
  </div>
</div>
       
@endsection