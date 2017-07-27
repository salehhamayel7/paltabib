
 @extends('admin/layouts.master')
@section('content')

<div class="right_col" role="main">
  <div class="page-content">
    <div class="page-title">
      <div class="clearfix"></div>
        <div class="row col-md-10 col-md-offset-1" style="margin-top: 35px;">

        @foreach($methods as $method)

          <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
              <img class="paymentPic" src="{{$method->image}}" alt="...">
              <div class="caption">
                <h3>{{$method->title}}</h3>
                <p>{{$method->description}}</p>
                <h3>Price: {{$method->price}}</h3>
                <hr>
                <p><a data="{{$method->id}}" class="btn btn-success editCard" role="button">Edit</a></p>
              </div>
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
          <span class="input-group-addon" id="basic-addon1">Method Title</span>
          <input id="cardtitle" name="title" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
        </div>
        <br>

        <div class="input-group">
          <span class="input-group-addon" id="basic-addon2">Method Image</span>
          <input id="Simage" name="image" type="file" accept="image/*" class="form-control" aria-describedby="basic-addon2">
        </div>
        <br>
        <div class="input-group">
          <span class="input-group-addon" id="basic-addon3">Method Description</span>
          <textarea id="carddescription" name="description" required rows="" cols="" class="form-control" placeholder="Description" aria-describedby="basic-addon3"></textarea> 
        </div>

        <br>
         <div class="input-group">
          <span class="input-group-addon" id="basic-addon1">Method Price</span>
          <input id="cardprice" name="price" required type="text" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
        </div>
       
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