

@extends('home.layouts.master')
@section('content')

<style>
    #map {
        height: 400px;
        width: 100%;
    }
</style>

<div class="col-md-10 col-md-offset-1 col-sm-12 col-xs-12" style="margin-top: 80px;">

<!-- Content Row -->
<div class="row">
    <!-- Map Column -->
    <div class="col-md-8">
        <!-- Embedded Google Map -->
        <div id="map"></div>
        <script>
            function initMap() {
                var uluru = {lat: 32.224272, lng: 35.255118};
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 13,
                center: uluru
                });
                var marker = new google.maps.Marker({
                position: uluru,
                map: map
                });
            }
        </script>
        <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaoMn2XYDuMccL4AOGtKWDIdSdl9-huFU&callback=initMap">
        </script>
    </div>
    <!-- Contact Details Column -->
    <div class="col-md-4">
        <h3>Contact Details</h3>
        <p>
            3481 Melrose Place<br>Beverly Hills, CA 90210<br>
        </p>
        <p><i class="fa fa-phone"></i> 
            <abbr title="Phone">P</abbr>: (123) 456-7890</p>
        <p><i class="fa fa-envelope-o"></i> 
            <abbr title="Email">E</abbr>: <a href="mailto:name@example.com">name@example.com</a>
        </p>
        <p><i class="fa fa-clock-o"></i> 
            <abbr title="Hours">H</abbr>: Monday - Friday: 9:00 AM to 5:00 PM</p>
        <ul class="list-unstyled list-inline list-social-icons">
            <li>
                <a href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
            </li>
            <li>
                <a href="#"><i class="fa fa-google-plus-square fa-2x"></i></a>
            </li>
        </ul>
    </div>
</div>
<!-- /.row -->

<!-- Contact Form -->
<!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<div class="row">
    <div class="col-md-8">
        <h3>Send us a Message</h3>
        <form name="sentMessage" id="contactForm">
            <div class="control-group form-group">
                <div class="controls">
                    <label>Full Name:</label>
                    <input type="text" class="form-control" id="name" required data-validation-required-message="Please enter your name.">
                    <p class="help-block"></p>
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Phone Number:</label>
                    <input type="tel" class="form-control" id="phone" required data-validation-required-message="Please enter your phone number.">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Email Address:</label>
                    <input type="email" class="form-control" id="email" required data-validation-required-message="Please enter your email address.">
                </div>
            </div>
            <div class="control-group form-group">
                <div class="controls">
                    <label>Message:</label>
                    <textarea rows="5" cols="100" class="form-control" id="message" required data-validation-required-message="Please enter your message" maxlength="999" style="resize:none"></textarea>
                </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-success">Send Message</button>
        </form>
    </div>

</div>
<!-- /.row -->
    
</div>


 <script type="text/javascript">
   $('#contactN').addClass('active');
 </script>

@endsection