<?php

use App\User;

if(count($msgs) == 0){
  $noMsgs = true;
}
else{
  $noMsgs = false;
}

if($user->role == 'Doctor'){
  $href='doctor';
}
elseif($user->role == 'Secretary'){
  $href='secretary';
}
elseif($user->role == 'Pacient'){
  $href='pacient';
}
else{
  $href='manager';
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>البريد الوارد </title>

    @include('includes.links')
     <!-- bootstrap-wysiwyg -->
    <link href="{{asset('vendors/google-code-prettify/bin/prettify.min.css')}}" rel="stylesheet">
  </head>

  <body class="nav-md" dir="rtl">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title navbar-fixed-top" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>
                @if($user->role == 'Pacient')
                  PalTabib
                @else
                  {{$clinic->name}}
                @endif
                </span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">

              <div class="profile_info">
                <h2>مرحبا</h2>
                <h2>{{$user->name}}</h2>
              </div>
			        <div class="profile_pic">
                <img src="/images/users/{{$user->image}}" alt="..." class="img-circle profile_img">
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @if($user->role == "Doctor")

             @include('includes.doctor_sidebar')

            @elseif($user->role == "Secretary")
              @include('includes.secretary_sidebar')
               @elseif($user->role == "Pacient")
              @include('includes.patient_sidebar')
            @else

             @include('includes.manager_sidebar')

            @endif
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
             @include('includes.menu-footer')
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
           @include('includes.topNav')

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="page-content">

            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12">
                <div class="x_panel">
                  <div class="x_title">
                   
                    <ul class="nav navbar-left panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                     <h2 style="float:right;">البريد الوارد</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="row">
                      <div style="float:right;" class="col-sm-3 mail_list_column">
                        <button id="compose" class="btn btn-sm btn-success btn-block" type="button">رسالة جديدة</button>
                        @if(!$noMsgs)
                        @foreach($msgs as $msg)
                       
                        <a class="showmsg" msgid="{{ $msg->msg_id }}">
                          <div class="mail_list" style="<?php if(!$msg->seen) echo 'background-color: #ecfdea;'; ?>">
                            
                            <div class="right">
                              <h3 style="display:inline-block;"> {{$msg->name}} </h3>
                              <small class="pull-left"> {{$msg->msg_time }} </small>
                              <p style="<?php if(!$msg->seen) echo 'font-weight: bold;'; ?>">{{$msg->title}}</p>
                            </div>
                          </div>
                        </a>

                        @endforeach
                        {{$msgs->links()}}
                         @endif
                      </div>
                      <!-- /MAIL LIST -->

                      <!-- CONTENT MAIL -->
                      <div class="col-sm-9 mail_view">
                         @if(!$noMsgs)
                        <div class="inbox-body">
                          <div class="mail_heading row">
                            <div class="col-md-8">
                              <div class="btn-group">
                                <button id="replyMsg" data="{{ $currentmsg->msg_id }}" class="btn btn-sm btn-primary" type="button"><i class="fa fa-reply"></i> رد</button>
                                <button class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Print"><i class="fa fa-print"></i></button>
                                <a href="/message/delete/receiver/{{ $currentmsg->msg_id }}" id="deleteMSG" class="btn btn-sm btn-default" type="button" data-placement="top" data-toggle="tooltip" data-original-title="Trash"><i class="fa fa-trash-o"></i></a>
                              </div>
                            </div>
                            <div class="col-md-4 text-right msgTitle" id="msgtitle">
                              <p>{{ $currentmsg->title}}</p>
                            </div>
                            
                          </div>
                           <hr style="margin-top: 0px;"/>

                          <div class="sender-info">
                            <div class="row">
                              <div class="col-md-12 msgHeader">
                                <strong>المرسل: </strong>
                                <span id="sender_name">{{ $currentmsg->name }}</span>
                                <br>
                                <strong>الايميل: </strong>
                                <span id="sender_mail">{{ $currentmsg->email }}</span>
                                <p class="date pull-left">{{ $currentmsg->msg_time}}</p>

                              </div>
                               
                            </div>
                          </div>
                          <div id="msgbody" class="view-mail">
                            {{ $currentmsg->message }}
                           </div>                        
                        </div>
                         @endif
                      </div>
                      <!-- /CONTENT MAIL -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        @include('includes.footer')
        <!-- /footer content -->
      </div>
    </div>

    <!-- compose -->
    <div class="compose col-md-6 col-xs-12">
      <div class="compose-header">
        رسالة جديدة
        <button id="closeCompose" type="button" class="close compose-close">
          <span>×</span>
        </button>
      </div>

      <div class="compose-body">
        <div id="alerts"></div>

        <div class="btn-toolbar editor" data-role="editor-toolbar" data-target="#editor">
          

          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li>
                <a data-edit="fontSize 5">
                  <p style="font-size:17px">Huge</p>
                </a>
              </li>
              <li>
                <a data-edit="fontSize 3">
                  <p style="font-size:14px">Normal</p>
                </a>
              </li>
              <li>
                <a data-edit="fontSize 1">
                  <p style="font-size:11px">Small</p>
                </a>
              </li>
            </ul>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
            <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
            <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
            <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
            <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
            <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
            <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-indent"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
            <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
            <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
            <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
            <div class="dropdown-menu input-append">
              <input class="span2" placeholder="URL" type="text" data-edit="createLink" />
              <button class="btn" type="button">Add</button>
            </div>
            <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>
          </div>

          <div class="btn-group">
            <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
            <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
          </div>
          <iframe style="display: none;" name="xframe"></iframe>
           <form method="POST" action="/send/msg" id="sendMsgFrom" target="xframe">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input name="smsgsender" id="smsgsender" type="hidden" value="{{ $user->user_name }}">		


        <div class="btn-group pull-right col-md-6 col-sm-6 col-xs-12" style="margin-right: 10px;">          
						<input placeholder="عنوان الرساله" title="العنوان" name="smsgtitle" id="smsgtitle" class="form-control col-md-7 col-xs-12" data-validate-length-range="15" data-validate-words="1" required="required" type="text">		
          </div>
        


          <div class="btn-group pull-right" style="margin-right: 10px;">
            <h2>الى</h2>
            
          </div>

            <div class="btn-group pull-right">
          
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                          <select required="required" class="select2_group form-control" name="smsgreceiver" id="smsgreceiver">
                            
                            <optgroup label="الاطباء">
                            <?php
                            foreach($doctors as $doctor){
                               echo "<option value='".$doctor->user_name."'>".$doctor->name."(".$doctor->email.")"."</option>";
                            }
                            ?>
                            </optgroup>

                            @if($user->role != 'Pacient')
                            <optgroup label="السكرتاريا">

                              <?php
                            
                            foreach($secretaries as $secretary){
                               echo "<option value='".$secretary->user_name."'>".$secretary->name."(".$secretary->email.")"."</option>";

                            }
                            
                            ?>
                               
                            </optgroup>
                            <optgroup label="الممرضين">
                               
                              <?php

                            foreach($nurses as $nurse){
                               echo "<option value='".$nurse->user_name."'>".$nurse->name."(".$nurse->email.")"."</option>";

                            }
                            
                            ?>
                            </optgroup>

                            <optgroup label="المرضى">
                               
                              <?php

                            foreach($pacirnts as $patient){
                               echo "<option value='".$patient->user_name."'>".$patient->name."(".$patient->email.")"."</option>";

                            }
                            
                            ?>
                            </optgroup>
                            @endif
                           
                          </select>
                       
                      </div>
                      
          </div>

        </div>

      <textarea name="smsgbody" id="editor" class="editor-wrapper" rows="5" cols="" required="required"></textarea>
     

      <a class="compose-footer" id="sendmsg">
        <input type="submit" value="ارسال" class="btn btn-sm btn-success" type="submit" style="margin-top:5px;"></input>
        
      </a>
            
          </form>

            </div>
    </div>
    <!-- /compose -->

    <!-- Button trigger modal -->
<button id="msgModal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="display:none;">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title pull-right" id="exampleModalLabel">تنبيه</h4>
        <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalMsg" style="font-size: 17px;">
        تم ارسال الرسالة بنجاح
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-success pull-left" data-dismiss="modal">اغلاق</button>
      </div>
    </div>
  </div>
</div>

    @include('includes.scrtipts_src')

    <script type="text/javascript">

     

      $(document).ready(function()
        {
           
           $('.showmsg').on('click',function(){
                var msg_id = $(this).attr('msgid');
               
                 $.get("/ajax/message/show/"+msg_id,function(data){
                   
                     $('.date').html(data.msg.created_at);
                     $('#sender_name').html(data.sender.name);
                     $('#sender_mail').html(data.sender.email);
                     $('#msgtitle').html(data.msg.title);
                     $('#msgbody').html(data.msg.message);
                     $("#deleteMSG").attr("href", "/message/delete/receiver/"+data.msg.id);
                     $("#replyMsg").attr("data", data.msg.id);
                  
                 });

                 $.get("/ajax/message/saw/"+msg_id);


            });


          $("#sendMsgFrom").submit(function(e) {

              var url = "/send/msg"; // the script where you handle the form input.

              $.ajax({
                    type: "POST",
                    url: url,
                    data: $("#sendMsgFrom").serialize(), // serializes the form's elements.
                    success: function(data)
                    {
                         $("#closeCompose").click();
                         $("#msgModal").click();
                         $('#smsgtitle').val('');
                         $('#editor').val("");
                    }
                  });

              e.preventDefault(); // avoid to execute the actual submit of the form.
          });

        });


        $('#replyMsg').on('click',function(){
                var msg_id = $(this).attr('data');
                $.ajax({
                    type: "GET",
                    url: "/ajax/message/show/"+msg_id,
                    success: function(data)
                    {
                      $('#smsgtitle').val('رد على: '+data.msg.title);
                      $('#editor').val("\n\n-----------------\n"+data.msg.message);
                      $('#smsgreceiver').val(data.sender.user_name);
                      $("#compose").click();
                    }
                  });
            });


    </script>

  </body>
</html>
